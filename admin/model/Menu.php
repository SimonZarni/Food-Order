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

    public function addMenu($name, $image)
    {
        $this->conn = Database::connect();
        $sql = "insert into menu (name,image) values (:name, :image)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':name', $name);
        $this->statement->bindParam(':image', $image);
        return $this->statement->execute();
    }

    public function getMenu($id)
    {
        $this->conn = Database::connect();
        $sql = "select * from menu where id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function editMenu($id, $name, $image)
    {
        $this->conn = Database::connect();
        $sql = "update menu set name=:name,image=:image where id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        $this->statement->bindParam(':name', $name);
        $this->statement->bindParam(':image', $image);
        return $this->statement->execute();
    }

    public function deleteMenu($id)
    {
        $status = 'deleted';
        $this->conn = Database::connect();
        $sql = "update menu set status=:status where id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        $this->statement->bindParam(':status', $status);
        return $this->statement->execute();
    }
}
