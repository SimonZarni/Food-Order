<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Favourite
{
    private $conn, $statement;

    public function addToFavourite($user_id, $restaurant_id)
    {
        $this->conn = Database::connect();
        $sql = "INSERT INTO favourite (user_id, restaurant_id) VALUES (:user_id, :restaurant_id)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':user_id', $user_id);
        $this->statement->bindParam(':restaurant_id', $restaurant_id);
        return $this->statement->execute();
    }

    public function isFavourite($user_id, $restaurant_id)
    {
        $this->conn = Database::connect();
        $sql = "SELECT COUNT(*) AS count FROM favourite WHERE user_id = :user_id AND restaurant_id = :restaurant_id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':user_id', $user_id);
        $this->statement->bindParam(':restaurant_id', $restaurant_id);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return ($results['count'] > 0);
        }
    }

    public function getFavouriteRestaurants($user_id)
    {
        $this->conn = Database::connect();
        $sql = "SELECT r.* FROM favourite f
            JOIN restaurant r ON f.restaurant_id = r.id
            WHERE f.user_id = :user_id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':user_id', $user_id);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function removeFavourite($user_id, $restaurant_id)
    {
        $this->conn = Database::connect();
        $sql = "DELETE FROM favourite WHERE user_id = :user_id AND restaurant_id = :restaurant_id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':user_id', $user_id);
        $this->statement->bindParam(':restaurant_id', $restaurant_id);
        return $this->statement->execute();
    }
}
