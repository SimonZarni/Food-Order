<?php
include_once __DIR__ . '/../model/Order.php';

class OrderController {
    private $order;
    function __construct()
    {
        $this->order = new Order();
    }

    public function getOrders()
    {
        return $this->order->getOrders();
    }

    public function getOrder($id)
    {
        return $this->order->getOrder($id);
    }
}

?>