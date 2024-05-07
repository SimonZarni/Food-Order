<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Item
{
    private $conn, $statement;

    // public function getMenusAndItemsByRestaurant($restaurant_id)
    // {
    //     $this->conn = Database::connect();
    //     $sql = "SELECT menu.*, menu.name as menu_name, item.*,item.id as item_id, item.name as item_name, restaurant.*, restaurant.name as restaurant_name
    //         FROM menu 
    //         INNER JOIN restaurant_menu ON menu.id = restaurant_menu.menu_id 
    //         LEFT JOIN item ON item.restaurant_menuID = restaurant_menu.ID
    //         INNER JOIN restaurant ON restaurant.id = restaurant_menu.restaurant_id
    //         WHERE restaurant_menu.restaurant_id = :restaurant_id";
    //     $this->statement = $this->conn->prepare($sql);
    //     $this->statement->bindParam(':restaurant_id', $restaurant_id, PDO::PARAM_INT);
    //     if ($this->statement->execute()) {
    //         $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
    //         return $results;
    //     }
    // }

    public function getMenusAndItemsByRestaurant($restaurant_id)
    {
        $this->conn = Database::connect();
        $sql = "SELECT menu.*, menu.name AS menu_name, item.*, item.id AS item_id, item.name AS item_name, restaurant.*, restaurant.name AS restaurant_name
                FROM item
                INNER JOIN menu ON item.menu_id = menu.id
                INNER JOIN restaurant ON item.restaurant_id = restaurant.id
                WHERE item.restaurant_id = :restaurant_id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':restaurant_id', $restaurant_id, PDO::PARAM_INT);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getItem($id)
    {
        $this->conn = Database::connect();
        $sql = "select * from item where id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

}
