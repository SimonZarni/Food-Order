<?php
include_once __DIR__ . '/../../controller/MenuController.php';

$menu_controller = new MenuController();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    if (isset($_FILES['image'])) {
        $image = $_FILES['image']['name'];
    }
    if (!empty($name) && !empty($image)) {
        $targetDirectory = "../../uploads/";
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $status = $menu_controller->addMenu($name, $image);
            if ($status) {
                header('location: menu_list.php?status=success');
            }
        } else {
            echo "Error";
        }
    } else {
        if (empty($name)) {
            $error_name = "Please Enter Menu Name";
        }
        if (empty($image)) {
            $error_image = "Please choose Image";
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
                    <form action="" method="post" enctype="multipart/form-data" class="bg-body-tertiary shadow rounded p-5 py-10">
                        <div>
                            <label for="" class="form-label">Menu Name</label>
                            <input type="text" name="name" class="form-control" value="<?php if (isset($name)) echo $name; ?>" id="">
                            <span class="text-danger"><?php if (isset($error_name)) echo $error_name; ?></span>
                        </div>
                        <div>
                            <label for="" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="">
                            <span class="text-danger"><?php if (isset($error_image)) echo $error_image; ?></span>
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
                            <a href="menu_list.php">Back</a>
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