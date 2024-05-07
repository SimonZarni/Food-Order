<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Payment {
    private $conn, $statement;

    public function getPayments()
    {
        $this->conn = Database::connect();
        $sql = "select * from payment";
        $this->statement = $this->conn->prepare($sql);
        if($this->statement->execute())
        {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }
}

?>