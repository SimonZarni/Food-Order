<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Promotion {
    private $conn, $statement;

    public function getPromotions()
    {
        $this->conn = Database::connect();
        $sql = "SELECT promotion.*, restaurant.profile_img as image, restaurant.name as restaurant_name
                FROM promotion
                JOIN restaurant ON promotion.restaurant_id = restaurant.id";
        $this->statement = $this->conn->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function addPromotion($restaurant, $discount, $voucher)
    {
        $this->conn = Database::connect();
        $sql = "insert into promotion(restaurant_id, discount, voucher_code) values(:restaurant, :discount, :voucher)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':restaurant', $restaurant);
        $this->statement->bindParam(':discount', $discount);
        $this->statement->bindParam(':voucher', $voucher);
        return $this->statement->execute();
    }

    public function getPromotion($id)
    {
        $this->conn = Database::connect();
        $sql = "SELECT promotion.*, restaurant.profile_img as image, restaurant.name as restaurant_name
                FROM promotion
                JOIN restaurant ON promotion.restaurant_id = restaurant.id
                WHERE promotion.id = :id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function editPromotion($id, $restaurant, $discount, $voucher)
    {
        $this->conn = Database::connect();
        $sql = "update promotion set restaurant_id = :restaurant, discount = :discount, voucher_code = :voucher where id = :id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        $this->statement->bindParam(':restaurant', $restaurant);
        $this->statement->bindParam(':discount', $discount);
        $this->statement->bindParam(':voucher', $voucher);
        return $this->statement->execute();
    }

    public function deletePromotion($id)
    {
        $this->conn = Database::connect();
        $sql = "delete from promotion where id = :id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        return $this->statement->execute();
    }
}

?>