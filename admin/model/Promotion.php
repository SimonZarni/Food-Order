<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Promotion {
    private $conn, $statement;

    public function getPromotions()
    {
        $this->conn = Database::connect();
        $sql = "select ";
    }
}

?>