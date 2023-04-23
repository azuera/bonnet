<?php
/** @var PDOStatement  $statement*/
$pageTitle = "super Bienvenue";
$sqlProduit='SELECT produit_index, produit_nom,produit_prix,produit_desc,produit_img,size.size_name,material.material_name
FROM produit
INNER JOIN produit_material ON produit.produit_index = produit_material.id_produit
INNER JOIN material ON material.material_id = produit_material.id_material
INNER JOIN produit_size ON produit.produit_index = produit_size.id_size
INNER JOIN size ON size.size_id = produit_size.id_size';
$statement=$connection->query($sqlProduit);
$produits = $statement->fetchAll();
$produitFactory=new ProduitFactory();

?>
<div class="container-fluid d-flex p-5 col-12 justify-content-around">
<?php
$i=0;
foreach ($produits as $produitData ){
    $produit = $produitFactory->create($produitData);

    $i++;
    if($i >3){
        break;

    }
    ?>
   
    <div class="card p-5 " style="width: 18rem;">
  <img src="<?php echo $produit->getImg()?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title "><?php echo $produit->getNom();?></h5>
    <p class="card-text"><?php echo $produit->getDesc();?></p>
    <a href="?page=cart&index=<?=$produit->getIndex();?>" class="btn btn-primary">ajouter au panier</a>
  </div>
</div>
    <?php
}

?>
</div>
<div class="d-flex justify-content-center">
    <a href="?page=list" class="btn btn-primary "> viens on est bien!!!!</a>
</div>


