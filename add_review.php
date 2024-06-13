<?php
session_name('user');
session_start();
include_once __DIR__ . '/controller/ReviewController.php';

if (isset($_SESSION['id']))
    $user = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['rating'], $_POST['review'], $_POST['item_id'], $_POST['restaurant_id'])) {
        $rating = $_POST['rating'];
        $review = $_POST['review'];
        $date = date('Y-m-d');
        $item = $_POST['item_id'];
        $restaurant = $_POST['restaurant_id'];

        $review_controller = new ReviewController();
        $result = $review_controller->addReview($rating, $review, $date, $restaurant, $user, $item);

        // Return response
        if ($result) {
            echo "Review submitted successfully";
        } else {
            echo "Error submitting review";
        }
    }
}

?>