<?php
$pageTitle = "deconnexion";


session_destroy();
header('location: index.php?logout=success');


