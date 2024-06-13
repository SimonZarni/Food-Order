<?php
session_name('user');
session_start();
include_once __DIR__ . '/controller/OrderController.php';
include_once __DIR__ . '/controller/CartController.php';
include_once __DIR__ . '/controller/ItemController.php';

if (isset($_POST['township_id'], $_POST['payment_id'], $_POST['item_ids'], $_POST['total_prices'], $_POST['quantities'], $_POST['subtotal'])) {
    $order_controller = new OrderController();
    $cart_controller = new CartController();
    $item_controller = new ItemController();

    $user_id = $_SESSION['id'];
    $township_id = $_POST['township_id'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $payment_id = $_POST['payment_id'];
    $item_ids = $_POST['item_ids'];
    $quantities = $_POST['quantities'];
    $total_prices = $_POST['total_prices'];
    $sub_total = $_POST['subtotal'];
    $order_code = rand(00001, 99999);
    $order_date = date('Y-m-d');
    date_default_timezone_set('Asia/Yangon');
    $order_time = date('H:i');

    if (!is_array($item_ids)) {
        $item_ids = array($item_ids);
        $quantities = array($quantities);
        $total_prices = array($total_prices);
    }

    foreach ($item_ids as $key => $item_id) {
        $quantity = $quantities[$key];
        $total_price = $total_prices[$key];

        $itemDetails = $item_controller->getItem($item_id);

        $success = $order_controller->addOrder($order_code, $quantity, $total_price, $order_date, $order_time, $user_id, $item_id, $township_id, $payment_id);

        echo $success;
        if ($success) {
            $cart_controller->removeCartItem($user_id, $item_id);
            echo "Order for item id $item_id added successfully<br>";
        } else {
            echo "Failed to add order for item id $item_id<br>";
        }
    }

    $order_details_success = $order_controller->addOrderDetails($order_code, $sub_total, $order_date, $order_time, $user_id, $township_id, $address, $phone, $payment_id);

    if ($order_details_success) {
        echo "Order details added successfully<br>";
    } else {
        echo "Failed to add order details<br>";
    }
} else {
    http_response_code(400);
    echo json_encode(array('error' => 'Missing required data'));
}

?>
