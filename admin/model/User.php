<?php
include_once __DIR__ . '/../include/dbconfig.php';

class User {
    private $conn, $statement;

    public function getUsers()
    {
        $this-> conn = Database::connect();
        $sql = "select * from user";
        $this->statement = $this->conn->prepare($sql);
        if($this->statement->execute())
        {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getUser($id)
    {
        $this-> conn = Database::connect();
        $sql = "select * from user where id=:id";
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