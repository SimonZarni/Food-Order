<?php
session_name('user');
session_start();
include_once __DIR__ . '/controller/FavouriteController.php';

// $user_id = $_SESSION['id'];
// $restaurant_id = $_POST['restaurant_id'];

// $favourite_controller = new FavouriteController();
// $response = ['success' => false];
// if ($favourite_controller->addToFavourite($user_id, $restaurant_id)) {
//     $response['success'] = true;
// }

// header('Content-Type: application/json');

// echo json_encode($response);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['id'];
    $restaurant_id = $_POST['restaurant_id'];

    $favourite_controller = new FavouriteController();
    $result = $favourite_controller->addToFavourite($user_id, $restaurant_id);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Added to favourites']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add to favourites']);
    }
}
