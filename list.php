<?php
$pageTitle = "he Bienvenue";
include 'includes/header.php';
?>

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
    </tr>


            <?php foreach ($produits as $index => $produit){ 
                displayBonnet ($index,$produit);
} ?>

</table>

<?php 
include 'includes/footer.php' ?>