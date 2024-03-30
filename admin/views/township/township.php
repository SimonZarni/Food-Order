<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/TownshipController.php';

$id = $_GET['id'];
$township_controller = new TownshipController();
$township = $township_controller->getTownship($id);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="card bg-body-tertiary shadow rounded" style="width: 400px;">
                        <div class="card-body">
                            <p class="card-text">ID: <?php echo $township['id']; ?></p>
                            <p class="card-text">Township: <?php echo $township['name']; ?></p>
                            <p class="card-text">Fee: <?php echo $township['fee']; ?></p>
                            <a href="township_list.php" class="btn btn-primary">Back</a>
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