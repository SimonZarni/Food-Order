<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/ItemController.php';

$item_controller = new ItemController();
$items = $item_controller->getItems();

?>

<div class="container-fluid">
    <?php
    if (isset($_GET['status'])) {
        echo ' <div class="alert alert-success" role="alert">New item added successfully.</div>';
    } elseif (isset($_GET['update_status'])) {
        echo ' <div class="alert alert-success" role="alert">Item updated Successfully.</div>';
    } elseif (isset($_GET['delete_status'])) {
        echo ' <div class="alert alert-success" role="alert">Item deleted successfully.</div>';
    }
    ?>
    <a href="create_item.php" class="btn btn-success">Add Item</a>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-block align-items-center justify-content-between mb-9">
                    <table class="table table-striped text-center" id="itemTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Restaurant Menu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($items as $item) {
                                if ($item['status'] == null) {
                            ?>
                                    <tr>
                                        <td><?php echo $item['id']; ?></td>
                                        <td><?php echo $item['name']; ?></td>
                                        <td><img src="../../uploads/<?php echo $item['image']; ?>" alt="" style="width: 200px;" class="rounded-3"></td>
                                        <td><?php echo $item['price']; ?></td>
                                        <td><?php echo $item['description']; ?></td>
                                        <td><?php echo $item['restaurant_name']." ".$item['menu_name']; ?></td>
                                        <td>
                                            <a href="item.php?id=<?php echo $item['id']; ?>" class="btn btn-info mx-2"><i class="ti ti-eye"></i></a>
                                            <a href="edit_item.php?id=<?php echo $item['id']; ?>" class="btn btn-warning mx-2"><i class="ti ti-pencil"></i></a>
                                            <a href="delete_item.php?id=<?php echo $item['id']; ?>" onclick="return confirm('Are you sure to delete this item?');" class="btn btn-danger mx-2"><i class="ti ti-trash"></i></a>
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