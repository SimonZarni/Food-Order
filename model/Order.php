<?php
include_once __DIR__ . '/../include/dbconfig.php';

class Order {
    private $conn, $statement;

    public function addOrder($order_code, $quantity, $price, $order_date, $order_time, $user_id, $item_id, $township_id, $payment_id) 
    {
        $this->conn = Database::connect();
        $sql = "insert into `order`(order_code, quantity, total_price, order_date, order_time, user_id, item_id, township_id, payment_id) values(:order_code, :quantity, :total_price, :order_date, :order_time, :user_id, :item_id, :township_id, :payment_id)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':order_code', $order_code);
        $this->statement->bindParam(':quantity', $quantity);
        $this->statement->bindParam(':total_price', $price);
        $this->statement->bindParam(':order_date', $order_date);
        $this->statement->bindParam(':order_time', $order_time);
        $this->statement->bindParam(':user_id', $user_id);
        $this->statement->bindParam(':item_id', $item_id);
        $this->statement->bindParam(':township_id', $township_id);
        $this->statement->bindParam(':payment_id', $payment_id);
        return $this->statement->execute();
    }

    public function addOrderDetails($order_code, $subtotal, $order_date, $order_time, $user_id, $township_id, $address, $phone, $payment_id)
    {
        $this->conn = Database::connect();
        $status = ($payment_id == 5) ? 'Accepted' : 'Pending';
        $sql = "insert into order_details(order_code, subtotal, order_date, order_time, user_id, township_id, address, phone, status) values(:order_code, :subtotal, :order_date, :order_time, :user_id, :township_id, :address, :phone, :status)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':order_code', $order_code);
        $this->statement->bindParam(':subtotal', $subtotal);
        $this->statement->bindParam(':order_date', $order_date);
        $this->statement->bindParam(':order_time', $order_time);
        $this->statement->bindParam(':user_id', $user_id);
        $this->statement->bindParam(':township_id', $township_id);
        $this->statement->bindParam(':address', $address);
        $this->statement->bindParam(':phone', $phone);
        $this->statement->bindParam(':status', $status);
        $success = $this->statement->execute();
    
        if ($success && $status === 'Accepted') {
            $this->addDelivery($order_code, $user_id, $address, $order_date, $township_id, $status);
        }
    
    return $success;
    }

    public function addDelivery($order_code, $user_id, $address, $order_date, $township_id, $status)
    {
        $this->conn = Database::connect();
        $status = "Not Delivered"; 
        
        $sql = "INSERT INTO delivery (order_code, user_id, address, delivery_date, township_id, status) 
                VALUES (:order_code, :user_id, :address, :delivery_date, :township_id, :status)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':order_code', $order_code);
        $this->statement->bindParam(':user_id', $user_id);
        $this->statement->bindParam(':address', $address);
        $this->statement->bindParam(':delivery_date', $order_date);
        $this->statement->bindParam(':township_id', $township_id); 
        $this->statement->bindParam(':status', $status);
        return $this->statement->execute();
    }

    public function getOrdersByUser($user_id)
    {
        $this->conn = Database::connect();
        $sql = "SELECT order_details.*, user.name AS username, township.name AS township 
            FROM order_details
            JOIN user ON order_details.user_id = user.id
            JOIN township ON order_details.township_id = township.id
            WHERE order_details.user_id = :user_id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }


    public function getOrderByCode($order_code)
    {
        $this->conn = Database::connect();
        $sql = "SELECT `order`.*, order_details.*, order_details.subtotal, user.name as username, item.name as item, item.price as item_price, 
                township.name as township, township.fee as fee
                FROM `order`
                JOIN order_details ON `order`.order_code = order_details.order_code 
                JOIN user on `order`.user_id = user.id
                JOIN item on `order`.item_id = item.id
                JOIN township on `order`.township_id = township.id
                WHERE `order`.order_code = :order_code;";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':order_code', $order_code);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getOrderDetails($id){
        $this->conn = Database::connect();
        $sql = "SELECT order_details.* from `order_details` WHERE `order_details`.id= :id";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bindParam(':id', $id);
        if($this->statement->execute())
        {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }
}

?>