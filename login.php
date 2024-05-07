<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_name('user');
session_start();
include_once __DIR__ . '/controller/AuthenticationController.php';

$auth_controller = new AuthenticationController();
$users = $auth_controller->getUsers();

if (isset($_POST['submit'])) {
  foreach ($users as $user) {
    if ($_POST['email'] == $user['email'] && password_verify($_POST['password'], $user['password'])) {
      $_SESSION['id'] = $user['id'];
      $_SESSION['name'] = $user['name'];
      $_SESSION['email'] = $user['email'];
      header('location: index.php');
    } else {
      $error = "Invalid email or password.";
    }
  }
}

// include_once __DIR__ . '/layout/sidebar.php';

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="css/style.css">
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
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                      <input type="password" name="password" class="form-control" id="password">
                      <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                        <i class="ti ti-eye"></i>
                      </button>
                    </div>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="forgot_password.php">Forgot Password ?</a>
                  </div>
                  <span class="text-danger"><?php if (isset($error)) echo $error; ?></span>
                  <button class="btn btn-primary mb-4 rounded-2" name="submit">Sign In</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">New to FoodWagon?</p>
                    <a class="text-primary fw-bold ms-2" href="register.php">Create an account</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../../src/js/script.js"></script>
</body>

</html>