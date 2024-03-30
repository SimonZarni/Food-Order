<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/PaymentController.php';

$id = $_GET['id'];
$payment_controller = new PaymentController();
$payment = $payment_controller->getPayment($id);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="card bg-body-tertiary shadow rounded" style="width: 400px;">
                        <div class="card-body">
                            <p class="card-text">ID: <?php echo $payment['id']; ?></p>
                            <p class="card-text">Payment Method: <?php echo $payment['method']; ?></p>
                            <a href="payment_list.php" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . '/../../layouts/footer.php';
?>