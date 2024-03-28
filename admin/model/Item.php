<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Item {
    private $conn, $statement;

    public function getItems()
    {
        $this->conn = Database::connect();
        $sql = "select item.*, restaurant_menu.restaurant_menu as restaurant_menu from item
                join restaurant_menu on item.restaurant_menuID=restaurant_menu.id";
        $this->statement = $this->conn->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function addItem($name, $image, $price, $description, $restaurant_menu)
    {
        $this->conn = Database::connect();
        $sql = "insert into item(name, image, price, description, restaurant_menuID) values(:name, :image, :price, :description, :restaurant_menu)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':name', $name);
        $this->statement->bindParam(':image', $image);
        $this->statement->bindParam(':price', $price);
        $this->statement->bindParam(':description', $description);
        $this->statement->bindParam(':restaurant_menu', $restaurant_menu);
        return $this->statement->execute();
    }

    public function getItem($id)
    {
        $this->conn = Database::connect();
        $sql = "select item.*, restaurant_menu.restaurant_menu as restaurant_menu from item
                join restaurant_menu on item.restaurant_menuID=restaurant_menu.id
                where item.id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function editItem($id, $name, $image, $price, $description, $restaurant_menu)
    {
        $this->conn = Database::connect();
        $sql = "update item set name=:name, image=:image, price=:price, description=:description, restaurant_menuID=:restaurant_menu where id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        $this->statement->bindParam(':name', $name);
        $this->statement->bindParam(':image', $image);
        $this->statement->bindParam(':price', $price);
        $this->statement->bindParam(':description', $description);
        $this->statement->bindParam(':restaurant_menu', $restaurant_menu);
        return $this->statement->execute();
    }

    public function deleteItem($id)
    {
        $status = 'deleted';
        $this->conn = Database::connect();
        $sql = "update item set status=:status where id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        $this->statement->bindParam(':status', $status);
        return $this->statement->execute();
    }
}
