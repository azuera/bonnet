<?php


use Model\Produit;
use Service\BeanieFilter;
use Service\ProduitFactory;

$sqlSelectMat="SELECT material_id, material_name FROM `material` ";
$statementSelectMat = $connection->query($sqlSelectMat);
$materials = $statementSelectMat->fetchAll(PDO::FETCH_ASSOC);

$sqlSelectSize="SELECT size_id, size_name FROM `size` ";
$statementSelectSize = $connection->query($sqlSelectSize);
$sizes = $statementSelectSize->fetchAll(PDO::FETCH_ASSOC);
var_dump($_GET['index']);

$index=$_GET['index'];
$sqlProduit='SELECT produit_index, produit_nom,produit_prix,produit_desc,produit_img,size.size_name,material.material_name
FROM produit
LEFT JOIN produit_material ON produit.produit_index = produit_material.id_produit
LEFT JOIN material ON material.material_id = produit_material.id_material
LEFT JOIN produit_size ON produit.produit_index = produit_size.id_produit
LEFT JOIN size ON size.size_id = produit_size.id_size WHERE produit_index=:produit_index';
$statementSelectProduit=$connection->prepare($sqlProduit);
$statementSelectProduit->bindValue(":produit_index",$index,PDO::PARAM_INT);
$statementSelectProduit->execute();
$produits=$statementSelectProduit->fetchAll();
var_dump($produits);
foreach ($produits as $produit) {
    echo gettype($produit);
}

var_dump($_POST);


if(isset($_POST))
{
    $sqlUpdate="UPDATE produit SET produit_nom = :produit_nom,produit_prix = :produit_prix,produit_desc = :produit_desc
     WHERE produit_index=:produit_index";
    $statementUpdateProduit=$connection->prepare($sqlUpdate);
    $statementUpdateProduit->bindValue(":produit_index",$index,PDO::PARAM_INT);
    $statementUpdateProduit->bindValue(":produit_nom",$_POST['nom'],PDO::PARAM_STR);
    $statementUpdateProduit->bindValue(":produit_prix",$_POST['Prix'],PDO::PARAM_STR);
    $statementUpdateProduit->bindValue(":produit_desc",$_POST['desc'],PDO::PARAM_STR);
    $statementUpdateProduit->execute();
    
    $sqlDeleteMat="DELETE FROM `produit_material` WHERE id_produit=:id_produit ";
        $statementDeleteMat = $connection->prepare($sqlDeleteMat);
        $statementDeleteMat->bindValue('id_produit',$_GET['index'],PDO::PARAM_STR);
        $statementDeleteMat->execute();
    
        $sqlDeleteSize="DELETE FROM `produit_size` WHERE id_produit=:id_produit ";
        $statementDeleteSize = $connection->prepare($sqlDeleteSize);
        $statementDeleteSize->bindValue('id_produit',$_GET['index'],PDO::PARAM_STR);
        $statementDeleteSize->execute();
    
        $jointureMat = "INSERT INTO `produit_material` (id_produit,id_material) VALUES (:id_produit,:id_material)";
        $statementMat = $connection->prepare($jointureMat);
        foreach ( $_POST['matiere'] as $idMat) {
    
            $statementMat->bindValue(":id_produit", $_GET['index'], PDO:: PARAM_INT);
            $statementMat->bindValue(":id_material", $idMat, PDO:: PARAM_INT);
            $statementMat->execute();
        }
    
        $jointureSize = "INSERT INTO `produit_size`(`id_produit`, `id_size`) VALUES (:id_produit,:id_size)";
        $statementSize = $connection->prepare($jointureSize);
        foreach ($_POST["taille"] as $idSize){
    
            $statementSize->bindValue(":id_produit", $_GET['index'], PDO:: PARAM_INT);
            $statementSize->bindValue(":id_size", $idSize, PDO:: PARAM_INT);
            $statementSize->execute();
        }
}





?>

<form action='' method="post">


    <div class="mb-3">
        <label for="nom" class="form-label">nom-Bonnet</label>
        <input type="text" id="nom" name="nom" class="form-control" value="<?php echo $produit['produit_nom']?>">
    </div>
    <div class="mb-3">
        <label for="Prix" class="form-label">Prix</label>
        <input type="number" class="form-control" id="Prix" name="Prix" value="<?php echo $produit['produit_prix']?>"  >
    </div>
    <div class="mb-3">
        <label for="desc" class="form-label">desc</label>
        <input type="text" class="form-control" id="desc" name="desc" value="<?php echo $produit['produit_desc']?>"  >
    </div>


    </div>
    <div class="mb-3">
        <label for="taille" class="form-label">taille</label>
        <select multiple id="taille" class="form-select" name="taille[]">
            <option>selectionner votre taille</option>
            <?php
            foreach ($sizes as  $size) {
                ?>
                <option value="<?= $size['size_id']; ?>"><?php echo $size['size_name']; ?></option>
                <?php
            }
            ?>
        </select>

    </div>
    <div class="mb-3">
        <label for="matiere"
               class="form-label">matiere
        </label>
        <select multiple  id="matiere" class="form-select" name="matiere[]">
            <option>selectionner votre matiere</option>
            <?php
            foreach ($materials as $material) {
                ?>
                <option value="<?= $material['material_id']; ?>"><?php echo $material['material_name']; ?></option>
                <?php
            }
            ?>
        </select>

    <button type="submit" class="btn btn-primary">update</button>

</form>
<?php
unset($_POST);
?>