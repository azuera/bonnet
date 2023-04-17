<?php

$produitsFiltred = $produits;
$prixMax=null;
$prixMini=null;



if(!empty($_POST['prix-mini'])){
    $prixMini = floatval($_POST['prix-mini']);

    $produitsFiltred = array_filter($produitsFiltred, function (Produit $produit) use ($prixMini) {
        return $produit->getPrix()>= $prixMini;
    });
}
if(!empty($_POST['prix-max'])){
    $prixMax = floatval($_POST['prix-max']);

    $produitsFiltred = array_filter($produitsFiltred, function (Produit $produit) use ($prixMax){
        return $produit->getPrix()<= $prixMax;
    });
}
?>
<form action='' method="post">
<div class="mb-3">
  <label for="prix-mini" class="form-label">prix-mini</label>
  <input type="number" class="form-control" id="prix-mini" name="prix-mini" value="<?=$prixMini;?>">
</div>
  <div class="mb-3">
  <label for="prix-max" class="form-label">prix-maxi</label>
  <input type="number" class="form-control" id="prix-max" name="prix-max" value="<?=$prixMax;?>" >
</div>
<div class="mb-3">
  <label for="material" class="form-label">matiere</label>
  <select  id="material" name="material" >
    <option value=""> choisissez votre matiere</option>
    <?php 
    foreach (Produit::AVAILABLE_MATERIALS as $value => $name) {
        ?>
        <option value="<?=$value;?>"<?= $name;?>></option>
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
            panier
        </th>
    </tr>


            <?php foreach ($produitsFiltred as  $produit){ 
                displayBonnet ($produit);
} ?>

</table>

