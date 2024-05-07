<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/OrderController.php';

$order_code = $_GET['order_code'];
$order_controller = new OrderController();
$orders = $order_controller->getOrderByCode($order_code);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            Order Code: <?php echo $order_code; ?>
        </div>
        <div class="col-md-3">
            Customer Name: <?php echo $orders[0]['username']; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Township: <?php echo $orders[0]['township']; ?>
        </div>
        <div class="col-md-3">
            Address: <?php echo $orders[0]['address']; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Order Date: <?php echo $orders[0]['order_date']; ?>
        </div>
        <div class="col-md-3">
            Order Time: <?php echo $orders[0]['order_time']; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 d-flex align-items-strech mt-2">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="card bg-body-tertiary shadow rounded">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($orders as $order) {
                                    ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $order['item']; ?></td>
                                            <td><?php echo $order['quantity']; ?></td>
                                            <td><?php echo $order['item_price']; ?></td>
                                            <td><?php echo $order['total_price']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tr>
                                    <td colspan="4">Delivery Fee</td>
                                    <td colspan="1"><?php echo $orders[0]['fee']; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Total Price</td>
                                    <td colspan="1"><?php echo $orders[0]['subtotal']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <a href="order_list.php" class="btn btn-primary">Back</a>
    </div>
</div>

<?php
include_once __DIR__ . '/../../layouts/footer.php';
?>