<?php
session_name('user');
session_start();

if (!isset($_SESSION['id'])) {
    header('location: login.php');
    exit;
}

include_once __DIR__ . '/controller/OrderController.php';
include_once __DIR__ . '/controller/CartController.php';

if (isset($_GET['order_code'])) {
    $order_code = $_GET['order_code'];
    $user_id = $_SESSION['id'];
    
    $order_controller = new OrderController();
    // Security fix: Verify order belongs to current user
    $order_items = $order_controller->getOrderByCodeAndUser($order_code, $user_id);
    
    if ($order_items && count($order_items) > 0) {
        $cart_controller = new CartController();
        $restaurant_id = null;
        $items_added = 0;
        $items_failed = 0;
        
        // Get restaurant_id from first item (all items in same order are from same restaurant)
        include_once __DIR__ . '/controller/ItemController.php';
        $item_controller = new ItemController();
        $first_item = $item_controller->getItem($order_items[0]['item_id']);
        if ($first_item) {
            $restaurant_id = $first_item['restaurant_id'];
        }
        
        foreach ($order_items as $item) {
            // Add item to cart
            $result = $cart_controller->addToCart($user_id, $item['item_id'], $item['quantity']);
            
            if ($result) {
                $items_added++;
            } else {
                $items_failed++;
            }
        }
        
        if ($items_added > 0) {
            // Redirect to cart with restaurant_id
            if ($restaurant_id) {
                header('location: cart.php?restaurant_id=' . $restaurant_id . '&reorder=success');
            } else {
                header('location: menu.php?reorder=success');
            }
        } else {
            header('location: orders.php?id=' . $user_id . '&reorder=failed');
        }
    } else {
        header('location: orders.php?id=' . $user_id . '&reorder=notfound');
    }
} else {
    header('location: menu.php');
}
?>
