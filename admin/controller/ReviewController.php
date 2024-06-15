<?php
include_once __DIR__ . '/../model/Review.php';

class ReviewController {
    private $review;
    function __construct()
    {
        $this->review = new Review();
    }

    public function getReviews()
    {
        return $this->review->getReviews();
    }

    public function deleteReview($id)
    {
        return $this->review->deleteReview($id);
    }
}

?>