<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/DeliveryController.php';

$id = $_GET['id'];
$delivery_controller = new DeliveryController();
$delivery = $delivery_controller->getDelivery($id);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="card bg-body-tertiary shadow rounded" style="width: 400px;">
                        <div class="card-body">
                            <p class="card-text">ID: <?php echo $delivery['id']; ?></p>
                            <p class="card-text">Address: <?php echo $delivery['address']; ?></p>
                            <p class="card-text">Delivery Date: <?php echo $delivery['delivery_date']; ?></p>
                            <p class="card-text">Order ID: <?php echo $delivery['order_id']; ?></p>
                            <p class="card-text">Township: <?php echo $delivery['township']; ?></p>
                            <a href="delivery_list.php" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . '/../../layouts/footer.php';
?>