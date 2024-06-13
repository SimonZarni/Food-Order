<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/PromotionController.php';

$promotion_controller = new PromotionController();
$promotions = $promotion_controller->getPromotions();

?>

<div class="container-fluid">
    <?php
    if (isset($_GET['status'])) {
        echo ' <div class="alert alert-success" role="alert">New Promotion added successfully.</div>';
    } elseif (isset($_GET['update_status'])) {
        echo ' <div class="alert alert-success" role="alert">Promotion updated Successfully.</div>';
    } elseif (isset($_GET['delete_status'])) {
        echo ' <div class="alert alert-success" role="alert">Promotion deleted successfully.</div>';
    }
    ?>
    <a href="create_promotion.php" class="btn btn-success">Add New Promotion</a>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-block align-items-center justify-content-between mb-9">
                    <table class="table table-striped" id="promotionTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Restaurant</th>
                                <th>Restaurant Image</th>
                                <th>Discount</th>
                                <th>Voucher Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($promotions as $promotion) {
                            ?>
                                <tr>
                                    <td><?php echo $promotion['id']; ?></td>
                                    <td><?php echo $promotion['restaurant_name']; ?></td>
                                    <td><img src="../../uploads/<?php echo $promotion['image']; ?>" alt="" style="width: 200px;" class="rounded-3"></td>
                                    <td><?php echo $promotion['discount']; ?></td>
                                    <td><?php echo $promotion['voucher_code']; ?></td>
                                    <td>
                                        <a href="promotion.php?id=<?php echo $promotion['id']; ?>" class="btn btn-info mx-2"><i class="ti ti-eye"></i></a>
                                        <a href="edit_promotion.php?id=<?php echo $promotion['id']; ?>" class="btn btn-warning mx-2"><i class="ti ti-pencil"></i></a>
                                        <a href="delete_promotion.php?id=<?php echo $promotion['id']; ?>" onclick="return confirm('Are you sure to delete this promotion?');" class="btn btn-danger mx-2"><i class="ti ti-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . '/../../layouts/footer.php';
?>