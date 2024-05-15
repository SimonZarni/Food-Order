<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Restaurant {
    private $conn, $statement;

    public function getRestaurants()
    {
        $this->conn = Database::connect();
        $sql = "select * from restaurant";
        $this->statement = $this->conn->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getRestaurantsByMenu($menu_id)
    {
        $this->conn = Database::connect();
        $sql = "SELECT r.* 
                FROM restaurant AS r 
                JOIN restaurant_menu AS rm ON r.id = rm.restaurant_id
                WHERE rm.menu_id = :menu_id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':menu_id', $menu_id, PDO::PARAM_INT);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }
}

?>