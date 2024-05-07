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

    public function addMenu($name, $image)
    {
        return $this->menu->addMenu($name, $image);
    }

    public function getMenu($id)
    {
        return $this->menu->getMenu($id);
    }

    public function editMenu($id, $name, $image)
    {
        return $this->menu->editMenu($id, $name, $image);
    }

    public function deleteMenu($id)
    {
        return $this->menu->deleteMenu($id);
    }

    public function getMenuByRestaurant($resturant_id)
    {
        return $this->menu->getMenuByRestaurant($resturant_id);
    }

    public function getTotalMenus(){
        return $this->menu->getTotalMenus();
    }
}
