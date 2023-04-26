<?php
spl_autoload_register(function ($class) {
    require_once "../src/$class.php";
});
require_once '../includes/db.inc.php';

$produits = [
    (new Produit())
        ->setIndex(0)
        ->setNom('bonnet en laine')
        ->setPrix(5)
        ->setDesc("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a leo diam. Quisque lorem orci, accumsan quis dolor sed, gravida.")
        ->setImg("https://picsum.photos/200")
        ->addMaterial("cachemire")
        ->addSize('S')

    ,
    (new Produit())
        ->setIndex(1)
        ->setNom('bonnet en laine bio')
        ->setPrix(30)
        ->setDesc("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a leo diam. Quisque lorem orci, accumsan quis dolor sed, gravida.")
        ->setImg("https://picsum.photos/200")
        ->addMaterial("laine")
        ->addSize('M')

    ,
    (new Produit())
        ->setIndex(2)
        ->setNom('bonnet en laine et cachemir')
        ->setPrix(20)
        ->setDesc("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a leo diam. Quisque lorem orci, accumsan quis dolor sed, gravida.")
        ->setImg("https://picsum.photos/200")
        ->addMaterial("soie")
        ->addSize('L')

    ,
    (new Produit())
        ->setIndex(3)
        ->setNom('bonnet arc en ciel')
        ->setPrix(15)
        ->setDesc("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a leo diam. Quisque lorem orci, accumsan quis dolor sed, gravida.")
        ->setImg("https://picsum.photos/200")
        ->addMaterial("coton")
        ->addSize('XL')
    ,
];
$truncate ="SET foreign_key_checks = 0;
            
            TRUNCATE TABLE size;
            TRUNCATE TABLE produit;
            TRUNCATE TABLE material;
            TRUNCATE TABLE produit_material;
            TRUNCATE TABLE produit_size;
            SET foreign_key_checks = 1;";
$connection->exec($truncate);

/* on insert les données ds la table  metrial et on on push les $name ds un tableau pr les recuperer ensuite dans la table des relation */
$materialAdd = "INSERT INTO `material`( `material_name`) VALUES (:name)";
$statement = $connection->prepare($materialAdd);
$materials = [];

foreach (Produit::AVAILABLE_MATERIALS as $name) {
    $statement->bindValue(":name", $name, PDO:: PARAM_STR);
    $statement->execute();
    $materials[$name] = $connection->lastInsertId();
    /* lastInsertId permet de recuperer id*/
}
$sizeAdd = "INSERT INTO `size`( `size_name`) VALUES (:name)";
$statement = $connection->prepare($sizeAdd);
$sizes = [];

foreach (Produit::AVAILABLE_SIZES as $name) {
    $statement->bindValue(":name", $name, PDO:: PARAM_STR);
    $statement->execute();
    $sizes[$name] = $connection->lastInsertId();
}
/* requete preparer $connection->prepare */
$sql = "INSERT INTO `produit`( 
                      `produit_nom`, 
                        `produit_prix`, 
                      `produit_desc`, 
                      `produit_img`, 
                      `produit_size`, 
                      `produit_material`) VALUES (:nom,
                                                  :prix,
                                                  :desc,
                                                  :img,
                                                  :size,
                                                  :material)";
$statement = $connection->prepare($sql);

/* en dessous le commentaire nous permet d'acceder a auto completion en indiquant a ide qu'il s'agit bien d'un produit*/

/** @var Produit $produit */

foreach ($produits as $produit) {

    /* on link a des variable */
    /* */
    $statement->bindValue(":nom", $produit->getNom(), PDO:: PARAM_STR);
    $statement->bindValue(":prix", $produit->getPrix(), PDO:: PARAM_INT);
    $statement->bindValue(":desc", $produit->getDesc(), PDO:: PARAM_STR);
    $statement->bindValue(":img", $produit->getImg(), PDO:: PARAM_STR);
    $statement->bindValue(":size", json_encode($produit->getSizes()), PDO:: PARAM_STR);
    $statement->bindValue(":material", json_encode($produit->getMaterials()), PDO:: PARAM_STR);
    $statement->execute();
    $id = $connection->lastInsertId();


    /* ici on fais les jointures  avec les id que  l'on a stocker grace au tableau $materials ou on on pusher les id*/
    /* !!!!! ici le $statement ne peut pas être repeter car sinon il n'arrive pas a passer a l'action suivante ($statement $statementMat)*/

    $jointureMat = "INSERT INTO `produit_material` (id_produit,id_material) VALUES (:id_produit,:id_material)";
    $statementMat = $connection->prepare($jointureMat);
    foreach ($produit->getMaterials() as $name) {
        $idMat = $materials[$name];
        $statementMat->bindValue(":id_produit", $id, PDO:: PARAM_INT);
        $statementMat->bindValue(":id_material", $idMat, PDO:: PARAM_INT);
        $statementMat->execute();
    }

    $jointureSize = "INSERT INTO `produit_size`(`id_produit`, `id_size`) VALUES (:id_produit,:id_size)";
    $statementSize = $connection->prepare($jointureSize);
    foreach ($produit->getSizes() as $name){
        $idSize = $sizes[$name];
        $statementSize->bindValue(":id_produit", $id, PDO:: PARAM_INT);
        $statementSize->bindValue(":id_size", $idSize, PDO:: PARAM_INT);
        $statementSize->execute();
    }


}

/* json encode convertie en chaine de caraterer*/


