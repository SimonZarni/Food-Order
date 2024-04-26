<?php
include_once __DIR__ . '/../../controller/OrderController.php';

$id = $_GET['id'];

$order_controller = new OrderController();
$accept = $order_controller->acceptOrder($id);

if($accept)
{
    header('location: order_list.php?accept_status=accepted');
}

?>