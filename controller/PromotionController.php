<?php
include_once __DIR__ . '/../model/Promotion.php';

class PromotionController {
    private $promotion;
    function __construct()
    {
        $this->promotion = new Promotion();
    }

    public function getPromotionRestaurants()
    {
        return $this->promotion->getPromotionRestaurants();
    }

    public function getPromotionByRestaurant($restaurant_id)
    {
        return $this->promotion->getPromotionByRestaurant($restaurant_id);
    }
}

?>