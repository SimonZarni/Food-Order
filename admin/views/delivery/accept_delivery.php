<?php
include_once __DIR__ . '/../../controller/DeliveryController.php';

$id = $_GET['id'];

$delivery_controller = new DeliveryController();
$accept = $delivery_controller->acceptDelivery($id);

if($accept)
{
    header('location: delivery_list.php?confirm_status=accepted');
}

?>