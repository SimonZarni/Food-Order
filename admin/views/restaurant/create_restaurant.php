<?php
include_once __DIR__ . '/../../controller/RestaurantController.php';

$restaurant_controller = new RestaurantController();

if (isset($_POST['submit'])) {
    $error = false;
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $error = true;
        $error_name = "Please Enter Restaurant Name";
    }
    if (!empty($_POST['address'])) {
        $address = $_POST['address'];
    } else {
        $error = true;
        $error_address = "Please Enter Restaurant Address";
    }
    if (!$error) {
        $status = $restaurant_controller->addRestaurant($name, $address);
        header('location:restaurant_list.php?status=success');
    }
}

include_once __DIR__ . '/../../layouts/sidebar.php';

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <form action="" method="post" enctype="multipart/form-data" class="bg-body-tertiary shadow rounded p-5">
                        <div>
                            <label for="" class="form-label">Restaurant Name</label>
                            <input type="text" name="name" class="form-control" style="width: 30rem;" value="<?php if (isset($name)) echo $name; ?>" id="">
                            <span class="text-danger"><?php if (isset($error_name)) echo $error_name; ?></span>
                        </div>
                        <div>
                            <label for="" class="form-label">Restaurant Address</label>
                            <input type="text" name="address" class="form-control" style="width: 30rem;" value="<?php if (isset($address)) echo $address; ?>" id="">
                            <span class="text-danger"><?php if (isset($error_address)) echo $error_address; ?></span>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="mx-2 mt-3">
                                <button class="btn btn-warning mt-2" name="submit">Add</button>
                            </div>
                            <div class="mx-2 mt-3">
                                <button type="reset" class="btn btn-danger mt-2" name="submit">Clear</button>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="restaurant_list.php" class="btn btn-primary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . '/../../layouts/footer.php';
?>