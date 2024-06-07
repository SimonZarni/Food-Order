<?php
session_name('user');
session_start();
include_once __DIR__ . '/controller/CartController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['user_id'], $data['item_id'])) {
        $cart_controller = new CartController();
        $user_id = $data['user_id'];
        $item_id = $data['item_id'];

        $success = $cart_controller->removeCartItem($user_id, $item_id);

        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Missing required data']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method']);
}

?>
