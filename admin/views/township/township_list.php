<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/TownshipController.php';

$township_controller = new TownshipController();
$townships = $township_controller->getTownships();
?>

<div class="container-fluid">
    <?php
    if (isset($_GET['status'])) {
        echo ' <div class="alert alert-success" role="alert">New Township was added successfully.</div>';
    } elseif (isset($_GET['update_status'])) {
        echo ' <div class="alert alert-success" role="alert">Township was edited Successfully.</div>';
    } elseif (isset($_GET['delete_status'])) {
        echo ' <div class="alert alert-success" role="alert">Township was deleted successfully.</div>';
    }
    ?>
    <a href="create_township.php" class="btn btn-success">Create Township</a>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Township</th>
                                <th>Fee</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($townships as $township) {
                                if($township['status']==null){
                                    if($township['deleted_at']==null){
                            ?>
                                <tr>
                                    <td><?php echo $township['id']; ?></td>
                                    <td><?php echo $township['name']; ?></td>
                                    <td><?php echo $township['fee']; ?></td>
                                    <td>
                                        <a href="township.php?id=<?php echo $township['id']; ?>" class="btn btn-info mx-2">View</a>
                                        <a href="edit_township.php?id=<?php echo $township['id']; ?>" class="btn btn-warning mx-2">Edit</a>
                                        <a href="delete_township.php?id=<?php echo $township['id']; ?>" onclick="return confirm('Are you sure to delete this township?');" class="btn btn-danger mx-2">Delete</a>
                                    </td>
                                </tr>
                            <?php
                                    }
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