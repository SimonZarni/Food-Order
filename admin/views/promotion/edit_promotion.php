<?php
include_once __DIR__ . '/../../controller/PromotionController.php';
include_once __DIR__ . '/../../controller/RestaurantController.php';

$id = $_GET['id'];

$promotion_controller = new PromotionController();
$promotion = $promotion_controller->getPromotion($id);

$restaurant_controller = new RestaurantController();
$restaurants = $restaurant_controller->getRestaurants();

if (isset($_POST['submit'])) {
    $error = false;
    if (!empty($_POST['restaurant'])) {
        $restaurant = $_POST['restaurant'];
    } else {
        $error = true;
        $error_restaurant = "Please select restaurant.";
    }
    if (!empty($_POST['discount'])) {
        $discount = $_POST['discount'];
    } else {
        $error = true;
        $error_discount = "Please enter discount.";
    }
    $voucher = rand(00000, 99999);
    if (!$error) {
        $status = $promotion_controller->editPromotion($id, $restaurant, $discount, $voucher);
        header('location:promotion_list.php?update_status=success');
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
                            <label for="" class="form-label">Restaurant</label>
                            <select name="restaurant" id="" class="form-select" style="width: 20rem;">
                                <?php
                                foreach ($restaurants as $restaurant) {
                                    if ($restaurant['status'] == null) {
                                ?>
                                        <option value="<?php echo $restaurant['id']; ?>" <?php if ($promotion['restaurant_id'] == $restaurant['id']) echo 'selected'; ?>>
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
                            <label for="" class="form-label">Discount</label>
                            <input type="number" name="discount" class="form-control" value="<?php echo $promotion['discount']; ?>" id="">
                            <span class="text-danger"><?php if (isset($error_discount)) echo $error_discount; ?></span>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="mx-2 mt-3">
                                <button class="btn btn-warning mt-2" name="submit">Update</button>
                            </div>
                            <div class="mx-2 mt-3">
                                <button type="reset" class="btn btn-danger mt-2">Clear</button>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="promotion_list.php">Back</a>
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