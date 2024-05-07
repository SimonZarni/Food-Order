<?php
include_once __DIR__ . '/../../controller/RestaurantController.php';

$id = $_GET['id'];
$restaurant_controller = new RestaurantController();
$restaurant = $restaurant_controller->getRestaurant($id);

if (isset($_POST['update'])) {
    $error = false;
    if (empty($_POST['name'])) {
        $error = true;
        $error_name = "Please Enter Restaurant Name";
    } else {
        $name = $_POST['name'];
    }
    if (empty($_POST['address'])) {
        $error = true;
        $error_address = "Please Enter Restaurant Address";
    } else {
        $address = $_POST['address'];
    }
    if (empty($_POST['open_time'])) {
        $error = true;
        $error_open = "Please Enter Opening Time";
    } else {
        $open_time = $_POST['open_time'];
    }

    if (empty($_FILES['profile_img']['name']) || empty($_FILES['bg_img']['name'])) {
        $error = true;
        $error_image = "Please choose both profile and background images";
    } else {
        $profile_img = $_FILES['profile_img']['name'];
        $bg_img = $_FILES['bg_img']['name'];

        $targetDirectory = "../../uploads/";

        $profileImgTargetFile = $targetDirectory . basename($_FILES["profile_img"]["name"]);
        $bgImgTargetFile = $targetDirectory . basename($_FILES["bg_img"]["name"]);

        if (
            !move_uploaded_file($_FILES["profile_img"]["tmp_name"], $profileImgTargetFile) ||
            !move_uploaded_file($_FILES["bg_img"]["tmp_name"], $bgImgTargetFile)
        ) {
            $error = true;
            echo "Error uploading files";
        }
    }

    if (!$error) {
        $status = $restaurant_controller->editRestaurant($id, $name, $address, $profile_img, $bg_img, $open_time);
        if ($status) {
            header('location:restaurant_list.php?update_status=success');
        } else {
            echo "Error adding restaurant with images";
        }
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
                            <input type="text" name="name" class="form-control" style="width: 30rem;" value="<?php if (isset($restaurant['name'])) echo $restaurant['name']; ?>" id="">
                            <span class="text-danger"><?php if (isset($error_name)) echo $error_name; ?></span>
                        </div>
                        <div>
                            <label for="" class="form-label">Profile Image</label>
                            <input type="file" name="profile_img" class="form-control" id="">
                            <span class="text-danger"><?php if (isset($error_image)) echo $error_image; ?></span>
                        </div>
                        <div>
                            <label for="" class="form-label">Bg Image</label>
                            <input type="file" name="bg_img" class="form-control" id="">
                            <span class="text-danger"><?php if (isset($error_image)) echo $error_image; ?></span>
                        </div>
                        <div>
                            <label for="" class="form-label">Restaurant Address</label>
                            <input type="text" name="address" class="form-control" style="width: 30rem;" value="<?php if (isset($restaurant['address'])) echo $restaurant['address']; ?>" id="">
                            <span class="text-danger"><?php if (isset($error_address)) echo $error_address; ?></span>
                        </div>
                        <div>
                            <label for="" class="form-label">Open Time</label>
                            <input type="text" name="open_time" class="form-control" style="width: 30rem;" value="<?php if (isset($open_time)) echo $open_time; ?>" id="">
                            <span class="text-danger"><?php if (isset($error_open)) echo $error_open; ?></span>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="mx-2 mt-3">
                                <button class="btn btn-warning mt-2" name="update">Update</button>
                            </div>
                            <div class="mx-2 mt-3">
                                <button type="reset" class="btn btn-danger mt-2">Clear</button>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="restaurant_list.php">Back</a>
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