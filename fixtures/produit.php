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
        ->addSize('M')
        ->addSize('L')
        ->addSize('XL')

    ,
    (new Produit())
        ->setIndex(1)
        ->setNom('bonnet en laine bio')
        ->setPrix(30)
        ->setDesc("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a leo diam. Quisque lorem orci, accumsan quis dolor sed, gravida.")
        ->setImg("https://picsum.photos/200")
        ->addMaterial("laine")
        ->addSize('S')
        ->addSize('M')
        ->addSize('L')
        ->addSize('XL')
    ,
    (new Produit())
        ->setIndex(2)
        ->setNom('bonnet en laine et cachemir')
        ->setPrix(20)
        ->setDesc("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a leo diam. Quisque lorem orci, accumsan quis dolor sed, gravida.")
        ->setImg("https://picsum.photos/200")
        ->addMaterial("soie")
        ->addSize('S')
        ->addSize('M')
        ->addSize('L')
        ->addSize('XL')
    ,
    (new Produit())
        ->setIndex(3)
        ->setNom('bonnet arc en ciel')
        ->setPrix(15)
        ->setDesc("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a leo diam. Quisque lorem orci, accumsan quis dolor sed, gravida.")
        ->setImg("https://picsum.photos/200")
        ->addMaterial("coton")
        ->addSize('S')
        ->addSize('M')
        ->addSize('L')
        ->addSize('XL')
    ,
];
$sql = "INSERT INTO `produit`( 
                      produit_nom, 
                        produit_prix, 
                      produit_desc, 
                      produit_img, 
                      produit_size, 
                      produit_material) VALUES (:nom,:prix,:desc,:img,:size,:material)";
$statement =  $connection->prepare($sql);
foreach ( $produits as $produit){

    /* on link a des variable */
    $statement->bindValue(":nom",$produit->getNom(), PDO:: PARAM_STR);
    $statement->bindValue(":prix",$produit->getPrix(), PDO:: PARAM_INT);
    $statement->bindValue(":desc",$produit->getDesc(), PDO:: PARAM_STR);
    $statement->bindValue(":img",$produit->getImg(), PDO:: PARAM_STR);
    $statement->bindValue(":size",json_encode($produit->getSizes()), PDO:: PARAM_STR);
    $statement->bindValue(":material",json_encode($produit->getMaterials()), PDO:: PARAM_STR);
    $statement->execute();
}
/* json encode convertie en chaine de caraterer*/


