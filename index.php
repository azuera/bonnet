<?php
$pageTitle = "super Bienvenue";
include 'includes/header.php';
?>
<div class="container-fluid d-flex p-5 col-12 justify-content-around">
<?php
$i=0;
foreach ($produits as $index => $produit ){
    $i++;
    if($i >3){
        break;
    }
    ?>
   
    <div class="card p-5 " style="width: 18rem;">
  <img src="<?php echo $produit['img']?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title "><?php echo $produit['nom'];?></h5>
    <p class="card-text"><?php echo $produit['desc'];?></p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
    <?php
}

?>
</div>
<div class="d-flex justify-content-center">
    <a href="list.php" class="btn btn-primary "> viens on est bien!!!!</a>
</div>


<?php 
include 'includes/footer.php' ?>