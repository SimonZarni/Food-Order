<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Item {
    private $conn, $statement;

    public function getItems() 
    {
        $this->conn = Database::connect();
        $sql = "SELECT * from item where status!='deleted'";
        $this->statement = $this->conn->prepare($sql);
        if($this->statement->execute()){
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getItemsByRestaurantMenu($restaurant_id, $menu_id) 
    {
        $this->conn = Database::connect();
        $sql = "SELECT i.* 
                FROM item AS i 
                JOIN restaurant_menu AS rm ON i.restaurant_menuID = rm.id
                WHERE rm.menu_id = :menu_id AND rm.restaurant_id = :restaurant_id and i.status != 'deleted'";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':restaurant_id', $restaurant_id, PDO::PARAM_INT);
        $this->statement->bindParam(':menu_id', $menu_id, PDO::PARAM_INT);
        if($this->statement->execute()){
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
        if($this->statement->execute())
        {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }
    
}

?>