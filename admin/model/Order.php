<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Order {
    private $conn, $statement;  

    public function getOrders()
    {
        $this-> conn = Database::connect();
        $sql = "select order_details.*, user.name as username, township.name as township 
                from order_details
                join user on order_details.user_id = user.id
                join township on order_details.township_id = township.id";
        $this->statement = $this->conn->prepare($sql);
        if($this->statement->execute())
        {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getOrderByCode($order_code)
    {
        $this-> conn = Database::connect();
        $sql = "SELECT `order`.*, order_details.*, order_details.subtotal, user.name as username, item.name as item, item.price as item_price, 
                township.name as township, township.fee as fee
                FROM `order`
                JOIN order_details ON `order`.order_code = order_details.order_code 
                JOIN user on `order`.user_id = user.id
                JOIN item on `order`.item_id = item.id
                JOIN township on `order`.township_id = township.id
                WHERE `order`.order_code = :order_code;";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':order_code', $order_code);
        if($this->statement->execute())
        {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }  

    public function getOrderCodeById($id)
    {
        $this->conn = Database::connect();
        $sql = "select * from order_details where id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        if($this->statement->execute())
        {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getEmailByOrder($order_id)
    {
        $this->conn = Database::connect();
        $sql = "select user.email from user
                join order_details on user.id = order_details.user_id
                where order_details.id = :id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $order_id);
        if($this->statement->execute())
        {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function acceptOrder($order_id)
    {
        $this->conn = Database::connect();
        $sql = "update order_details set status='Accepted' where id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $order_id);
        return $this->statement->execute();
    }

    public function declineOrder($order_id)
    {
        $this->conn = Database::connect();
        $sql = "update order_details set status='Declined' where id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $order_id);
        return $this->statement->execute();
    }
}

?>