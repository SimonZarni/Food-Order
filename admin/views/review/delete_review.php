<?php
include_once __DIR__ . '/../../controller/ReviewController.php';

$id = $_GET['id'];

$review_controller = new ReviewController();
$status = $review_controller->deleteReview($id);

if($status){
    header('location: review_list.php?delete_status');
}

?>