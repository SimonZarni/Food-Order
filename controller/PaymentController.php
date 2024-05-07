<?php
include_once __DIR__ . '/../model/Payment.php';

class PaymentController {
    private $payment;
    function __construct()
    {
        $this->payment = new Payment();
    }

    public function getPayments()
    {
        return $this->payment->getPayments();
    }
}

?>