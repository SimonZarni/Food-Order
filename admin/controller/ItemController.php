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

    public function addItem($name, $image, $price, $description, $restaurant_menu)
    {
        return $this->item->addItem($name, $image, $price, $description, $restaurant_menu);
    }

    public function getItem($id)
    {
        return $this->item->getItem($id);
    }

    public function editItem($id, $name, $image, $price, $description, $restaurant_menu)
    {
        return $this->item->editItem($id, $name, $image, $price, $description, $restaurant_menu);
    }

    public function deleteItem($id)
    {
        return $this->item->deleteItem($id);
    }
}

?>