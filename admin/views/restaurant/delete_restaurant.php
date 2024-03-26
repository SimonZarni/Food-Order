<?php
include_once __DIR__ . '/../../controller/RestaurantController.php';

$id = $_GET['id'];
$restaurant_controller = new RestaurantController();

$status = $restaurant_controller->deleteRestaurant($id);
if ($status) {
    header('location:restaurant_list.php?delete_status=success');
} else {
    header('location:restaurant_list.php?delete_status=fail');
}

?>
