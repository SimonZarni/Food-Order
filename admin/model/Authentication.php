<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Authentication {
    private $conn, $statement;

    public function createAdmin($name, $email, $password)
    {
        $this->conn = Database::connect();
        $sql = "insert into admin(name, email, password) values(:name, :email, :password)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':name', $name);
        $this->statement->bindParam(':email', $email);
        $this->statement->bindParam(':password', $password);
        return $this->statement->execute();
    }

    public function getAdmins()
    {
        $this->conn = Database::connect();
        $sql = "select * from admin";
        $this->statement = $this->conn->prepare($sql);
        if($this->statement->execute())
        {
            $results =  $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function isEmailExists($email){
        $this->conn = Database::connect();
        $sql = "select COUNT(*) as count from admin where email = :email";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':email',$email);
        $this->statement->execute();
        $count = $this->statement->fetchColumn();
        return $count > 0;
    }
}

?>