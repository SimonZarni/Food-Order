<?php
include_once __DIR__ . '/../../controller/ItemController.php';

$id = $_GET['id'];
$item_controller = new ItemController();

$status = $item_controller->deleteItem($id);
if($status)
{
    header('location: item_list.php?delete_status=success');
}
?>