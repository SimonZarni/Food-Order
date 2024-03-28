<?php
include_once __DIR__ . '/../../controller/ItemController.php';
include_once __DIR__ . '/../../controller/RestaurantMenuController.php';

$id = $_GET['id'];
$item_controller = new ItemController();
$item = $item_controller->getItem($id);

$restaurantMenu_controller = new RestaurantMenuController();
$restaurant_menus = $restaurantMenu_controller->getRestaurantMenus();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $restaurant_menu = $_POST['restaurant_menu'];
    if (isset($_FILES['image'])) {
        $image = $_FILES['image']['name'];
    }
    if (!empty($name) && !empty($image)) {
        $targetDirectory = "../../uploads/";
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $status = $item_controller->editItem($id, $name, $image, $price, $description, $restaurant_menu);
            if ($status) {
                header('location: item_list.php?update_status=success');
            }
        } else {
            echo "Error";
        }
    } else {
        if (empty($name)) {
            $error_name = "Please Enter Item Name";
        }
        if (empty($price)) {
            $error_price = "Please Enter Price";
        }
        if (empty($description)) {
            $error_description = "Please Enter Description";
        }
        if (empty($restaurant_menu)) {
            $error_restaurantMenu = "Please Select Restaurant Menu";
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
                            <label for="" class="form-label">Item Name</label>
                            <input type="text" name="name" class="form-control" value="<?php if(isset($item['name'])) echo $item['name']; ?>" id="">
                            <span class="text-danger"><?php if (isset($error_name)) echo $error_name; ?></span>
                        </div>
                        <div>
                            <label for="" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="">
                            <span class="text-danger"><?php if (isset($error_image)) echo $error_image; ?></span>
                        </div>
                        <div>
                            <label for="" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" value="<?php if (isset($item['price'])) echo $item['price']; ?>" id="">
                            <span class="text-danger"><?php if (isset($error_price)) echo $error_price; ?></span>
                        </div>
                        <div>
                            <label for="" class="form-label">Description</label>
                            <input type="text" name="description" class="form-control" value="<?php if (isset($item['description'])) echo $item['description']; ?>" id="">
                            <span class="text-danger"><?php if (isset($error_description)) echo $error_description; ?></span>
                        </div>
                        <div>
                            <label for="" class="form-label">Restaurant Menu</label>
                            <select name="restaurant_menu" id="" class="form-select">
                                <?php
                                foreach ($restaurant_menus as $restaurant_menu) {
                                    if ($restaurant_menu['status'] == null) {
                                ?>
                                        <option value="<?php echo $restaurant_menu['id']; ?>" <?php if ($item['restaurant_menuID'] == $restaurant_menu['id']) echo 'selected'; ?>>
                                            <?php echo $restaurant_menu['restaurant_menu']; ?>
                                        </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="text-danger"> <?php if (isset($error_restaurantMenu)) echo $error_restaurantMenu; ?></span>
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
                            <a href="item_list.php">Back</a>
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