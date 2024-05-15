<?php
include_once __DIR__ . '/../model/Order.php';

class OrderController {
    private $order;
    function __construct()
    {
        $this->order = new Order();
    }

    public function addOrder($order_code, $quantity, $price, $order_date, $order_time, $user_id, $item_id, $township_id, $payment_id)
    {
        return $this->order->addOrder($order_code, $quantity, $price, $order_date, $order_time, $user_id, $item_id, $township_id, $payment_id);
    }

    public function addOrderDetails($order_code, $subtotal, $order_date, $order_time, $user_id, $township_id, $address, $phone, $payment_id)
    {
        return $this->order->addOrderDetails($order_code, $subtotal, $order_date, $order_time, $user_id, $township_id, $address, $phone, $payment_id);
    }

    public function getOrdersByUser($user_id)
    {
        return $this->order->getOrdersByUser($user_id);
    }

    public function getOrderByCode($order_code)
    {
        return $this->order->getOrderByCode($order_code); 
    }
}

?>