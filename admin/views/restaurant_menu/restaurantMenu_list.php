<?php
include_once __DIR__ . '/../../controller/RestaurantMenuController.php';

$restaurantMenu_controller = new RestaurantMenuController();
$restaurant_menus = $restaurantMenu_controller->getRestaurantMenus();

$menu_group = [];
foreach ($restaurant_menus as $restaurant_menu) {
    $restaurant_id = $restaurant_menu['restaurant_id'];
    if (!isset($menu_group[$restaurant_id])) {
        $menu_group[$restaurant_id] = [];
    }
    $menu_group[$restaurant_id][] = $restaurant_menu;
}

include_once __DIR__ . '/../../layouts/sidebar.php';

?>

<div class="container-fluid">
    <?php
    if (isset($_GET['status'])) {
        echo ' <div class="alert alert-success" role="alert">New Restaurant Menu added successfully.</div>';
    } elseif (isset($_GET['update_status'])) {
        echo ' <div class="alert alert-success" role="alert">Restaurant Menu updated successfully.</div>';
    } elseif (isset($_GET['delete_status'])) {
        echo ' <div class="alert alert-success" role="alert">Restaurant Menu deleted successfully.</div>';
    }
    ?>
    <a href="createRestaurantMenu.php" class="btn btn-success">Restaurant->Menu</a>
    <div class="row mt-3">
        <?php foreach ($menu_group as $restaurant_id => $menus) { ?>
            <?php $restaurant_name = $menus[0]['restaurant']; ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $restaurant_name; ?></h4>
                </div>
                <div class="card-body">
                    <ul class="d-flex flex-wrap">
                        <?php foreach ($menus as $menu) {
                            if ($menu['status'] == null) {
                        ?>
                                <div class="d-block mx-5">
                                    <li>
                                        <h5><?php echo $menu['menu'] ?></h5>
                                    </li>
                                    <li>
                                        <img src="../../uploads/<?php echo $menu['image']; ?>" alt="" style="width: 170px;height:170px;" class="rounded-2">
                                    </li>
                                    <li class="mt-3">
                                        <a href="editRestaurantMenu.php?id=<?php echo $menu['id']; ?>" class="btn btn-warning mx-2"><i class="ti ti-pencil"></i></a>
                                        <a href="deleteRestaurantMenu.php?id=<?php echo $menu['id']; ?>" onclick="return confirm('Are you sure to delete this restaurant menu?');" class="btn btn-danger mx-2"><i class="ti ti-trash"></i></a>
                                    </li>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
include_once __DIR__ . '/../../layouts/footer.php';
?>