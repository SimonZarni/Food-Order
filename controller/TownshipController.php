<?php
include_once __DIR__ . '/../model/Township.php';

class TownshipController {
    private $township;
    function __construct()
    {
        $this->township = new Township();
    }

    public function getTownships()
    {
        return $this->township->getTownships();
    }
}

?>