<?php
$pageTitle = "deconnexion";
include 'includes/header.php';

session_destroy();
header('location: index.php?logout=success');

include 'includes/footer.php'; 
