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

    public function getTotalDeliveries()
    {
        $this->conn = Database::connect();
        $sql = "SELECT COUNT(*) AS total_deliveries FROM delivery";
        $this->statement = $this->conn->prepare($sql);
        if ($this->statement->execute()) {
            $result = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $result['total_deliveries'];
        } else {
            return 0; // Return 0 if query fails or no deliveries found
        }
    }

    public function getTotalDeliveredDeliveries()
    {
        $this->conn = Database::connect();
        $sql = "SELECT COUNT(*) AS total_delivered_deliveries FROM delivery WHERE status = 'Delivered'";
        $this->statement = $this->conn->prepare($sql);
        if ($this->statement->execute()) {
            $result = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $result['total_delivered_deliveries'];
        } else {
            return 0; // Return 0 if query fails or no delivered deliveries found
        }
    }

    public function getTotalUndeliveredDeliveries()
    {
        $this->conn = Database::connect();
        $sql = "SELECT COUNT(*) AS total_undelivered_deliveries FROM delivery WHERE status = 'Not Delivered'";
        $this->statement = $this->conn->prepare($sql);
        if ($this->statement->execute()) {
            $result = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $result['total_undelivered_deliveries'];
        } else {
            return 0; // Return 0 if query fails or no undelivered deliveries found
        }
    }
}

?>