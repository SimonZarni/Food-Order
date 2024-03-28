<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/RestaurantController.php';

$restaurant_controller = new RestaurantController();
$restaurants = $restaurant_controller->getRestaurants();

?>

<div class="container-fluid">
    <?php
    if (isset($_GET['status'])) {
        echo ' <div class="alert alert-success" role="alert">New restaurant added successfully.</div>';
    } elseif (isset($_GET['update_status'])) {
        echo ' <div class="alert alert-success" role="alert">Restaurant updated successfully.</div>';
    } elseif (isset($_GET['delete_status']) && $_GET['delete_status'] == 'success') {
        echo ' <div class="alert alert-success" role="alert">Restaurant deleted successfully.</div>';
    } elseif (isset($_GET['delete_status']) && $_GET['delete_status'] == 'fail') {
        echo ' <div class="alert alert-danger" role="alert">Cannot be deleted since it has related restaurant menu data.</div>';
    }
    ?>
    <a href="create_restaurant.php" class="btn btn-success">Add Restaurant</a>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($restaurants as $restaurant) {
                                if ($restaurant['status'] == null) {
                            ?>
                                    <tr>
                                        <td><?php echo $restaurant['id'] ?></td>
                                        <td><?php echo $restaurant['name']; ?></td>
                                        <td><?php echo $restaurant['address']; ?></td>
                                        <td>
                                            <a href="restaurant.php?id=<?php echo $restaurant['id']; ?>" class="btn btn-info mx-2"><i class="ti ti-eye"></i></a>
                                            <a href="edit_restaurant.php?id=<?php echo $restaurant['id']; ?>" class="btn btn-warning mx-2"><i class="ti ti-pencil"></i></a>
                                            <a href="delete_restaurant.php?id=<?php echo $restaurant['id']; ?>" onclick="return confirm('Are you sure to delete this restaurant?');" class="btn btn-danger mx-2"><i class="ti ti-trash"></i></a>
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