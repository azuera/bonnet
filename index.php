<?php 
ob_start();


include 'includes/header.php';

$page = 'home';
if(isset($_GET['page'])){
    $page =$_GET['page'];
}
include 'pages/'.$page.'.php';
include 'includes/footer.php';
ob_end_flush();
?>
