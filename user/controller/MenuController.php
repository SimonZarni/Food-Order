<?php
include_once __DIR__ . '/../model/Menu.php';

class MenuController {
    private $menu;
    function __construct()
    {
        $this->menu = new Menu();
    }

    public function getMenus()
    {
        return $this->menu->getMenus();
    }

    public function getMenusByRestaurant($restaurant_id)
    {
        return $this->menu->getMenusByRestaurant($restaurant_id);
    }
}

?>