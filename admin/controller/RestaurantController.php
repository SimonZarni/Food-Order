<?php
include_once __DIR__ . '/../model/Restaurant.php';

class RestaurantController {
    private $restaurant;
    function __construct()
    {
        $this->restaurant = new Restaurant();
    }

    public function getRestaurants()
    {
        return $this->restaurant->getRestaurants();
    }

    public function addRestaurant($name, $address)
    {
        return $this->restaurant->addRestaurant($name, $address);
    }

    public function getRestaurant($id)
    {
        return $this->restaurant->getRestaurant($id);
    }

    public function editRestaurant($id, $name, $address)
    {
        return $this->restaurant->editRestaurant($id, $name, $address);
    }
    
    public function deleteRestaurant($id)
    {
        return $this->restaurant->deleteRestaurant($id);
    }
}
