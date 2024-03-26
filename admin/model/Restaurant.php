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

    public function addRestaurant($name, $address)
    {
        $this->conn = Database::connect();
        $sql = "INSERT INTO restaurant (name, address) VALUES (:name, :address)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':name', $name);
        $this->statement->bindParam(':address', $address);
        return $this->statement->execute();
    }

    public function getRestaurant($id)
    {
        $this->conn = Database::connect();
        $sql = "select * from restaurant where id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function editRestaurant($id, $name, $address)
    {
        $this->conn = Database::connect();
        $sql = "UPDATE restaurant SET name=:name, address=:address WHERE id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        $this->statement->bindParam(':name', $name);
        $this->statement->bindParam(':address', $address);
        return $this->statement->execute();
    }

    public function deleteRestaurant($id)
    {
        $status = "deleted";
        $this->conn = Database::connect();
        $sql = "UPDATE restaurant SET status=:status WHERE id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        $this->statement->bindParam(':status', $status);
        return $this->statement->execute();
    }
}
