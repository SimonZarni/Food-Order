<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Review {
    private $conn, $statement;

    public function fetchReviewsByRestaurant($restaurant_id)
    {
        $this->conn = Database::connect();
        $sql = "SELECT review.*, user.name AS user_name, item.name AS item_name, item.price AS item_price, item.image AS item_image, restaurant.name AS restaurant_name
                FROM review
                JOIN user ON review.user_id = user.id
                JOIN item ON review.item_id = item.id
                JOIN restaurant ON review.restaurant_id = restaurant.id
                WHERE review.restaurant_id = :restaurant_id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':restaurant_id', $restaurant_id, PDO::PARAM_INT);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function calculateRating($reviews)
    {
        // Check if $reviews is valid and not null
        if (!is_array($reviews) || empty($reviews)) {
            return [
                'average' => 0,
                'count' => 0,
                'distribution' => [
                    5 => 0,
                    4 => 0,
                    3 => 0,
                    2 => 0,
                    1 => 0,
                ]
            ];
        }

        // Calculate average rating and distribution
        $ratings_count = array_count_values(array_column($reviews, 'rating'));
        $total_reviews = count($reviews);
        $sum_ratings = array_sum(array_map(function ($rating, $count) {
            return $rating * $count;
        }, array_keys($ratings_count), $ratings_count));
        $average_rating = $total_reviews ? $sum_ratings / $total_reviews : 0;

        return [
            'average' => round($average_rating, 1),
            'count' => $total_reviews,
            'distribution' => [
                5 => $ratings_count[5] ?? 0,
                4 => $ratings_count[4] ?? 0,
                3 => $ratings_count[3] ?? 0,
                2 => $ratings_count[2] ?? 0,
                1 => $ratings_count[1] ?? 0,
            ]
        ];
    }
    
    public function fetchAverageRatingsForAllRestaurants()
    {
        $this->conn = Database::connect();
        $sql = "SELECT 
                restaurant.id AS restaurant_id,
                restaurant.name AS restaurant_name,
                COALESCE(AVG(review.rating), 0) AS average_rating,
                COUNT(review.id) AS review_count
            FROM restaurant
            LEFT JOIN review ON restaurant.id = review.restaurant_id
            GROUP BY restaurant.id";

        $this->statement = $this->conn->prepare($sql);
        if ($this->statement->execute()) {
            return $this->statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function addReview($rating, $review, $date, $restaurant, $user, $item)
    {
        $this->conn = Database::connect();
        $sql = "INSERT INTO review (restaurant_id, user_id, rating, review, date, item_id) 
        VALUES (:restaurant_id, :user_id, :rating, :review, :date, :item_id)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':restaurant_id', $restaurant);
        $this->statement->bindParam(':user_id', $user);
        $this->statement->bindParam(':rating', $rating);
        $this->statement->bindParam(':date', $date);
        $this->statement->bindParam(':review', $review);
        $this->statement->bindParam(':item_id', $item);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }
}

?>