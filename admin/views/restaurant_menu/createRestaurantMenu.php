<?php
include_once __DIR__ . '/../../controller/RestaurantMenuController.php';
include_once __DIR__ . '/../../controller/RestaurantController.php';
include_once __DIR__ . '/../../controller/MenuController.php';

$restaurantMenu_controller = new RestaurantMenuController();

$restaurant_controller = new RestaurantController();
$restaurants = $restaurant_controller->getRestaurants();

$menu_controller = new MenuController();
$menus = $menu_controller->getMenus();

if (isset($_POST['submit'])) {
    $error = false;
    if (!empty($_POST['restaurant'])) {
        $restaurant = $_POST['restaurant'];
    } else {
        $error = true;
        $error_restaurant = "Please select restaurant";
    }
    if (!empty($_POST['menu'])) {
        $menu = $_POST['menu'];
    } else {
        $error = true;
        $error_menu = "Please select menu";
    }
    if (!empty($_POST['restaurant_menu'])) {
        $restaurant_menu = $_POST['restaurant_menu'];
    } else {
        $error = true;
        $error_restaurantMenu = "Please fill in restaurant menu";
    }
    if (!$error) {
        $status = $restaurantMenu_controller->addRestaurantMenu($restaurant, $menu, $restaurant_menu);
        header('location:restaurantMenu_list.php?status=success');
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
                            <label for="" class="form-label">Restaurant</label>
                            <select name="restaurant" id="" class="form-select" style="width: 20rem;">
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
                            <span class="text-danger"> <?php if (isset($error_restaurant)) echo $error_restaurant; ?></span>
                        </div>
                        <div>
                            <label for="" class="form-label">Menu</label>
                            <select name="menu" id="" class="form-select" style="width: 20rem;">
                                <option value="" disabled selected>Select Menu</option>
                                <?php
                                foreach ($menus as $menu) {
                                    if ($menu['status'] == null) {
                                ?>
                                        <option value="<?php echo $menu['id']; ?>"><?php echo $menu['name']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="text-danger"> <?php if (isset($error_menu)) echo $error_menu; ?></span>
                        </div>
                        <div>
                            <label for="" class="form-label">Restaurant Menu</label>
                            <input type="text" name="restaurant_menu" id="" placeholder="Please fill in restaurant menu" class="form-control">
                            <span class="text-danger"> <?php if (isset($error_restaurantMenu)) echo $error_restaurantMenu; ?></span>
                        </div>
                        <div class="d-flex">
                            <div class="mx-2 mt-3">
                                <button class="btn btn-warning mt-2" name="submit">Add</button>
                            </div>
                            <div class="mx-2 mt-3">
                                <a href="restaurantMenu_list.php" class="btn btn-primary mt-2">Back</a>
                            </div>
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