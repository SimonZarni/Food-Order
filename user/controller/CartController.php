<?php
include_once __DIR__ . '/../model/Cart.php';

class CartController {
    private $cart;
    function __construct()
    {
        $this->cart = new Cart();
    }

    public function getCarts()
    {
        return $this->cart->getCarts();
    }

    public function addToCart($user_id, $item_id, $quantity)
    {
        return $this->cart->addToCart($user_id, $item_id, $quantity);
    }

    public function getCartIdByUser($user_id)
    {
        return $this->cart->getCartIdByUser($user_id);
    }

    public function getCartDetails($user_id)
    {
        return $this->cart->getCartDetails($user_id);
    }

    public function getCartById($id)
    {
        return $this->cart->getCartById($id);
    }

    public function removeCartItem($user_id, $item_id)
    {
        return $this->cart->removeCartItem($user_id, $item_id);
    }
}

?>