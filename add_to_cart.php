<?php
session_name('user');
session_start();
include_once __DIR__ . '/controller/CartController.php';
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['quantity']) && isset($_POST['item_id'])) {
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
    $item_id = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);

    if ($quantity === false || $item_id === false) {
        http_response_code(400);
        echo "Invalid input data";
        exit;
    }

    $user_id = $_SESSION['id'];

    $cart_controller = new CartController();

    if (!isset($_SESSION['cart_id'])) {
        $cart_id = $cart_controller->getCartIdByUser($user_id);
        $_SESSION['cart_id'] = $cart_id;
    } else {
        $cart_id = $_SESSION['cart_id'];
    }

    $result = $cart_controller->addToCart($user_id, $item_id, $quantity);

    if ($result) {
        ?>
        <div class="alert alert-success" id="success-alert" role="alert" style="display:none;">
            Item added to cart successfully!
        </div>
        <?php
    } else {
        ?>
        <div class="alert alert-danger" id="error-alert" role="alert" style="display:none;">
            Failed to add item to cart. Please try again later.
        </div>
        <?php
    }
} else {
    http_response_code(400);
    echo "Invalid request";
}
?>

