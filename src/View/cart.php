<?php


use Model\Cart;
use Service\ProduitFactory;

$cart = new Cart();

$isCartModified = $cart->handle($_GET);

if ($isCartModified) {
    header('location:?page=cart');
}

?>
<table class="table">
    <tr>
        <thead>
        <th>id</th>
        <th>nom</th>
        <th>prix</th>
        <th>quantite</th>

        <th>prix</th>
    </tr>
    </thead>

    <tbody>
    <?php
    $total = 0.0;
    $index=null;
    $produitFactory = new ProduitFactory();
    $sqlProduit='SELECT produit_index, produit_nom,produit_prix,produit_desc,produit_img,size.size_name,material.material_name
FROM produit
INNER JOIN produit_material ON produit.produit_index = produit_material.id_produit
INNER JOIN material ON material.material_id = produit_material.id_material
INNER JOIN produit_size ON produit.produit_index = produit_size.id_produit
INNER JOIN size ON size.size_id = produit_size.id_size WHERE produit_index=:produit_index';
    $statement=$connection->prepare($sqlProduit);
    $statement->bindParam(':produit_index',$produit_index);

    foreach ($cart->getContent() as $produit_index => $quantity) {


        $statement->execute();
        $produitData = $statement->fetch();

        if (empty($produitData)) {
            continue;

        }
        $produit = $produitFactory->create($produitData);


        $price = $produit->getPrix() * $quantity;
        $total += $price;

        var_dump($produit->getSizes());

        ?>


        <tr>
            <td>
                <?= $produit_index; ?>
            </td>
            <td>
                <?= $produit->getNom(); ?>
            </td>
            <td>
                <?= $produit->getPrix(); ?>
            </td>
            <td>
                <?php foreach ($produit->getSizes() as $size) {echo $size;}; ?>
            </td>

            <td>
                <a href='?page=cart&index=<?= $produit_index; ?>&mode=plus'>+</a>
                <?= $quantity; ?>
                <a href='?page=cart&index=<?= $produit_index; ?>&mode=min'>-</a>

            </td>
            <td>
                <?= $price; ?>
                <a href='?page=cart&index=<?= $produit_index; ?>&mode=delete'>effacer</a>
            </td>

        </tr>

    <?php } ?>
    <tr>
        <td colspan="5"><?= 'total= ' . $total; ?></td>
    </tr>
    </tbody>
</table>
<a class="btn btn-danger" href='?page=cart&mode=empty'>vider le panier</a>