<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/PaymentController.php';

$id=$_GET['id'];
$payment_controller=new PaymentController();
$payments=$payment_controller->getPayments();
echo "hello";
?>
<div class="container-fluid">
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
                                foreach($payments as $payment){
                                    if($payments['id']==$id){
                                        $new_payment=$payment;
                                        break;
                                    }
                                }
                                echo "<td>".$payment['id']."</td>";
                                echo "<td>".$payment['method']."</td>";
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'layout/footer.php';
?>
<?php
include_once __DIR__ . '/../../layouts/footer.php';
?>