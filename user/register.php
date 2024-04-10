<?php
session_name('user');
session_start();
include_once __DIR__ . '/controller/AuthenticationController.php';

$auth_controller = new AuthenticationController();
$users = $auth_controller->getUsers();

$name_error = $email_error = $password_error = $conPass_error = $error = "";

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $con_password = $_POST['con_password'];

  if (empty($name)) {
    $name_error = "Please enter your name";
  }
  if (empty($email)) {
    $email_error = "Please enter your email";
  }
  if (empty($password)) {
    $password_error = "Please enter your password";
  }
  if (empty($con_password)) {
    $conPass_error = "Please enter your confirm password";
  }

  if ($_POST['password'] != $_POST['con_password']) {
    $error = 'Password and Confirm Password do not match.';
  } else {
    foreach ($users as $user) {
      if ($email == $user['email']) {
        $error = "User with this email already exists.";
      } else {
        $otp = $auth_controller->otpVerify($email);
        if (!empty($otp)) {
          $_SESSION['otp'] = $otp;
          $_SESSION['name'] = $name;
          $_SESSION['email'] = $email;
          $_SESSION['password'] = $password;
          header('location: otp_verify.php');
          exit;
        }
      }
    }
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Foodwagon</title>
  <link rel="apple-touch-icon" sizes="180x180" href="public/assets/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="public/assets/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="public/assets/img/favicons/favicon-16x16.png">
  <link rel="shortcut icon" type="image/x-icon" href="public/assets/img/favicons/favicon.ico">
  <link rel="manifest" href="public/assets/img/favicons/manifest.json">
  <meta name="msapplication-TileImage" content="public/assets/img/favicons/mstile-150x150.png">
  <meta name="theme-color" content="#ffffff">
  <link href="public/assets/css/theme.css" rel="stylesheet" />
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">    
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <form action="" method="post">
                  <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="" aria-describedby="textHelp">
                    <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" id="" aria-describedby="emailHelp">
                    <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                  </div>
                  <div class="mb-4">
                    <label for="" class="form-label">Password</label>
                    <div class="input-group">
                      <input type="password" name="password" class="form-control" id="password">
                      <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                        <i class="ti ti-eye"></i>
                      </button>
                    </div>
                    <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                  </div>
                  <div class="mb-4">
                    <label for="" class="form-label">Confirm Password</label>
                    <div class="input-group">
                      <input type="password" name="con_password" class="form-control" id="con_password">
                      <button type="button" class="btn btn-outline-secondary" id="toggleConPassword">
                        <i class="ti ti-eye"></i>
                      </button>
                    </div>
                    <span class="text-danger"><?php if (isset($conPass_error)) echo $conPass_error; ?></span>
                  </div>
                  <span class="text-danger"><?php if (isset($error)) echo $error; ?></span>
                  <button class="btn btn-primary mb-4 rounded-2" name="submit">Sign Up</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                    <a class="text-primary fw-bold ms-2" href="login.php">Sign In</a>
                  </div>
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