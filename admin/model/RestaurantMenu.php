<?php
include_once __DIR__ . '/../include/dbconfig.php';

class RestaurantMenu {
    private $conn, $statement;
    
    public function getRestaurantMenus()
    {
        $this->conn = Database::connect();
        $sql = "select restaurant_menu.*, restaurant.name as restaurant, 
                menu.name as menu, menu.image as image from restaurant_menu 
                join restaurant ON restaurant_menu.restaurant_id = restaurant.id 
                join menu ON restaurant_menu.menu_id = menu.id;";
        $this->statement = $this->conn->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function addRestaurantMenu($restaurant, $menu, $restaurant_menu)
    {
        $this->conn = Database::connect();
        $sql = "INSERT INTO restaurant_menu (restaurant_id, menu_id, restaurant_menu) VALUES (:restaurant, :menu, :restaurant_menu)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':restaurant', $restaurant);
        $this->statement->bindParam(':menu', $menu);
        $this->statement->bindParam(':restaurant_menu', $restaurant_menu);
        return $this->statement->execute();
    }

    public function getRestaurantMenu($id)
    {
        $this->conn = Database::connect();
        $sql = "select restaurant_menu.*, restaurant.name as restaurant, 
                menu.name as menu, menu.image as image from restaurant_menu 
                join restaurant ON restaurant_menu.restaurant_id = restaurant.id 
                join menu ON restaurant_menu.menu_id = menu.id
                where restaurant_menu.id=:id;";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function editRestaurantMenu($id, $restaurant, $menu, $restaurant_menu)
    {
        $this->conn = Database::connect();
        $sql = "update restaurant_menu set restaurant_id=:restaurant, menu_id=:menu, restaurant_menu=:restaurant_menu where id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        $this->statement->bindParam(':restaurant', $restaurant);
        $this->statement->bindParam(':menu', $menu);
        $this->statement->bindParam(':restaurant_menu', $restaurant_menu);
        return $this->statement->execute();
    }

    public function deleteRestaurantMenu($id)
    {
        $status = "deleted";
        $this->conn = Database::connect();
        $sql = "update restaurant_menu SET status=:status WHERE id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        $this->statement->bindParam(':status', $status);
        return $this->statement->execute();
    }
}
