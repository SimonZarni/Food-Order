<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Order {
    private $conn, $statement;

    public function addOrder($total_price, $order_date, $user_id, $item_id, $township_id, $payment_id) 
    {
        $this->conn = Database::connect();
        $sql = "insert into `order`(total_price, order_date, user_id, item_id, township_id, payment_id) values(:total_price, :order_date, :user_id, :item_id, :township_id, :payment_id)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':total_price', $total_price);
        $this->statement->bindParam(':order_date', $order_date);
        $this->statement->bindParam(':user_id', $user_id);
        $this->statement->bindParam(':item_id', $item_id);
        $this->statement->bindParam(':township_id', $township_id);
        $this->statement->bindParam(':payment_id', $payment_id);
        return $this->statement->execute();
    }
}

?>