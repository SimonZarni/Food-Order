<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Item
{
    private $conn, $statement;

    public function getItems()
    {
        $this->conn = Database::connect();
        $sql = "SELECT item.*, restaurant.name AS restaurant_name, menu.name AS menu_name
                FROM item
                JOIN restaurant ON item.restaurant_id = restaurant.id
                JOIN menu ON item.menu_id = menu.id;";
        $this->statement = $this->conn->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function addItem($name, $image, $price, $description, $restaurant, $menu)
    {
        $this->conn = Database::connect();
        $sql = "insert into item(name, image, price, description, restaurant_id, menu_id) values(:name, :image, :price, :description, :restaurant_id, :menu_id)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':name', $name);
        $this->statement->bindParam(':image', $image);
        $this->statement->bindParam(':price', $price);
        $this->statement->bindParam(':description', $description);
        $this->statement->bindParam(':restaurant_id', $restaurant);
        $this->statement->bindParam(':menu_id', $menu);
        return $this->statement->execute();
    }

    public function getItem($id)
    {
        $this->conn = Database::connect();
        $sql = "SELECT item.*, restaurant.name AS restaurant_name, menu.name AS menu_name
                FROM item
                JOIN restaurant ON item.restaurant_id = restaurant.id
                JOIN menu ON item.menu_id = menu.id 
                where item.id=:id;";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function editItem($id, $name, $image, $price, $description, $restaurant, $menu)
    {
        $this->conn = Database::connect();
        $sql = "update item set name=:name, image=:image, price=:price, description=:description, restaurant_id=:restaurant_id, menu_id=:menu_id where id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        $this->statement->bindParam(':name', $name);
        $this->statement->bindParam(':image', $image);
        $this->statement->bindParam(':price', $price);
        $this->statement->bindParam(':description', $description);
        $this->statement->bindParam(':restaurant_id', $restaurant);
        $this->statement->bindParam(':menu_id', $menu);
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
