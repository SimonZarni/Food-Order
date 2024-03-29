<?php
session_start();
include_once __DIR__ . '/../../controller/AuthenticationController.php';

$auth_controller = new AuthenticationController();

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
        if ($auth_controller->isemailExists($email)) {
            $error = "User with this email already exists.";
        } else {
            $otp = $auth_controller->otpVerify($email);
            if (!empty($otp)) {
                $_SESSION['otp'] = $otp;
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: otp_verify.php');
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
  <title>Modernize Free</title>
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
                    <input type="password" name="password" class="form-control" id="">
                    <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                  </div>
                  <div class="mb-4">
                    <label for="" class="form-label">Confirm Password</label>
                    <input type="password" name="con_password" class="form-control" id="">
                    <span class="text-danger"><?php if (isset($conPass_error)) echo $conPass_error; ?></span>
                  </div>
                  <span class="text-danger"><?php if (isset($error)) echo $error; ?></span>
                  <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="submit">Sign Up</button>
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
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>