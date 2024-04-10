<?php
session_name('user');
session_start();
include_once __DIR__ . '/controller/OrderController.php';
include_once __DIR__ . '/controller/CartController.php';
include_once __DIR__ . '/controller/ItemController.php';

if(isset($_POST['township_id'], $_POST['payment_id'], $_POST['item_ids'])){
    $order_controller = new OrderController();
    $cart_controller = new CartController();
    $item_controller = new ItemController();

    $user_id = $_SESSION['id'];
    $township_id = $_POST['township_id'];
    $payment_id = $_POST['payment_id'];
    $item_ids = $_POST['item_ids'];
    $total_price = $_POST['total_price'];

    foreach ($item_ids as $item_id) {
        $order_date = date('Y-m-d');
        $itemDetails = $item_controller->getItem($item_id);
        
        $success = $order_controller->addOrder($total_price, $order_date, $user_id, $item_id, $township_id, $payment_id);

        if ($success) {
            $cart_controller->removeCartItem($user_id, $item_id);
            echo "Order for item id $item_id added successfully<br>";
        } else {
            echo "Failed to add order for item id $item_id<br>";
        }
    }
} else {
    http_response_code(400);
    echo json_encode(array('error' => 'Missing required data'));
}

?>
