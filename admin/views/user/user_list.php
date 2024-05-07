<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/UserController.php';

$user_controller = new UserController();
$users = $user_controller->getUsers()

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-block align-items-center justify-content-between mb-9">
                    <table class="table table-striped text-center" id="userTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users as $user) {
                                if($user['status']==null){
                            ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo $user['name']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td>
                                        <a href="user.php?id=<?php echo $user['id']; ?>" class="btn btn-info mx-2"><i class="ti ti-eye"></i></a>
                                        <a href="delete_user.php?" onclick="return confirm('Are you sure to delete this user?');" class="btn btn-danger mx-2"><i class="ti ti-trash"></i></a>
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