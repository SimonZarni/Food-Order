<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/RestaurantController.php';

$id = $_GET['id'];
$restaurant_controller = new RestaurantController();
$restaurant = $restaurant_controller->getRestaurant($id);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="card bg-body-tertiary shadow rounded" style="width: 400px;">
                        <div class="card-body">
                            <p class="card-text">ID: <?php echo $restaurant['id']; ?></p>
                            <p class="card-text">Restaurant Name: <?php  echo $restaurant['address']; ?></p>
                            <a href="restaurant_list.php" class="btn btn-primary">Back</a>
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