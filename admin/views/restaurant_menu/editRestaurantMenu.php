<?php
include_once __DIR__ . '/../../controller/RestaurantMenuController.php';
include_once __DIR__ . '/../../controller/RestaurantController.php';
include_once __DIR__ . '/../../controller/MenuController.php';

$id = $_GET['id'];
$restaurantMenu_controller = new RestaurantMenuController();
$restaurant_menu = $restaurantMenu_controller->getRestaurantMenu($id);

$restaurant_controller = new RestaurantController();
$restaurants = $restaurant_controller->getRestaurants();

$menu_controller = new MenuController();
$menus = $menu_controller->getMenus();

if (isset($_POST['update'])) {
    $error = false;
    if (!empty($_POST['restaurant'])) {
        $restaurant = $_POST['restaurant'];
        $restaurant_name = $restaurant_controller->getRestaurant($restaurant)['name'];
    } else {
        $error = true;
        $error_restaurant = "Please select restaurant";
    }
    if (!empty($_POST['menu'])) {
        $menu = $_POST['menu'];
        $menu_name = $menu_controller->getMenu($menu)['name'];
    } else {
        $error = true;
        $error_menu = "Please select menu";
    }
    if (!$error) {
        $restaurant_menu = $restaurant_name . ' ' . $menu_name;
        $status = $restaurantMenu_controller->editRestaurantMenu($id, $restaurant, $menu, $restaurant_menu);
        header('location:restaurantMenu_list.php?update_status=success');
    }
}

include_once __DIR__ . '/../../layouts/sidebar.php';

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <form action="" method="post" class="bg-body-tertiary shadow rounded p-5">
                        <div>
                            <label for="" class="form-label">Restaurant</label>
                            <select name="restaurant" id="" class="form-select" style="width: 20rem;">
                                <?php
                                foreach ($restaurants as $restaurant) {
                                    if ($restaurant['status'] == null) {
                                ?>
                                        <option value="<?php echo $restaurant['id']; ?>" <?php if ($restaurant_menu['restaurant_id'] == $restaurant['id']) echo 'selected'; ?>>
                                            <?php echo $restaurant['name']; ?>
                                        </option>
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
                                <?php
                                foreach ($menus as $menu) {
                                    if ($menu['status'] == null) {
                                ?>
                                        <option value="<?php echo $menu['id']; ?>" <?php if ($restaurant_menu['menu_id'] == $menu['id']) echo 'selected'; ?>>
                                            <?php echo $menu['name']; ?>
                                        </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="text-danger"> <?php if (isset($error_menu)) echo $error_menu; ?></span>
                        </div>
                        <div class="d-flex">
                            <div class="mx-2 mt-3">
                                <button class="btn btn-warning mt-2" name="update">Update</button>
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