<?php
$pageTitle = "connexion";
include 'includes/header.php';
$errors=[];
//trim evite de faite de mettre des espace
if (isset($_POST['username'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

  if (empty($password)) {
   $errors[] = 'mot de passe vide';
  } elseif ($password != $mdp){
    $errors[]='mot de passe wronng';
  }

  if(empty($username)){
    $errors[]='username vide';
  }

  if(empty($mdp)){
    $errors[]='mot de passe vide';
  }

  if(empty($errors)){ 
    $_SESSION['username'] = $_POST['username'];
    header('location:index.php?login=success');
   }
 }




?>
<?php  foreach ($errors as $error){ ?>
  <div class="alert alert-danger" role="alert">
  <?php echo $error; ?>
</div>
<?php } ?>

<form action="" method="post"> 

  <div class="mb-3">
    <label for="username" class="form-label">identifiant</label>
    <input type="text" class="form-control" id="username" name="username" >
    
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


<?php 
include 'includes/footer.php' ?>