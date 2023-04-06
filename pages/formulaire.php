<?php
$errors=[];
$subject='';
$email='';
$Textarea='';

if (isset($_POST['subject'])){
    $subject =trim($_POST['subject']);

    if (empty($subject)) {
      $errors[]= 'sujet manquant';
    }elseif(strlen($subject) <= 15){
      $errors[]='veuillez entrer un sujet plus long( 15 cara mini)';
    }
}
if (isset($_POST['email'])){
  $email =trim($_POST['email']);

  if (empty($email)) {
    $errors[]= 'email vide';
  }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors[]='email non valide';
  }
}
if (isset($_POST['T$Textarea'])){
  $Textarea =trim($_POST['T$Textarea']);

  if (empty($Textarea)) {
    $errors[]= 'sujet manquant';
  }elseif(strlen($Textarea)<=20){
    $errors[]='veuillez entrer un sujet plus long( 100 cara mini)';
  }
}
if(isset($_POST['Textarea'])&& empty($errors)){ 
  ?>
  <div class="alert alert-success" role="alert">
  message envoyé wp!!!
  </div>
  <?php
}

?>
<?php  foreach ($errors as $error){ ?>
  <div class="alert alert-danger" role="alert">
  <?php echo $error; ?>
  </div>
<?php } ?>


<form action='' method="post">
<div class="mb-3">
  <label for="subject" class="form-label">sujet</label>
  <input type="text" class="form-control" id="subject" placeholder="sujet" name="subject" value='<?= $subject?>'>
</div>
  <div class="mb-3">
  <label for="email" class="form-label">Email address</label>
  <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value='<?= $email?>'>
</div>
<div class="mb-3">
  <label for="Textarea" class="form-label">Example textarea</label>
  <textarea class="form-control" id="Textarea" name='Textarea' rows="3" value='<?= $Textarea?>'></textarea>
</div>
  <button type="submit" class="btn btn-primary">GO ENVOI</button>
</form>
