<?php

use Model\Formulaire;

$formulaire = new Formulaire();
if (!empty($_POST)) {
    $formulaire = new Formulaire($_POST);
    $formulaire->isValid();
}


if ($formulaire->isSubmited() && $formulaire->isValid()) {
    $statement = $connection->prepare("INSERT INTO `contact`( `contact_subject`, `contact_email`, `contact_Textarea`) 
VALUES (:subject,:email,:Textarea)");
    $statement->bindValue(":subject",$formulaire->getSubject(),PDO::PARAM_STR);
    $statement->bindValue(":email",$formulaire->getEmail(),PDO::PARAM_STR);
    $statement->bindValue(":Textarea",$formulaire->getTextarea(),PDO::PARAM_STR);
    $statement->execute();
    ?>
    <div class="alert alert-success" role="alert">
        message envoyé wp!!!
    </div>
    <?php
}

?>
<?php foreach ($formulaire->getErrors() as $error) { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>
<?php } ?>


<form action='' method="post">
    <div class="mb-3">
        <label for="subject" class="form-label">sujet</label>
        <input type="text" class="form-control" id="subject" placeholder="sujet" name="subject"
               value='<?= $formulaire->getSubject() ?>'>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
               value='<?= $formulaire->getEmail() ?>'>
    </div>
    <div class="mb-3">
        <label for="Textarea" class="form-label">Example textarea</label>
        <textarea class="form-control" id="Textarea" name='Textarea' rows="3"
                  value='<?= $formulaire->getTextarea() ?>'></textarea>
    </div>
    <button type="submit" class="btn btn-primary">GO ENVOI</button>
</form>
