<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once __DIR__ . "/../../controller/PaymentController.php";
$id=$_GET['id'];

$payment_controller=new PaymentController();
$status=$payment_controller->deletePayment($id);
var_dump($status);

if($status){
    header('location:payment_list.php?delete_status');
}else{
    header('location:payment_list.php?delete_status=fail');
}
?>