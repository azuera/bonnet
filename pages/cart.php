<?php 
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
elseif (isset($_GET['mode'])&& $_GET['mode'] == 'empty') {
    $_SESSION['cart'] = [];
}

if (isset($_GET['index'])) {
    $index = $_GET['index'];
    $cart = $_SESSION['cart'];

    $mode ='plus';
    if  (isset($_GET['mode'])){
        $mode = $_GET['mode'];
    }
    

    if(!isset($cart[$index])){
        $cart[$index]=0; 
    }
    switch ($mode) {
        case 'plus':
            $cart[$index]++; 
            break;
            case 'min':
                $cart[$index]--; 
                break;
                case 'delete':
                    $cart[$index]=0; 
                    break;
        
    }
    if ($cart[$index]<= 0){
       unset($cart[$index]); 
    }



    $_SESSION['cart']= $cart;
    header('location:?page=cart');
    
}
var_dump($_SESSION['cart']);
?>
<table class="table">
    <tr>
    <thead>
        <th>id</th>
        <th>nom</th>
        <th>prix</th>
        <th>quantite</th>
        <th>prix</th>
        </tr>
    </thead>

<tbody>
<?php
    $total=0;
    foreach ($_SESSION['cart'] as $index => $quantity) {
        $produit = findById($produits,$index); 
        if(empty($produits)){
            continue;
        }
        $price = $produit->getPrix() * $quantity;
        $total += $price;
        ?>
        

    <tr>
        <td>
            <?= $index; ?>
        </td>
        <td>
            <?= $produit->getNom(); ?>
        </td>
        <td>
            <?= $produit->getPrix(); ?>
        </td>

        <td>
            <a href='?page=cart&index=<?=$index;?>&mode=plus'>+</a>
            <?= $quantity; ?>
            <a href='?page=cart&index=<?=$index;?>&mode=min'>-</a>
            
        </td>
        <td>
            <?= $price; ?>
            <a href='?page=cart&index=<?=$index;?>&mode=delete'>effacer</a>
        </td>
        
    </tr>

    <?php } ?>
    <tr>
        <td colspan="5"><?= 'total= '.$total; ?></td>
    </tr>
</tbody>
</table>
<a class="btn btn-danger" href='?page=cart&mode=empty'>vider le panier</a>