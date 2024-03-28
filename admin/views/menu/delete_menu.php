<?php
include_once __DIR__ . '/../../controller/MenuController.php';
include_once __DIR__ . '/../../controller/RestaurantMenuController.php';

$id = $_GET['id'];
$menu_controller = new MenuController();

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
    $status = $menu_controller->deleteMenu($id);
    header('location:menu_list.php?delete_status=success');
} else {
    header('location:menu_list.php?delete_status=fail');
}

?>
