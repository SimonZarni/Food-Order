<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Cart {
    private $conn, $statement;

    public function getCarts()
    {
        $this->conn = Database::connect();
        $sql = "select * from cart";
        $this->statement = $this->conn->prepare($sql);
        if($this->statement->execute())
        {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }
    
    public function addToCart($user_id, $item_id, $quantity)
    {
        $this->conn = Database::connect();
        $sql = "insert into cart(user_id, item_id, quantity) values(:user_id, :item_id, :quantity)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':user_id', $user_id);
        $this->statement->bindParam(':item_id', $item_id);
        $this->statement->bindParam(':quantity', $quantity);
        return $this->statement->execute();
    }

    function getCartIdByUser($user_id)
    {
        $this->conn = Database::connect();
        $sql = "select * from cart where user_id = :user_id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':user_id', $user_id);
        if($this->statement->execute())
        {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getCartDetails($user_id) 
    {
        $this->conn = Database::connect();
        $sql = "SELECT item.*, cart.quantity
                FROM item
                INNER JOIN cart ON item.id = cart.item_id
                WHERE cart.user_id = :user_id";      
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':user_id', $user_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCartById($id)
    {
        $this->conn = Database::connect();
        $sql = "select * from cart where id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        if($this->statement->execute())
        {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function removeCartItem($user_id, $item_id) 
    {
        $this->conn = Database::connect();       
        $sql = "delete from cart where user_id = :user_id and item_id = :item_id";
        $statement = $this->conn->prepare($sql);       
        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':item_id', $item_id);      
        return $statement->execute();
    }
}

?>