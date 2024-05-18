<?php
include_once __DIR__ . '/../model/Delivery.php';

class DeliveryController {
    private $delivery;
    function __construct()
    {
        $this->delivery = new Delivery();
    }

    public function getDeliveris()
    {
        return $this->delivery->getDeliveries();
    }

    public function getDelivery($id)
    {
        return $this->delivery->getDelivery($id);
    }

    public function acceptDelivery($id){
        return $this->delivery->acceptDelivery($id);
    }

    public function getTotalDeliveries()
    {
        return $this->delivery->getTotalDeliveries();
    }

    public function getTotalDeliveredDeliveries()
    {
        return $this->delivery->getTotalDeliveredDeliveries();
    }

    public function getTotalUndeliveredDeliveries()
    {
        return $this->delivery->getTotalUndeliveredDeliveries();
    }
}

?>