<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Menu {
    private $conn, $statement;

    public function getMenus()
    {
        $this->conn = Database::connect();
        $sql = "select * from menu";
        $this->statement = $this->conn->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }
}

?>