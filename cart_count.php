<?php
session_name('user');
session_start();
include_once __DIR__ . '/controller/CartController.php';

if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
} else {
    echo "no session";
}

$cart_controller = new CartController();
$cart_count = $cart_controller->getCartItemCountByUser($user_id);

echo $cart_count;
