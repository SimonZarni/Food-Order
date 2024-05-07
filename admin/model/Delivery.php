<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Delivery {
    private $conn, $statement;

    public function addDelivery($order_id, $township_id, $phone, $address)
    {
        $this->conn = Database::connect();
        $sql = "INSERT INTO delivery(order_id, township_id, phone, address) 
                VALUES(:order_id, :township_id, :phone, :address)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':order_id', $order_id);
        $this->statement->bindParam(':township_id', $township_id);
        $this->statement->bindParam(':phone', $phone);
        $this->statement->bindParam(':address', $address);
        return $this->statement->execute();
    }

    public function getDeliveries()
    {
        $this-> conn = Database::connect();
        $sql = "select delivery.*, township.name as township, user.name as user
                from delivery
                join user on delivery.user_id = user.id
                join township on delivery.township_id = township.id";
        $this->statement = $this->conn->prepare($sql);
        if($this->statement->execute())
        {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }   

    public function getDelivery($id)
    {
        $this-> conn = Database::connect();
        $sql = "select delivery.*, township.name as township
                from delivery
                join township on delivery.township_id = township.id
                where delivery.id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        if($this->statement->execute())
        {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function acceptDelivery($id)
    {
        $this->conn = Database::connect();
        $sql = "update delivery set status='Delivered' where id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        return $this->statement->execute();
    }
}

?>