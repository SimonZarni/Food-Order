<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Menu {
    private $conn, $statement;

    public function getMenus()
    {
        $this->conn = Database::connect();
        $sql = "select * from menu";
        $this->statement = $this->conn->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getMenusByRestaurant($restaurant_id) 
    {
        $this->conn = Database::connect();
        $sql = "SELECT m.* 
                FROM menu AS m 
                JOIN restaurant_menu AS rm ON m.id = rm.menu_id
                WHERE rm.restaurant_id = :restaurant_id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':restaurant_id', $restaurant_id, PDO::PARAM_INT);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }
    
}

?>