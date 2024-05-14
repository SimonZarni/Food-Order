<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Delivery {
    private $conn, $statement;

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