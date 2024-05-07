<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/MenuController.php';

$menu_controller = new MenuController();
$menus = $menu_controller->getMenus();

?>

<div class="container-fluid">
    <?php
    if (isset($_GET['status'])) {
        echo ' <div class="alert alert-success" role="alert">New menu added successfully.</div>';
    } elseif (isset($_GET['update_status'])) {
        echo ' <div class="alert alert-success" role="alert">Menu updated Successfully.</div>';
    } elseif (isset($_GET['delete_status']) && $_GET['delete_status'] == 'success') {
        echo ' <div class="alert alert-success" role="alert">Menu deleted successfully.</div>';
    } elseif (isset($_GET['delete_status']) && $_GET['delete_status'] == 'fail'){
        echo ' <div class="alert alert-danger" role="alert">Cannot be deleted since it has related restaurant menu data.</div>';
    }
    ?>
    <a href="create_menu.php" class="btn btn-success">Add Menu</a>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-block align-items-center justify-content-between mb-9">
                    <table class="table table-striped text-center"id="menuTable">
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
                                if($menu['status']==null){
                            ?>
                                <tr>
                                    <td><?php echo $menu['id']; ?></td>
                                    <td><?php echo $menu['name']; ?></td>
                                    <td><img src="../../uploads/<?php echo $menu['image']; ?>" alt="" style="width: 200px;" class="rounded-3"></td>
                                    <td>
                                        <a href="menu.php?id=<?php echo $menu['id']; ?>" class="btn btn-info mx-2"><i class="ti ti-eye"></i></a>
                                        <a href="edit_menu.php?id=<?php echo $menu['id']; ?>" class="btn btn-warning mx-2"><i class="ti ti-pencil"></i></a>
                                        <a href="delete_menu.php?id=<?php echo $menu['id']; ?>" onclick="return confirm('Are you sure to delete this menu?');" class="btn btn-danger mx-2"><i class="ti ti-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
                                }
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