<?php
include_once __DIR__ . '/../model/Item.php';

class ItemController {
    private $item;
    function __construct()
    {
        $this->item = new Item();
    }

    public function getItems()
    {
        return $this->item->getItems();
    }

    public function getItemsByRestaurantMenu($restaurant_id, $menu_id)
    {
        return $this->item->getItemsByRestaurantMenu($restaurant_id, $menu_id);
    }

    public function getItem($id)
    {
        return $this->item->getItem($id);
    }
}

?>