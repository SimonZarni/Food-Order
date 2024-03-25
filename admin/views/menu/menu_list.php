<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/MenuController.php';

$menu_controller = new MenuController();
$menus = $menu_controller->getMenus();
?>

<div class="container-fluid">
    <?php
    if (isset($_GET['status'])) {
        echo "<div class='alert alert-success'>New menu added successfully.</div>";
    }
    ?>
    <a href="create_menu.php" class="btn btn-success">Create</a>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($menus as $menu) {
                            ?>
                                <tr>
                                    <td><?php echo $menu['id']; ?></td>
                                    <td><?php echo $menu['name']; ?></td>
                                    <td><img src="../../uploads/<?php echo $menu['image']; ?>" alt="" style="width: 120px; height:120px; border-radius:100%;"></td>
                                    <td></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . '/../../layouts/footer.php';
?>