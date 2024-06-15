<?php
include_once __DIR__ . '/../../controller/PromotionController.php';

$id = $_GET['id'];

$promotion_controller = new PromotionController();
$status = $promotion_controller->deletePromotion($id);

if($status){
    header('location: promotion_list.php?delete_status');
}

?>