<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_name('user');
session_start();
include_once __DIR__ . '/controller/AuthenticationController.php';

if (isset($_POST['submit'])) {
  $name = $_SESSION['name'];
  $email = $_SESSION['email'];
  $password = $_SESSION['password'];
  if ($_POST['otp'] == $_SESSION['otp']) {
    $auth_controller = new AuthenticationController();
    $status = $auth_controller->createUser($name, $email, $password);
    $user_info = $auth_controller->getUsers();
    foreach ($user_info as $user) {
      $user_id = $user['id'];
    }
    if (!empty($status)) {
      $_SESSION['id'] = $user_id;
      $_SESSION['name'] = $name;
      header('location: index.php');
      exit;
    }
  } else {
    $error = "Invalid OTP.";
  }
}
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

  .submit_btn button {
    width: 85%;
    border-radius: 40px;
    background-color: brown;
    color: white;
  }

  .submit_btn button:hover {
    background-color: rgb(98, 26, 26);
    color: white;
  }
</style>

<body>
  <div class="login_container ms-5 d-flex justify-content-center align-items-center" style="height:100vh">
    <div class="p-4 py-5 login_formbg col-md-4 col-8" style="border-radius:20px;">
      <div class="text-center">
        <h2>OTP Verify</h2>
      </div>
      <form action="" method="post" class="m-4">
        <div class="mb-3 input_group">
          <input type="number" name="otp" id="" placeholder="OTP Code">
          <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
        </div>
        <div class="submit_btn d-flex justify-content-center">
          <button class="btn mb-2" name="submit">Submit</button>
        </div>
      </form>
</body>