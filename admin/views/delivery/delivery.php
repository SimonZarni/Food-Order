<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/DeliveryController.php';

$delivery_controller = new DeliveryController();
$deliveries = $delivery_controller->getDeliveris();

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Delivery Information
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer Name</th>
                                    <th>Address</th>
                                    <th>Delivery Date</th>
                                    <th>Township</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($deliveries as $delivery) { ?>
                                    <tr>
                                        <td><?php echo $delivery['id']; ?></td>
                                        <td><?php echo $delivery['user']; ?></td>
                                        <td><?php echo $delivery['address']; ?></td>
                                        <td><?php echo $delivery['delivery_date']; ?></td>
                                        <td><?php echo $delivery['township']; ?></td>
                                        <?php
                                            if ($delivery['status'] == 'Delivered') {
                                                echo "<td class='text-success'>" . $delivery['status'] . "</td>";
                                            } else {
                                                echo "<td class='text-danger'>" . $delivery['status'] . "</td>";
                                            }
                                        ?>
                                        </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <a href="delivery_list.php" class="btn btn-primary">Back</a>
    </div>
</div>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
