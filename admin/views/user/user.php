<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/UserController.php';

$id = $_GET['id'];
$user_controller = new UserController();
$user = $user_controller->getUser($id);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="card bg-body-tertiary shadow rounded" style="width: 400px;">
                        <div class="card-body">
                            <p class="card-text">ID: <?php echo $user['id']; ?></p>
                            <p class="card-text">Total Price: <?php echo $user['name']; ?></p>
                            <p class="card-text">Customer Name: <?php echo $user['email']; ?></p>
                            <p class="card-text">Payment: <?php echo $user['address']; ?></p>
                            <a href="user_list.php" class="btn btn-primary">Back</a>
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