<?php
include_once __DIR__ . '/../model/Item.php';

class ItemController {
    private $item;
    function __construct()
    {
        $this->item = new Item();
    }

    public function getMenusAndItemsByRestaurant($restaurant_id){
        return $this->item->getMenusAndItemsByRestaurant($restaurant_id);
    }

    public function getItem($id)
    {
        return $this->item->getItem($id);
    }
}

?>