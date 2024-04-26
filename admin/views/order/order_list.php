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
        <div class="col-md-12 d-flex align-items">
            <div class="card-body">
                <div class="align-items-center mb-9">
                    <table class="table table-striped text-center" id="orderTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Order Code</th>
                                <th>Total Price</th>
                                <th>Order Date</th>
                                <th>Customer name</th>
                                <th>Township</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($orders as $order) {
                            ?>
                                <tr>
                                    <td><?php echo $order['id']; ?></td>
                                    <td><?php echo $order['order_code']; ?></td>
                                    <td><?php echo $order['subtotal']; ?></td>
                                    <td><?php echo $order['order_date']; ?></td>
                                    <td><?php echo $order['username']; ?></td>
                                    <td><?php echo $order['township']; ?></td>
                                    <td>
                                        <?php
                                        if($order['status'] == 'Accepted'){
                                            echo "<p class='text-success'>" . $order['status'] . "</p>";
                                        } elseif($order['status'] == 'Declined'){
                                            echo "<p class='text-danger'>" . $order['status'] . "</p>";
                                        } else {
                                            echo "Pending";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($order['status'] != 'Declined'){
                                        ?>
                                        <a href="invoice.php?order_code=<?php echo $order['order_code']; ?>" class="btn btn-info mx-2"><i class="ti ti-eye"></i></a>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if($order['status'] == null){
                                        ?>
                                        <a href="accept_order.php?id=<?php echo $order['id']; ?>" onclick="return confirm('Are you sure to accept this order?');" class="btn btn-success mx-2"><i class="ti ti-check"></i></a>
                                        <a href="decline_order.php?id=<?php echo $order['id']; ?>" onclick="return confirm('Are you sure to decline this order?');" class="btn btn-danger mx-2"><i class="ti ti-x"></i></a>
                                        <?php
                                        }
                                        ?>
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