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
    $emailExists = false;
    foreach ($users as $user) {
      if ($email == $user['email']) {
        $emailExists = true;
        break;
      }
    }

    if ($emailExists) {
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
?>
<!DOCTYPE html>
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



<style>
  body {
    background-image: url(images/register_bg.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: top;
    background-attachment: fixed;
  }

  .login_formbg {
    background: transparent;
    border: 1px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(5px);
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
  }

  h2,
  label {
    color: rgb(209, 186, 130);
  }

  .input_group {
    position: relative;
    width: 100%;
    height: 50px;
  }

  .input_group input {
    background: transparent;
    border: none;
    outline: none;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 40px;
    width: 100%;
    height: 100%;
    font-size: 1.01rem;
    color: rgb(209, 186, 130);
    padding: 20px 45px 20px 20px;
  }

  .input_group input::placeholder {
    color: rgb(209, 186, 130);
  }

  .input_group i {
    position: absolute;
    right: 14px;
    top: 11px;
    font-size: 1.1rem;
    color: rgb(209, 186, 130);
  }

  .forgot_group input {
    accent-color: #fff;
    margin-right: 3px;
  }

  .forgot_group label {
    font-size: 0.8rem;
    margin-right: 20px;
  }

  .forgot_group a {
    font-size: 0.8rem;
    margin: 2px;
  }

  .submit_btn {
    width: 100%;
    border-radius: 40px;
    background-color: brown;
    color: white;
  }

  .submit_btn:hover {
    background-color: rgb(98, 26, 26);
    color: white;
  }
</style>

<body>

  <div class="login_container ms-5 d-flex justify-content-center align-items-center" style="height:100vh">
    <div class="p-4 py-5 login_formbg col-md-4 col-8" style="border-radius:20px;">
      <div class="text-center">
        <h2>Registration</h2>
      </div>
      <form action="" method="post" class="m-4">
        <div class="mb-3 input_group">
          <input type="text" name="name" id="" placeholder="Name">
          <i class="bi bi-person fs-5"></i>
          <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
        </div>
        <div class="mb-3 input_group">
          <input type="email" name="email" id="" aria-describedby="emailHelp" placeholder="Email">
          <i class="bi bi-envelope-at"></i>
          <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
        </div>

        <div class="mb-3">
          <div class="input_group">
            <input type="password" name="password" id="password" placeholder="Password">
            <i class="bi bi-eye"></i>
            <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
          </div>
        </div>

        <div class="mb-3">
          <div class="input_group">
            <input type="password" name="con_password" id="password" placeholder="Confirm Password">
            <i class="bi bi-eye"></i>
            <span class="text-danger"><?php if (isset($conPass_error)) echo $conPass_error; ?></span>

          </div>
        </div>
        <span class="text-danger"><?php if (isset($error)) echo $error; ?></span>
        <button class="btn mb-2 submit_btn" name="submit">Sign Up</button>
        <div class="d-flex align-items-center justify-content-center">
          <p class="mb-0 fw-medium text-light" style="font-size:0.9rem;margin-top:2px;">Already have an Account?</p>
          <a class="ms-2" style="color:rgb(209, 186, 130);" style="font-size:0.9rem" href="login.php">Sign In</a>
        </div>
      </form>
    </div>
  </div>
  <script src="../../src/js/script.js"></script>
</body>

</html>