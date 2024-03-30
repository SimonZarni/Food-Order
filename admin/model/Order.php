<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Order {
    private $conn, $statement;

    public function getOrders()
    {
        $this-> conn = Database::connect();
        $sql = "select `order`.*, user.name as username, payment.method as payment_method 
                from `order`
                join user on `order`.user_id = user.id
                join payment on `order`.payment_id = payment.id";
        $this->statement = $this->conn->prepare($sql);
        if($this->statement->execute())
        {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }   

    public function getOrder($id)
    {
        $this-> conn = Database::connect();
        $sql = "select `order`.*, user.name as username, payment.method as payment_method 
                from `order`
                join user on `order`.user_id = user.id
                join payment on `order`.payment_id = payment.id
                where `order`.id = :id";
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