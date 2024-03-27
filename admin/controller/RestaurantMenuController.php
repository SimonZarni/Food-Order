<?php
include_once __DIR__ . '/../model/RestaurantMenu.php';

class RestaurantMenuController {
    private $restaurant;
    function __construct()
    {
        $this->restaurant = new RestaurantMenu();
    }

    public function getRestaurantMenus()
    {
        return $this->restaurant->getRestaurantMenus();
    }

    public function addRestaurantMenu($name, $address)
    {
        return $this->restaurant->addRestaurantMenu($name, $address);
    }

    public function getRestaurantMenu($id)
    {
        return $this->restaurant->getRestaurantMenu($id);
    }

    public function editRestaurantMenu($id, $restaurant, $menu)
    {
        return $this->restaurant->editRestaurantMenu($id, $restaurant, $menu);
    }
    
    public function deleteRestaurantMenu($id)
    {
        return $this->restaurant->deleteRestaurantMenu($id);
    }
}
