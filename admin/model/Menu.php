<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Menu {
    private $conn, $statement;

    public function getMenus(){
        $this->conn = Database::connect();
        $sql = "select * from menu";
        $this->statement = $this->conn->prepare($sql);
        if($this->statement->execute()){
            $results=$this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function addMenu($name, $image){
        $this->conn = Database::connect();
        $sql = "insert into menu (name,image) values (:name, :image)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':name', $name);
        $this->statement->bindParam(':image', $image);
        return $this->statement->execute();
    }
}

?>