<?php

use Model\Produit;

function tva(float $prixTTC): float
{
    return $prixTTC / 1.2;
}

//function findById(array $produits, int $index): ?Produit{
//foreach ($produits as $produit) {
//    if($produit->getIndex()==$index){
//        return $produit;
//    }
//}
//return null;
//}

function displayBonnet(produit $produit): void
{
    $prix = $produit->getPrix(); ?>


    <tr>
        <td><?php echo $produit->getNom(); ?> </td>
        <td <?php if ($produit->getPrix() <= 12) {
            echo "class='green'";
        } else {
            echo "class='red'";
        } ?> >
            <?php echo $prix; ?></td>
        <td><?php echo number_format(tva($prix), 2, ',', ' '); ?></td>
        <td><?php echo $produit->getDesc(); ?></td>
        <td>
            <?php foreach ($produit->getSizes() as $size) {echo $size;}; ?>
        </td>
        <td>
            <?php foreach ($produit->getMaterials() as $material) {echo $material;}; ?>
        </td>
        <td>
            <a href="?page=updateProduit&index=<?= $produit->getIndex(); ?>" class="btn btn-info"> update</a>
        </td>
        <td>
            <a href="?page=list&index=<?= $produit->getIndex(); ?>&&delete" class="btn btn-danger"> delete</a>
        </td>

        <td>
            <a href="?page=cart&index=<?= $produit->getIndex(); ?>" class="btn btn-primary"> panier</a>
        </td>

    </tr>


    <?php
}