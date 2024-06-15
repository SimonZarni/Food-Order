<?php
session_start();
include_once __DIR__ . '/../../controller/AuthenticationController.php';

if (isset($_POST['submit'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $con_newPassword = $_POST['con_newPassword'];

    $id = $_SESSION['id'];
    $auth_controller = new AuthenticationController();
    $admin = $auth_controller->getAdmin($id);
    if (password_verify($old_password, $admin['password'])) {
        if ($new_password === $con_newPassword) {
            $status = $auth_controller->editPassword(password_hash($new_password, PASSWORD_DEFAULT), $id);

            if ($status) {
                header('location: index.php?change_status=success');
                exit();
            } else {
                $error = "Failed to update password.";
            }
        } else {
            $error = "New password and confirm new password do not match.";
        }
    } else {
        $error = "Old password is incorrect.";
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Drop</title>
    <link rel="shortcut icon" type="image/png" href="../../src/images/logos/favicon.png" />
    <link rel="stylesheet" href="../../src/css/styles.min.css" />
</head>
<body>
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <form action="" method="post">
                  <div class="mb-3">
                    <label for="" class="form-label">Old Password</label>
                    <input type="password" name="old_password" class="form-control" id="" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">New Password</label>
                    <input type="password" name="new_password" class="form-control" id="" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">ConfirmNew Password</label>
                    <input type="password" name="con_newPassword" class="form-control" id="" aria-describedby="emailHelp">
                  </div>
                  <span class="text-danger"><?php if (isset($error)) echo $error; ?></span>
                  <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="submit">Update</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</body>
</html>