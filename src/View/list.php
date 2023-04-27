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


$sqlProduit='SELECT produit_index, produit_nom,produit_prix,produit_desc,produit_img,size.size_name,material.material_name
FROM produit
LEFT JOIN produit_material ON produit.produit_index = produit_material.id_produit
LEFT JOIN material ON material.material_id = produit_material.id_material
LEFT JOIN produit_size ON produit.produit_index = produit_size.id_produit
LEFT JOIN size ON size.size_id = produit_size.id_size';
$statement=$connection->query($sqlProduit);
$produitsData = $statement->fetchAll();
$produitFactory=new ProduitFactory();
$produits=[];
foreach ($produitsData as $produitData) {
    $produits[]=$produitFactory->create($produitData);

}
$produitsFiltred  = new BeanieFilter($produits, $_POST);

if (isset($_GET['delete']))  {?>
    <div class="alert alert-success" role="alert">delete!!bravo</div>

<?php
    $sqlDeleteMat="DELETE FROM `produit_material` WHERE id_produit=:id_produit ";
    $statementDeleteMat = $connection->prepare($sqlDeleteMat);
    $statementDeleteMat->bindValue('id_produit',$_GET['index'],PDO::PARAM_STR);
    $statementDeleteMat->execute();

    $sqlDeleteSize="DELETE FROM `produit_size` WHERE id_produit=:id_produit ";
    $statementDeleteSize = $connection->prepare($sqlDeleteSize);
    $statementDeleteSize->bindValue('id_produit',$_GET['index'],PDO::PARAM_STR);
    $statementDeleteSize->execute();

    $sqlDeleteProduit="DELETE FROM `produit` WHERE produit_index=:produit_index ";
    $statementDeleteProduit = $connection->prepare($sqlDeleteProduit);
    $statementDeleteProduit->bindValue('produit_index',$_GET['index'],PDO::PARAM_STR);
    $statementDeleteProduit->execute();

}


?>
<form action='' method="post">
    <div class="mb-3">
        <label for="prix-mini" class="form-label">prix-mini</label>
        <input type="number" class="form-control" id="prix-mini" name="prix-mini" value="<?= $produitsFiltred->getPrixMini(); ?>">
    </div>
    <div class="mb-3">
        <label for="prix-max" class="form-label">prix-maxi</label>
        <input type="number" class="form-control" id="prix-max" name="prix-max" value="<?= $produitsFiltred->getPrixMax(); ?>">
    </div>
    <div class="mb-3">
        <label for="material" class="form-label">matiere</label>
        <select id="material" name="material">
            <option value=""> choisissez votre matiere</option>
            <?php
            foreach (Produit::AVAILABLE_MATERIALS as $value => $name) {
                ?>
                <option value="<?= $name; ?>" <?php if ($name == $produitsFiltred->getMaterial()) {
                    echo 'selected';
                } ?>><?php echo $name; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="size" class="form-label">size</label>
        <select id="size" name="size">
            <option value=""> choisissez votre taille</option>
            <?php
            foreach (Produit::AVAILABLE_SIZES as $value => $name) {
                ?>
                <option value="<?= $name; ?>" <?php if ($name == $produitsFiltred->getSize()) {
                    echo 'selected';
                } ?>><?php echo $name; ?></option>
                <?php
            }
            ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">GO ENVOI</button>
</form>

<table>
    <tr>
        <th>
            produit
        </th>
        <th>
            prix
        </th>
        <th>
            prix ht
        </th>
        <th>
            desc
        </th>
        <th>
            taille
        </th>
        <th>
            matiere
        </th>
        <th>
            update bonnet
        </th>
        <th>
            delete de la bdd
        </th>
        <th>
            panier
        </th>
    </tr>


    <?php foreach ($produitsFiltred->getResult() as $produit) {
        displayBonnet($produit);

    } ?>

</table>

