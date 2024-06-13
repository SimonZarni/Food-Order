<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Promotion
{
    private $conn, $statement;

    public function getPromotionRestaurants()
    {
        $this->conn = Database::connect();
        $sql = "SELECT restaurant.*, promotion.discount as discount, restaurant.profile_img as image, restaurant.id as restaurant_id
                FROM restaurant
                INNER JOIN promotion ON restaurant.id = promotion.restaurant_id";
        $this->statement = $this->conn->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getPromotionByRestaurant($restaurant_id)
    {
        $this->conn = Database::connect();
        $sql = "SELECT promotion.*, promotion.voucher_code as voucher_code, promotion.discount as discount
                FROM promotion
                JOIN restaurant ON promotion.restaurant_id = restaurant.id
                WHERE promotion.restaurant_id = :restaurant_id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':restaurant_id', $restaurant_id, PDO::PARAM_INT);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        return [];
    }
}
