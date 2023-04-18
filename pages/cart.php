<?php
global $produits;
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
    foreach ($cart->getContent() as $index => $quantity) {
        $produit = findById($produits, $index);
        if (empty($produits)) {
            continue;
        }
        $price = $produit->getPrix() * $quantity;
        $total += $price;
        ?>


        <tr>
            <td>
                <?= $index; ?>
            </td>
            <td>
                <?= $produit->getNom(); ?>
            </td>
            <td>
                <?= $produit->getPrix(); ?>
            </td>

            <td>
                <a href='?page=cart&index=<?= $index; ?>&mode=plus'>+</a>
                <?= $quantity; ?>
                <a href='?page=cart&index=<?= $index; ?>&mode=min'>-</a>

            </td>
            <td>
                <?= $price; ?>
                <a href='?page=cart&index=<?= $index; ?>&mode=delete'>effacer</a>
            </td>

        </tr>

    <?php } ?>
    <tr>
        <td colspan="5"><?= 'total= ' . $total; ?></td>
    </tr>
    </tbody>
</table>
<a class="btn btn-danger" href='?page=cart&mode=empty'>vider le panier</a>