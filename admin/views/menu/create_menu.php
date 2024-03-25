<?php
include_once __DIR__ . '/../../controller/MenuController.php';

$menu_controller = new MenuController();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    if (isset($_FILES['image'])) {
        $image = $_FILES['image']['name'];
    }
    if (!empty($image)) {
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
    }
}

include_once __DIR__ . '/../../layouts/sidebar.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex align-items-strech">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div>
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="">
                            </div>
                            <div>
                                <label for="" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" id="">
                            </div>
                            <div>
                                <button class="btn btn-warning mt-2" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
include_once __DIR__ . '/../../layouts/footer.php';
?>