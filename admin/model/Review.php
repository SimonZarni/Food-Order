<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Review {
    private $conn, $statement;

    public function getReviews()
    {
        $this->conn = Database::connect();
        $sql = "SELECT review.*, user.name AS username, item.name AS item_name, item.price AS item_price, item.image AS item_image, restaurant.name AS restaurant_name
                FROM review
                JOIN user ON review.user_id = user.id
                JOIN item ON review.item_id = item.id
                JOIN restaurant ON review.restaurant_id = restaurant.id";
        $this->statement = $this->conn->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function deleteReview($id)
    {
        $this->conn = Database::connect();
        $sql = "delete from review where id = :id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        return $this->statement->execute();
    }
}

?>