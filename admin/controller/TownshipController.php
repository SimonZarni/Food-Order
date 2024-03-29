<?php
include_once __DIR__ . '/../model/Township.php';

class TownshipController{
    private $township;
    function __construct(){
        $this->township=new township();
    }

    public function getTownships(){
        return $this->township->getTownships();
    }

    public function getTownship($id){
        return $this->township->getTownship($id);
    }

    public function addTownship($township, $fee){
        return $this->township->addTownship($township, $fee);
    }

    public function updateTownship($id,$township, $fee){
        return $this->township->updateTownship($id,$township, $fee);
    }

    public function deleteTownship($id){
        return $this->township->deleteTownship($id);
    }
}

?>

