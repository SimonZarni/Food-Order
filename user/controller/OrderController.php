<?php
include_once __DIR__ . '/../model/Order.php';

class OrderController {
    private $order;
    function __construct()
    {
        $this->order = new Order();
    }

    public function addOrder($total_price, $order_date, $user_id, $item_id, $township_id, $payment_id)
    {
        return $this->order->addOrder($total_price, $order_date, $user_id, $item_id, $township_id, $payment_id);
    }
}

?>