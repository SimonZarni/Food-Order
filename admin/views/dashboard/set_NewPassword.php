<?php
session_start();
include_once  __DIR__ . '/../../controller/AuthenticationController.php';

$auth_controller = new AuthenticationController();

if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $con_password = $_POST['con_password'];
    $email = $_SESSION['email'];

    if ($password == $con_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $status = $auth_controller->updatePassword($hashed_password, $email);
        if ($status) {
            $admin_info = $auth_controller->getAdmins();
            foreach ($admin_info as $admin) {
                $_SESSION['id'] = $admin['id'];
                $_SESSION['name'] = $admin['name'];
            }
            header('location: index.php?reset_status=success');
            exit;
        } else {
            $error = "Password could not be updated.";
        }
    } else {
        $error = "Password and confirm password do not match.";
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
                    <label for="" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Confirm Password</label>
                    <input type="password" name="con_password" class="form-control" id="" aria-describedby="emailHelp">
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