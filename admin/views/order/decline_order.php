<?php
include_once __DIR__ . '/../../controller/OrderController.php';

$id = $_GET['id'];

$order_controller = new OrderController();
$decline = $order_controller->declineOrder($id);

if($decline)
{
    header('location: order_list.php?decline_status=accepted');
}

?>