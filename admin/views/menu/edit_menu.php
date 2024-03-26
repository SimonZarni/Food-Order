<?php
include_once __DIR__ . '/../../controller/MenuController.php';

$id = $_GET['id'];
$menu_controller = new MenuController();
$menu = $menu_controller->getMenu($id);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    if (isset($_FILES['image'])) {
        $image = $_FILES['image']['name'];
    }
    if (!empty($name) && !empty($image)) {
        $targetDirectory = "../../uploads/";
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $status = $menu_controller->editMenu($id, $name, $image);
            if ($status) {
                header('location: menu_list.php?update_status=success');
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
                            <input type="text" name="name" class="form-control" value="<?php if (isset($menu['name'])) echo $menu['name']; ?>" id="">
                            <span class="text-danger"><?php if (isset($error_name)) echo $error_name; ?></span>
                        </div>
                        <div>
                            <label for="" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="">
                            <span class="text-danger"><?php if (isset($error_image)) echo $error_image; ?></span>
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn btn-warning mt-2" name="update">Update</button>
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