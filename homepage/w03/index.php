<?php
session_start();

if (!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
    $cart = $_SESSION['cart'];
}



$action = filter_input(INPUT_POST,'action');
if($action==NULL){ 
    $action=filter_input(INPUT_GET,'action');
    if($action==NULL){
        $action = 'home';
    }
}

switch($action){
    case 'home':
        include 'view/home.php';
    break;
    case 'viewItems':
        include 'view/cart.php';
    break;
    case 'addItem':
        $item = filter_input(INPUT_POST,'item');
        array_push($_SESSION['cart'],$item);
        include 'view/home.php';
    break;
    case 'removeItem':
        $item = filter_input(INPUT_POST,'item');
        unset($_SESSION['cart'][$item]);
        include 'view/cart.php';
    break;
    case 'checkout':
        include 'view/checkout.php';
    break;
    case 'confirm':
        $address1 = filter_input(INPUT_POST,'address1',FILTER_SANITIZE_STRING);
        $address2 = filter_input(INPUT_POST,'address2',FILTER_SANITIZE_STRING);
        $city = filter_input(INPUT_POST,'city',FILTER_SANITIZE_STRING);
        $state = filter_input(INPUT_POST,'state',FILTER_SANITIZE_STRING);
        $zip = filter_input(INPUT_POST,'zip',FILTER_SANITIZE_NUMBER_INT);
        include 'view/confirm.php';
    break;
    case 'resetSession':
        session_destroy();
        session_start();
        include 'view/cart.php';
    break;
    case 'startNew':
        session_destroy();
        session_start();
        include 'view/home.php';
    break;
    default:
        include 'view/home.php';
}

?>