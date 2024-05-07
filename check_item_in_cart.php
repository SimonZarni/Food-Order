<?php
session_name('user');
session_start();
include_once __DIR__ . '/controller/CartController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = $_POST['item_id'];
    $user_id = $_SESSION['id'];

    $cart_controller = new CartController();
    $result = $cart_controller->checkItemInCart($item_id, $user_id);

    if ($result['num_items'] > 0) {
        echo "Item is already in the cart.";
    } else {
        echo "Item is not in the cart.";
    }
}

?>