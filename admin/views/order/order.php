<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/OrderController.php';

$id = $_GET['id'];
$order_controller = new OrderController();
$order = $order_controller->getOrder($id);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="card bg-body-tertiary shadow rounded" style="width: 400px;">
                        <div class="card-body">
                            <p class="card-text">ID: <?php echo $order['id']; ?></p>
                            <p class="card-text">Total Price: <?php echo $order['total_price']; ?></p>
                            <p class="card-text">Customer Name: <?php echo $order['username']; ?></p>
                            <p class="card-text">Payment: <?php echo $order['payment_method']; ?></p>
                            <p class="card-text">Cart ID: <?php echo $order['cart_id']; ?></p>
                            <a href="order_list.php" class="btn btn-primary">Back</a>
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