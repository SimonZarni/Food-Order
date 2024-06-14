<?php
session_name('user');
session_start();

header('Content-Type: application/json');

include_once __DIR__ . '/controller/FavouriteController.php';

$response = ['success' => false, 'message' => ''];

try {
    if (!isset($_SESSION['id'])) {
        throw new Exception('User not logged in');
    }

    if (!isset($_POST['restaurant_id']) || !isset($_POST['is_liked'])) {
        throw new Exception('Invalid input');
    }

    $user_id = $_SESSION['id'];
    echo $user_id;
    $restaurant_id = $_POST['restaurant_id'];
    $is_liked = filter_var($_POST['is_liked'], FILTER_VALIDATE_BOOLEAN);

    $favourite_controller = new FavouriteController();

    if ($is_liked) {
        $favourite_controller->addToFavourite($user_id, $restaurant_id);
    } else {
        $favourite_controller->removeFavourite($user_id, $restaurant_id);
    }

    $response['success'] = true;
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>