<?php
include_once __DIR__ . '/../model/Review.php';

class ReviewController {
    private $review;
    function __construct()
    {
        $this->review = new Review();
    }

    public function fetchReviewsByRestaurant($restaurant_id)
    {
        return $this->review->fetchReviewsByRestaurant($restaurant_id);
    }

    public function calculateRating($reviews)
    {
        return $this->review->calculateRating($reviews);
    }

    public function fetchAverageRatingsForAllRestaurants()
    {
        return $this->review->fetchAverageRatingsForAllRestaurants();
    }

    public function addReview($rating, $review, $date, $restaurant, $user, $item)
    {
        return $this->review->addReview($rating, $review, $date, $restaurant, $user, $item);
    }
}
