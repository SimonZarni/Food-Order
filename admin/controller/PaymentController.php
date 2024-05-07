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

    public function getPayment($id)
    {
        return $this->payment->getPayment($id);
    }

    public function addPayments($method)
    {
        return $this->payment->addPayments($method);
    }

    public function updatePayment($id, $method)
    {
        return $this->payment->updatePayment($id, $method);
    }

    public function deletePayment($id)
    {
        return $this->payment->deletePayment($id);
    }
}
