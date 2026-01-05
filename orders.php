<?php
include_once __DIR__ . '/layout/sidebar.php';
include_once __DIR__ . '/controller/OrderController.php';

$user_id = $_GET['id'];

$order_controller = new OrderController();
$orders = $order_controller->getOrdersByUser($user_id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container" style="margin-top: 70px">
        <h4>Orders History</h4>
        <strong>Customer Name: </strong><?php echo $orders[0]['username'] ?>
        
        <?php
        if (isset($_GET['reorder'])) {
            if ($_GET['reorder'] == 'success') {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Items added to cart successfully!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
            } elseif ($_GET['reorder'] == 'failed') {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to add items to cart. Please try again.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
            } elseif ($_GET['reorder'] == 'notfound') {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Order not found.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
            }
        }
        ?>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
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
                                <td><?php echo $order['township']; ?></td>
                                <td>
                                    <?php
                                    if ($order['status'] == 'Accepted') {
                                    ?>
                                        <p class="text-success"><?php echo $order['status']; ?></p>
                                    <?php
                                    } elseif ($order['status'] == 'Declined') {
                                    ?>
                                        <p class="text-danger"><?php echo $order['status']; ?></p>
                                    <?php
                                    } else {
                                    ?>
                                        <p>Pending</p>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="reorder.php?order_code=<?php echo $order['order_code']; ?>" class="btn btn-primary btn-sm">Reorder</a>
                                    <?php
                                    if ($order['status'] == 'Accepted') {
                                    ?>
                                        <a href="invoice.php?order_code=<?php echo $order['order_code']; ?>" class="btn btn-warning btn-sm">Invoice</a>
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
        <div>
            <a href="menu.php" class="btn btn-danger">Back</a>
        </div>
    </div>
</body>

</html>