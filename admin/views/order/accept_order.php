<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once __DIR__ . '/../../controller/OrderController.php';

$id = $_GET['id'];

$order_controller = new OrderController();
$accept = $order_controller->acceptOrder($id);
$orderDetails = $order_controller->getOrderDetails($id);
$addDelivery = $order_controller->addDelivery($orderDetails['order_code'], $orderDetails['user_id'], $orderDetails['address'], $orderDetails['order_date'], $orderDetails['township_id'], $orderDetails['status']);
if($accept)
{
    header('location: order_list.php?accept_status=accepted');
}

?>