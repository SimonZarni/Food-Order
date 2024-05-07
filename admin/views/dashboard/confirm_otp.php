<?php
session_start();

if (isset($_POST['submit'])) {
    if ($_POST['otp'] == $_SESSION['otp']) {
        header("location: set_NewPassword.php");
        exit;
    } else {
        $error = 'Invalid OTP';
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                    <label for="" class="form-label">OTP</label>
                    <input type="number" name="otp" class="form-control" id="" aria-describedby="emailHelp">
                  </div>
                  <span class="text-danger"><?php if (isset($error)) echo $error; ?></span>
                  <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="submit">Submit</button>
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