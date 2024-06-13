<?php
include_once __DIR__ . '/../model/Promotion.php';

class PromotionController {
    private $promotion;
    function __construct()
    {
        $this->promotion = new Promotion();
    }

    public function getPromotions()
    {
        return $this->promotion->getPromotions();
    }

    public function addPromotion($restaurant, $discount, $voucher)
    {
        return $this->promotion->addPromotion($restaurant, $discount, $voucher);
    }

    public function getPromotion($id)
    {
        return $this->promotion->getPromotion($id);
    }

    public function editPromotion($id, $restaurant, $discount, $voucher)
    {
        return $this->promotion->editPromotion($id, $restaurant, $discount, $voucher);
    }

    public function deletePromotion($id)
    {
        return $this->promotion->deletePromotion($id);
    }
}

?>