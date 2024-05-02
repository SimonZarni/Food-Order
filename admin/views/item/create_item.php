<?php
include_once __DIR__ . '/../../controller/ItemController.php';
include_once __DIR__ . '/../../controller/RestaurantController.php';
include_once __DIR__ . '/../../controller/RestaurantMenuController.php';

$item_controller = new ItemController();

$restaurant_controller = new RestaurantController();
$restaurants = $restaurant_controller->getRestaurants();

$restaurantMenu_controller = new RestaurantMenuController();
$restaurant_menus = $restaurantMenu_controller->getRestaurantMenus();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $restaurant = $_POST['restaurant'];
    $menu = $_POST['menu'];
    $restaurant_menu = $_POST['restaurant_menu'];
    if (isset($_FILES['image'])) {
        $image = $_FILES['image']['name'];
    }
    if (!empty($name) && !empty($image)) {
        $targetDirectory = "../../uploads/";
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $status = $item_controller->addItem($name, $image, $price, $description, $restaurant, $menu, $restaurant_menu);
            if ($status) {
                header('location: item_list.php?status=success');
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
                            <input type="text" name="name" class="form-control" value="<?php if (isset($name)) echo $name; ?>" id="">
                            <span class="text-danger"><?php if (isset($error_name)) echo $error_name; ?></span>
                        </div>
                        <div>
                            <label for="" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="">
                            <span class="text-danger"><?php if (isset($error_image)) echo $error_image; ?></span>
                        </div>
                        <div>
                            <label for="" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" value="<?php if (isset($price)) echo $price; ?>" id="">
                            <span class="text-danger"><?php if (isset($error_price)) echo $error_price; ?></span>
                        </div>
                        <div>
                            <label for="" class="form-label">Description</label>
                            <input type="text" name="description" class="form-control" value="<?php if (isset($description)) echo $description; ?>" id="">
                            <span class="text-danger"><?php if (isset($error_description)) echo $error_description; ?></span>
                        </div>
                        <div>
                            <label for="restaurant" class="form-label">Restaurant</label>
                            <select name="restaurant" id="restaurant" class="form-select">
                                <option value="" disabled selected>Select restaurant</option>
                                <?php
                                foreach ($restaurants as $restaurant) {
                                    if ($restaurant['status'] == null) {
                                ?>
                                        <option value="<?php echo $restaurant['id']; ?>"><?php echo $restaurant['name']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="menu" class="form-label">Menu</label>
                            <select name="menu" id="menu" class="form-select">
                                <option value="" disabled selected>Select menu</option>
                            </select>
                        </div>
                        <div>
                            <label for="restaurant_menu" class="form-label">Restaurant Menu</label>
                            <input type="text" name="restaurant_menu" id="restaurant_menu" class="form-control" readonly>
                        </div>
                        <div>
                            <label for="" class="form-label">Restaurant Menu</label>
                            <select name="restaurant_menu" id="" class="form-select">
                                <option value="" disabled selected>Please select restaurant menu</option>
                                <?php
                                foreach ($restaurant_menus as $restaurant_menu) {
                                    if ($restaurant_menu['status'] == null) {
                                ?>
                                        <option value="<?php echo $restaurant_menu['id']; ?>"><?php echo $restaurant_menu['restaurant_menu']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="text-danger"><?php if (isset($error_restaurantMenu)) echo $error_restaurantMenu; ?></span>
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
                            <a href="item_list.php">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('restaurant').addEventListener('change', updateRestaurantMenu);
    document.getElementById('menu').addEventListener('change', updateRestaurantMenu);

    function updateRestaurantMenu() {
        var restaurantName = document.getElementById('restaurant').options[document.getElementById('restaurant').selectedIndex].text;
        var menuName = document.getElementById('menu').options[document.getElementById('menu').selectedIndex].text;
        var restaurantMenuInput = document.getElementById('restaurant_menu');
        if (restaurantName && menuName) {
            restaurantMenuInput.value = restaurantName + '  ' + menuName;
        } else {
            restaurantMenuInput.value = '';
        }
    }
</script>

<script>
    document.getElementById('restaurant').addEventListener('change', function() {
        var restaurantId = this.value;
        if (restaurantId) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_menus.php?restaurant_id=' + restaurantId, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var menuOptions = JSON.parse(xhr.responseText);
                    var menuSelect = document.getElementById('menu');
                    menuSelect.innerHTML = '<option value="" disabled selected>Select menu</option>';
                    menuOptions.forEach(function(option) {
                        var optionElement = document.createElement('option');
                        optionElement.value = option.id; 
                        optionElement.textContent = option.name;
                        menuSelect.appendChild(optionElement);
                    });
                } else {
                    console.error('Request failed. Status: ' + xhr.status);
                }
            };
            xhr.send();
        }
    });
</script>


<?php
include_once __DIR__ . '/../../layouts/footer.php';
?>