<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Promotion
{
    private $conn, $statement;

    public function getPromotionRestaurants()
    {
        $this->conn = Database::connect();
        $sql = "SELECT restaurant.*, promotion.discount as discount, promotion.name as discount_name, restaurant.profile_img as image, restaurant.id as restaurant_id
                FROM restaurant
                INNER JOIN promotion ON restaurant.id = promotion.restaurant_id";
        $this->statement = $this->conn->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getMenusAndItemsByRestaurantAndDiscount($restaurant_id, $discount)
    {
        $this->conn = Database::connect();
        $sql = "SELECT menu.*, menu.name AS menu_name, item.*, item.id AS item_id, item.name AS item_name, 
                restaurant.*, restaurant.name AS restaurant_name, promotion.discount, promotion.name AS discount_name
                FROM promotion 
                INNER JOIN item ON (item.id = promotion.item_id AND item.restaurant_id = :restaurant_id)
                OR (promotion.menu_id = item.menu_id AND item.restaurant_id = :restaurant_id) 
                INNER JOIN restaurant ON item.restaurant_id = restaurant.id
                INNER JOIN menu ON item.menu_id = menu.id"; 

        $params = [':restaurant_id' => $restaurant_id];

        if ($discount !== null) {
            $sql .= " AND promotion.discount = :discount";
            $params[':discount'] = $discount;
        }

        $sql .= " WHERE item.restaurant_id = :restaurant_id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->execute($params);
        $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}
