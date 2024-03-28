<?php
include_once __DIR__ . '/../../controller/RestaurantController.php';
include_once __DIR__ . '/../../controller/RestaurantMenuController.php';

$id = $_GET['id'];
$restaurant_controller = new RestaurantController();

$restaurantMenu_controller = new RestaurantMenuController();
$restaurant_menus = $restaurantMenu_controller->getRestaurantMenus();

$related = false;
foreach($restaurant_menus as $restaurant_menu){
    if($restaurant_menu['id'] == $id){
        $related = true;
        break; 
    }
}

if(!$related){
    $status = $restaurant_controller->deleteRestaurant($id);
    header('location:restaurant_list.php?delete_status=success');
} else {
    header('location:restaurant_list.php?delete_status=fail');
}

?>
