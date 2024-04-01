<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/OrderController.php';

$order_controller = new OrderController();
$orders = $order_controller->getOrders();

?>

<div class="container-fluid">
    <?php
    if (isset($_GET['accept_status'])) {
        echo ' <div class="alert alert-success" role="alert">Customer order has been accepted.</div>';
    } elseif (isset($_GET['decline_status'])) {
        echo ' <div class="alert alert-success" role="alert">Customer order has been declined.</div>';
    } 
    ?>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Total Price</th>
                                <th>Order Date</th>
                                <th>Customer name</th>
                                <th>Payment</th>
                                <th>Cart ID</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($orders as $order) {
                                if($order['status']==null){
                            ?>
                                <tr>
                                    <td><?php echo $order['id']; ?></td>
                                    <td><?php echo $order['total_price']; ?></td>
                                    <td><?php echo $order['order_date']; ?></td>
                                    <td><?php echo $order['username']; ?></td>
                                    <td><?php echo $order['payment_method']; ?></td>
                                    <td><?php echo $order['cart_id']; ?></td>
                                    <td><?php echo "Status"; ?></td>
                                    <td>
                                        <a href="order.php?id=<?php echo $order['id']; ?>" class="btn btn-info mx-2"><i class="ti ti-eye"></i></a>
                                        <a href="accept_order.php?" onclick="return confirm('Are you sure to accept this order?');" class="btn btn-success mx-2"><i class="ti ti-check"></i></a>
                                        <a href="decline_order.php?" onclick="return confirm('Are you sure to decline this order?');" class="btn btn-danger mx-2"><i class="ti ti-x"></i></a>
                                    </td>
                                </tr>
                            <?php
                                }
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