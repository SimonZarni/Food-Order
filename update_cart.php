<?php
include_once __DIR__ . '/controller/CartController.php';

$cart_controller = new CartController();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];

    if ($cart_controller->updateCartQuantity($cart_id, $quantity)) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
    }
}

header('Content-Type: application/json');

echo json_encode($response);

?>


