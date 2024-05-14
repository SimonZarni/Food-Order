<?php
session_name('user');
session_start();
include_once __DIR__ . '/controller/FavouriteController.php';

$user_id = $_SESSION['id'];
$restaurant_id = $_POST['restaurant_id'];

$favourite_controller = new FavouriteController();
$response = ['success' => false];
if ($favourite_controller->addToFavourite($user_id, $restaurant_id)) {
    $response['success'] = true;
}

header('Content-Type: application/json');

echo json_encode($response);

?>
