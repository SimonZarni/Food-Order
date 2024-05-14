<?php
include_once __DIR__ . '/../model/Favourite.php';

class FavouriteController {
    private $favourite;
    function __construct()
    {
        $this->favourite = new Favourite();
    }

    public function addToFavourite($user_id, $restaurant_id)
    {
        return $this->favourite->addToFavourite($user_id, $restaurant_id);
    }

    public function isFavourite($user_id, $restaurant_id)
    {
        return $this->favourite->isFavourite($user_id, $restaurant_id);
    }

    public function getFavouriteRestaurants($user_id)
    {
        return $this->favourite->getFavouriteRestaurants($user_id);
    }
}

?>