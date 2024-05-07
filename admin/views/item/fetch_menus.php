<?php
include_once __DIR__ . '/../../controller/MenuController.php';

$menu_controller = new MenuController();

if(isset($_GET['restaurant_id'])) {
    $restaurantId = $_GET['restaurant_id'];
    $menuOptions = $menu_controller->getMenuByRestaurant($restaurantId);
    header('Content-Type: application/json');
    
    echo json_encode($menuOptions);
} else {
    http_response_code(400);
    echo json_encode(array("error" => "Restaurant ID is required"));
}

?>
