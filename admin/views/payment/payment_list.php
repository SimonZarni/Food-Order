<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/PaymentController.php';

$paymentController = new PaymentController();
$payments = $paymentController->getPayments();
?>

<div class="container-fluid">
    <?php
    if (isset($_GET['status'])) {
        echo ' <div class="alert alert-success" role="alert">New Payment Method added successfully.</div>';
    } elseif (isset($_GET['update_status'])) {
        echo ' <div class="alert alert-success" role="alert">Payment Method updated Successfully.</div>';
    } elseif (isset($_GET['delete_status'])) {
        echo ' <div class="alert alert-success" role="alert">Payment Method deleted successfully.</div>';
    }
    ?>
    <a href="create_payment.php" class="btn btn-success">Add Payment Method</a>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Payment Method</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($payments as $payment) {
                                if ($payment['status'] == null) {
                            ?>
                                <tr>
                                    <td><?php echo $payment['id']; ?></td>
                                    <td><?php echo $payment['method']; ?></td>
                                    <td>
                                        <a href="payment.php?id=<?php echo $payment['id']; ?>" class="btn btn-info mx-2"><i class="ti ti-eye"></i></a>
                                        <a href="edit_payment.php?id=<?php echo $payment['id']; ?>" class="btn btn-warning mx-2"><i class="ti ti-pencil"></i></a>
                                        <a href="delete_payment.php?id=<?php echo $payment['id']; ?>" onclick="return confirm('Are you sure to delete this payment method?');" class="btn btn-danger mx-2"><i class="ti ti-trash"></i></a>
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