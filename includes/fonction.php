<?php
function tva(float $prixTTC): float
{
    return $prixTTC/1.2;
}

function displayBonnet( int $id, array $produit): void{
    $prix = $produit['prix']; ?>

                
<tr>
        <td><?php  echo $produit['nom']; ?> </td>
<td <?php  if ($produit['prix']<=12){
    echo "class='green'";}
else {echo"class='red'";}?> >
    <?php echo $prix; ?></td>
<td><?php echo number_format(tva($prix), 2, ',', ' '); ?></td>
<td><?php  echo $produit['desc']; ?></td>

</tr>


<?php   
}