<?php
include_once __DIR__ . '/../../controller/RestaurantMenuController.php';

$id = $_GET['id'];
$restaurantMenu_controller = new RestaurantMenuController();

$status = $restaurantMenu_controller->deleteRestaurantMenu($id);
if ($status) {
    header('location:restaurantMenu_list.php?delete_status=success');
} else {
    header('location:restaurantMenu_list.php?delete_status=fail');
}

?>
