<?php
$pageTitle = "he Bienvenue";

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

