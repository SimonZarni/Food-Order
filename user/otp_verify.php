<?php
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
        foreach($user_info as $user){
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
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <form action="" method="post">
                  <div class="mb-3">
                    <label for="" class="form-label">OTP Code</label>
                    <input type="number" name="otp" class="form-control" id="" aria-describedby="textHelp">
                    <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                  </div>
                  <span class="text-danger"><?php if (isset($error)) echo $error; ?></span>
                  <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="submit">Sign Up</button>
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