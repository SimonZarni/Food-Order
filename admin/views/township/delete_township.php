<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once __DIR__ . "/../../controller/TownshipController.php";
$id=$_GET['id'];

$township_controller=new TownshipController();
$status=$township_controller->deleteTownship($id);

if($status){
    header('location:township_list.php?delete_status');
}else{
    header('location:township_list.php?delete_status=fail');
}
?>