<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/OrderController.php';
include_once __DIR__ . '/../../controller/TownshipController.php';

$order_controller = new OrderController();
$township_controller = new TownshipController();

$orders = $order_controller->getUndeliverdOrders();
$undelivered_orders = $order_controller->getUndeliveredStatusOrders();

$townships = $township_controller->getTownships();

if (isset($_GET['order_date'])) {
    $order_date = $_GET['order_date'];
    $orders = $order_controller->filterOrder($order_date, $orders);
    $undelivered_orders = $order_controller->filterOrder($order_date, $orders);
}

$minPrice = isset($_GET['min_price']) ? $_GET['min_price'] : null;
$maxPrice = isset($_GET['max_price']) ? $_GET['max_price'] : null;
if ($minPrice !== null || $maxPrice !== null) {
    $orders = $order_controller->getOrdersByPrice($minPrice, $maxPrice, $orders);
    $undelivered_orders = $order_controller->getOrdersByPrice($minPrice, $maxPrice, $orders);
}

if (isset($_GET['township'])) {
    $townshipId = $_GET['township'];
    $orders = $order_controller->getOrdersByTownship($townshipId, $orders);
    $undelivered_orders = $order_controller->getOrdersByTownship($townshipId, $orders);
}

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
        <!-- <form action="" method="GET" class="mb-3">
            <div class="form-group">
                <label for="orderDate">Filter by Order Date:</label>
                <input type="date" class="form-control" id="orderDate" name="order_date">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Filter</button>
        </form> -->
        <div class="row">
            <div class="col-md-6">
                <form action="" method="GET" class="mb-3">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="minPrice">Minimum Total Price:</label>
                            <input type="number" class="form-control" id="minPrice" name="min_price" value="<?php echo isset($_GET['min_price']) ? $_GET['min_price'] : ''; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="maxPrice">Maximum Total Price:</label>
                            <input type="number" class="form-control" id="maxPrice" name="max_price" value="<?php echo isset($_GET['max_price']) ? $_GET['max_price'] : ''; ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Filter</button>
                </form>
            </div>
            <div class="col-md-6">
                <form action="" method="get">
                    <div class="form-group">
                        <label for="township">Township:</label>
                        <select class="form-control" id="township" name="township">
                            <option value="" disabled selected>Select Township</option>
                            <?php
                            foreach ($townships as $township) {
                                echo "<option value='" . $township['id'] . "'";
                                if (isset($_GET['township']) && $_GET['township'] == $township['id']) {
                                    echo " selected";
                                }
                                echo ">" . $township['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Filter</button>
                </form>
            </div>
        </div>
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
                                <th>Order Time</th>
                                <th>Customer Name</th>
                                <th>Township</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($orders) {
                            foreach ($orders as $order) {
                            ?>
                                <tr>
                                    <td><?php echo $order['id']; ?></td>
                                    <td><?php echo $order['order_code']; ?></td>
                                    <td><?php echo $order['subtotal']; ?></td>
                                    <td><?php echo $order['order_date']; ?></td>
                                    <td><?php echo $order['order_time']; ?></td>
                                    <td><?php echo $order['username']; ?></td>
                                    <td><?php echo $order['township']; ?></td>
                                    <td>
                                        <?php
                                        if ($order['status'] == 'Accepted') {
                                            echo "<p class='text-success'>" . $order['status'] . "</p>";
                                        } elseif ($order['status'] == 'Declined') {
                                            echo "<p class='text-danger'>" . $order['status'] . "</p>";
                                        } else {
                                            echo "Pending";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($order['status'] == 'Accepted') {
                                        ?>
                                            <a href="invoice.php?order_code=<?php echo $order['order_code']; ?>" class="btn btn-info mx-2"><i class="ti ti-eye"></i></a>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($order['status'] == "Pending") {
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
                            } else {
                                foreach($undelivered_orders as $undelivered_order){
                            ?>
                            <tr>
                                    <td><?php echo $undelivered_order['id']; ?></td>
                                    <td><?php echo $undelivered_order['order_code']; ?></td>
                                    <td><?php echo $undelivered_order['subtotal']; ?></td>
                                    <td><?php echo $undelivered_order['order_date']; ?></td>
                                    <td><?php echo $undelivered_order['order_time']; ?></td>
                                    <td><?php echo $undelivered_order['username']; ?></td>
                                    <td><?php echo $undelivered_order['township']; ?></td>
                                    <td>
                                        <?php
                                        if ($undelivered_order['status'] == 'Accepted') {
                                            echo "<p class='text-success'>" . $undelivered_order['status'] . "</p>";
                                        } elseif ($undelivered_order['status'] == 'Declined') {
                                            echo "<p class='text-danger'>" . $undelivered_order['status'] . "</p>";
                                        } else {
                                            echo "Pending";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($undelivered_order['status'] == 'Accepted') {
                                        ?>
                                            <a href="invoice.php?order_code=<?php echo $undelivered_order['order_code']; ?>" class="btn btn-info mx-2"><i class="ti ti-eye"></i></a>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($undelivered_order['status'] == "Pending") {
                                        ?>
                                            <a href="accept_order.php?id=<?php echo $undelivered_order['id']; ?>" onclick="return confirm('Are you sure to accept this order?');" class="btn btn-success mx-2"><i class="ti ti-check"></i></a>
                                            <a href="decline_order.php?id=<?php echo $undelivered_order['id']; ?>" onclick="return confirm('Are you sure to decline this order?');" class="btn btn-danger mx-2"><i class="ti ti-x"></i></a>
                                        <?php
                                        }
                                        ?>
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