<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/DeliveryController.php';

$delivery_controller = new DeliveryController();
$deliveries = $delivery_controller->getDeliveris();

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-block align-items-center justify-content-between mb-9">
                    <table class="table table-striped text-center" id="deliveryTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Order ID</th>
                                <th>Delivery Date</th>
                                <th>Township</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($deliveries as $delivery) {
                            ?>
                                <tr>
                                    <td><?php echo $delivery['id']; ?></td>
                                    <td><?php echo $delivery['order_code']; ?></td>
                                    <td><?php echo $delivery['delivery_date']; ?></td>
                                    <td><?php echo $delivery['township']; ?></td>
                                    <td>
                                    <?php
                                        if ($delivery['status'] == 'Delivered') {
                                            echo "<p class='text-success'>" . $delivery['status'] . "</p>";
                                        } else {
                                            echo "<p class='text-danger'>" . $delivery['status'] . "</p>";
                                        }
                                    ?>
                                    <td>
                                        <a href="delivery.php?id=<?php echo $delivery['id']; ?>" class="btn btn-info mx-2"><i class="ti ti-eye"></i></a>
                                        <?php
                                            if($delivery['status'] == "Not Delivered"){
                                        ?>
                                                <a href="accept_delivery.php?id=<?php echo $delivery['id']; ?>" onclick="return confirm('Are you sure to accept this delivery?');" class="btn btn-success mx-2"><i class="ti ti-check"></i></a>
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