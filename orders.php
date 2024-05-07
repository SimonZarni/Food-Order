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
    <div class="container">
        <h4>Orders History</h4>
        <strong>Customer Name: </strong><?php echo $orders[0]['username'] ?>
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
                                <?php
                                if ($order['status'] == 'Accepted') {
                                ?>
                                    <td><a href="invoice.php?order_code=<?php echo $order['order_code']; ?>" class="btn btn-warning">Invoice</a></td>
                                <?php
                                }
                                ?>
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