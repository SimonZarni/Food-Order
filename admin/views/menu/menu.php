<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/MenuController.php';

$id = $_GET['id'];
$menu_controller = new MenuController();
$menu = $menu_controller->getMenu($id);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="card bg-body-tertiary shadow rounded" style="width: 400px;">
                        <img src="<?php echo '../../uploads/' . $menu['image']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">ID: <?php echo $menu['id']; ?></p>
                            <p class="card-text">Menu Name: <?php  echo $menu['name']; ?></p>
                            <a href="menu_list.php" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . '/../../layouts/footer.php';
?>