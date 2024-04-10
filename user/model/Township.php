<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Township {
    private $conn, $statement;

    public function getTownships()
    {
        $this->conn = Database::connect();
        $sql = "select * from township";
        $this->statement = $this->conn->prepare($sql);
        if($this->statement->execute())
        {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }
}

?>