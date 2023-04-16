<?php
$pageTitle = "super Bienvenue";

?>
<div class="container-fluid d-flex p-5 col-12 justify-content-around">
<?php
$i=0;
foreach ($produits as $produit ){
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


