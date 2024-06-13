<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Cart
{
    private $conn, $statement;

    public function getCarts()
    {
        $this->conn = Database::connect();
        $sql = "select * from cart";
        $this->statement = $this->conn->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function addToCart($user_id, $item_id, $quantity)
    {
        $this->conn = Database::connect();
        $sql = "insert into cart(user_id, item_id, quantity) values(:user_id, :item_id, :quantity)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':user_id', $user_id);
        $this->statement->bindParam(':item_id', $item_id);
        $this->statement->bindParam(':quantity', $quantity);
        return $this->statement->execute();
    }

    function getCartIdByUser($user_id)
    {
        $this->conn = Database::connect();
        $sql = "select * from cart where user_id = :user_id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':user_id', $user_id);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getCartDetails($user_id, $restaurant_id)
    {
        $this->conn = Database::connect();
        $sql = "SELECT item.*, cart.quantity, cart.id as cart_id, restaurant.name as restaurant_name, item.id as item_id
                FROM item
                INNER JOIN cart ON item.id = cart.item_id
                INNER JOIN restaurant ON item.restaurant_id = restaurant.id
                WHERE cart.user_id = :user_id AND item.restaurant_id = :restaurant_id";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':restaurant_id', $restaurant_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCartById($id)
    {
        $this->conn = Database::connect();
        $sql = "select * from cart where id=:id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function removeCartItem($user_id, $item_id)
    {
        $this->conn = Database::connect();
        $sql = "delete from cart where user_id = :user_id and item_id = :item_id";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':item_id', $item_id);
        return $statement->execute();
    }

    public function checkItemInCart($item_id, $user_id)
    {
        $this->conn = Database::connect();
        $sql = "SELECT COUNT(*) AS num_items FROM cart WHERE item_id = :item_id AND user_id = :user_id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':item_id', $item_id);
        $this->statement->bindParam(':user_id', $user_id);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getCartItemCountByUser($user_id, $restaurant_id)
    {
        $this->conn = Database::connect();
        $sql = "SELECT COUNT(*) AS cart_count 
                FROM cart 
                INNER JOIN item ON cart.item_id = item.id
                WHERE cart.user_id = :user_id 
                AND item.restaurant_id = :restaurant_id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':user_id', $user_id);
        $this->statement->bindParam(':restaurant_id', $restaurant_id);
        if ($this->statement->execute()) {
            $result = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $result['cart_count'];
        }
        return 0;
    }

    public function updateCartQuantity($cart_id, $quantity)
    {
        $this->conn = Database::connect();
        $sql = "UPDATE cart SET quantity = :quantity WHERE id = :id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':quantity', $quantity);
        $this->statement->bindParam(':id', $cart_id);
        return $this->statement->execute();
    }
}
