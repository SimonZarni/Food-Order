<?php
include_once __DIR__ . '/../model/Restaurant.php';

class RestaurantController {
    private $restaurant;

    function __construct()
    {
        $this->restaurant = new Restaurant();
    }

    public function getRestaurants(){
        return $this->restaurant->getRestaurants();
    }

    public function getRestaurantsByMenu($menu_id)
    {
        return $this->restaurant->getRestaurantsByMenu($menu_id);
    }
}

?>