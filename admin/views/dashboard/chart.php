<?php
include_once __DIR__ . '/../../controller/OrderController.php';

$order_controller = new OrderController();
$orders = $order_controller->getDeliveredOrders();

if ($orders) {
    header('Content-Type: application/json');

    echo json_encode($orders);
} else {
    echo json_encode([]);
}

?>