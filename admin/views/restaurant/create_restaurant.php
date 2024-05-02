<?php
include_once __DIR__ . '/../../controller/RestaurantController.php';

$restaurant_controller = new RestaurantController();

if (isset($_POST['submit'])) {
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
        $status = $restaurant_controller->addRestaurant($name, $address, $profile_img, $bg_img);
        if ($status) {
            header('location:restaurant_list.php?status=success');
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
                            <input type="text" name="name" class="form-control" style="width: 30rem;" value="<?php if (isset($name)) echo $name; ?>" id="">
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
                            <input type="text" name="address" class="form-control" style="width: 30rem;" value="<?php if (isset($address)) echo $address; ?>" id="">
                            <span class="text-danger"><?php if (isset($error_address)) echo $error_address; ?></span>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="mx-2 mt-3">
                                <button class="btn btn-warning mt-2" name="submit">Add</button>
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