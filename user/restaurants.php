<?php
include_once __DIR__ . '/controller/RestaurantController.php';

$menu_id = $_GET['id'];

$restaurant_controller = new RestaurantController();
$restaurants = $restaurant_controller->getRestaurantsByMenu($menu_id);

?>

<!DOCTYPE html>
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
    <div class="container">
        <div class="row h-100">
        <div class="col-lg-7 mx-auto text-center">
            <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">Restaurants</h5>
        </div>
        </div>
        <div class="row gx-2">
        <?php
        foreach($restaurants as $restaurant){
            if($restaurant['status'] == null){
        ?>
        <div class="col-sm-6 col-md-4 col-lg-3 h-100 mb-5">
            <a href="items.php?menu_id=<?php echo $menu_id; ?>&restaurant_id=<?php echo $restaurant['id']; ?>">
            <div class="card card-span h-100 text-white rounded-3"><img class="img-fluid rounded-3 h-100" src="public/assets/img/gallery/food-world.png" alt="..." />
                <div class="card-img-overlay ps-0">
                    <span class="badge bg-danger p-2 ms-3"><i class="fas fa-tag me-2 fs-0"></i><span class="fs-0">20% off</span></span>
                    <span class="badge bg-primary ms-2 me-1 p-2"><i class="fas fa-clock me-1 fs-0"></i><span class="fs-0">Fast</span></span>
                </div>
                <div class="card-body ps-0">
                <div class="d-flex align-items-center mb-3"><img class="img-fluid" src="public/assets/img/gallery/food-world-logo.png" alt="" />
                    <div class="flex-1 ms-3">
                    <h5 class="mb-0 fw-bold text-1000"><?php echo $restaurant['name']; ?></h5><span class="text-primary fs--1 me-1"><i class="fas fa-star"></i></span><span class="mb-0 text-primary">46</span>
                    </div>
                </div><span class="badge bg-soft-danger p-2"><span class="fw-bold fs-1 text-danger">Opens Tomorrow</span></span>
                </div>
            </div>
            </a>
        </div>
        <?php
            }
        }
        ?>
        </div>
    </div>

    <script src="public/vendors/@popperjs/popper.min.js"></script>
    <script src="public/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="public/vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="public/vendors/fontawesome/all.min.js"></script>
    <script src="public/assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700;900&amp;display=swap" rel="stylesheet">
</body>
</html>

