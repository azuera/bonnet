<?php
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 } 

// ? pa rametre get
include 'includes/variables.php';
include 'includes/fonction.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title><?=  $pageTitle; ?> -mes beau bonnet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="?page=home">super bonnet ici</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="?page=home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=list">Liste</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=cart">panier</a>
        </li>
        <?php
                if (isset($_SESSION['username'])){ 
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=login"><?php echo "bonjour ".$_SESSION['username']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=logout">byebyedeco</a>
                    </li>
        
             <?php   }else { ?>
                <li class="nav-item">
          <a class="nav-link" href="?page=login">connexion</a>
        </li>
           <?php  } ?>
        
        
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<?php
if (isset($_GET['login']) && $_GET['login']=='success') { 
    ?>
    <div class="alert alert-success" role="alert">connecter!!bravo</div>
<?php }  ?>
<?php
if (isset($_GET['logout']) && $_GET['logout']=='success') { 
    ?>
    <div class="alert alert-success" role="alert">déconnecter!!bravo</div>
<?php }  ?>