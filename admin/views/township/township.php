<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/TownshipController.php';

$id=$_GET['id'];
$township_controller=new TownshipController();
$township=$township_controller->getTownship($id);
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
                                <th>Township Name</th>
                                <th>Deli Fee</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                echo "<td>".$township[0]['id']."</td>";
                                echo "<td>".$township[0]['name']."</td>";
                                echo "<td>".$township[0]['fee']."</td>";
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