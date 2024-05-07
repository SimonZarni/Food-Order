<?php
include_once __DIR__ . "/../../controller/PaymentController.php";
$id = $_GET['id'];
$payment_controller = new PaymentController();
if (isset($_GET['id'])) {
    $payment = $payment_controller->getPayment($id);
}

if (isset($_POST['update'])) {
    $error = false;
    if (!empty($_POST['payment'])) {
        $method = $_POST['payment'];
    } else {
        $error = true;
        $method_error = "Please enter your payment method";
        echo $method_error;
    }
    echo $error;

    if (!$error) {
        $status = $payment_controller->updatePayment($id, $method);
        if ($status) {
            $message = "update_status";
            header('location:payment_list.php?update_status=' . $message);
        }
    } else {
        echo $error;
    }
}
include_once __DIR__ . "/../../layouts/sidebar.php";
?>
<div class="container"> <!-- Added mt-4 for top margin -->
    <div class="row justify-content-center">
        <div class="col-md-6 my-5">
            <div class="card my-5">
                <div class="card-header">
                    <h4 class="card-title">Edit Payment Method for ID-<?php echo $id ?></h4>
                </div>
                <div class="card-body">
                    <form action="" method="Post">
                        <div class="form-group">
                            <label for="paymentMethod">Payment Method:</label>
                            <input type="text" class="form-control my-3" id="paymentMethod" placeholder="Enter Payment Method" name="payment" value="<?php echo $payment['method'] ?>">
                            <span class="text-danger my-2"><?php if (isset($method_error)) echo $method_error; ?></span><br>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="mx-2 mt-3">
                                <button class="btn btn-warning mt-2" name="update">Update</button>
                            </div>
                            <div class="mx-2 mt-3">
                                <button type="reset" class="btn btn-danger mt-2">Clear</button>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="payment_list.php">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . "/../../layouts/footer.php";
?>