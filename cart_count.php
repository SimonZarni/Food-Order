<?php
session_name('user');
session_start();
include_once __DIR__ . '/controller/CartController.php';

if (isset($_SESSION['id']))
    $user_id = $_SESSION['id'];

if (isset($_GET['restaurant_id']))
    $restaurant_id = $_GET['restaurant_id']; // Get restaurant_id from the request

$cart_controller = new CartController();

if (isset($user_id) && isset($restaurant_id))
    $cart_count = $cart_controller->getCartItemCountByUser($user_id, $restaurant_id);
else
    $cart_count = 0;

echo $cart_count;
