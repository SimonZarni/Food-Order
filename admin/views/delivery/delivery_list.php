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
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Address</th>
                                <th>Delivery Date</th>
                                <th>Order ID</th>
                                <th>Township</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($deliveries as $delivery) {
                                if($delivery['status']==null){
                            ?>
                                <tr>
                                    <td><?php echo $delivery['id']; ?></td>
                                    <td><?php echo $delivery['address']; ?></td>
                                    <td><?php echo $delivery['delivery_date']; ?></td>
                                    <td><?php echo $delivery['order_id']; ?></td>
                                    <td><?php echo $delivery['township']; ?></td>
                                    <td></td>
                                    <td>
                                        <a href="delivery.php?id=<?php echo $delivery['id']; ?>" class="btn btn-info mx-2"><i class="ti ti-eye"></i></a>
                                        <a href="edit_delivery.php?" onclick="return confirm('Are you sure to accept this order?');" class="btn btn-success mx-2"><i class="ti ti-pencil"></i></a>
                                        <a href="delete_delivery.php?" onclick="return confirm('Are you sure to decline this order?');" class="btn btn-danger mx-2"><i class="ti ti-trash"></i></a>
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