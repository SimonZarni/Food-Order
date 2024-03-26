<?php
include_once __DIR__ . '/../../controller/MenuController.php';

$id = $_GET['id'];
$menu_controller = new MenuController();

$status = $menu_controller->deleteMenu($id);
if ($status) {
    header('location:menu_list.php?delete_status=success');
} else {
    header('location:menu_list.php?delete_status=fail');
}

?>
