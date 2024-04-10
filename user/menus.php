<?php
include_once __DIR__ . '/controller/MenuController.php';

$restaurant_id = $_GET['id'];

$menu_controller = new MenuController();
$menus = $menu_controller->getMenusByRestaurant($restaurant_id);

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
            <div class="col-lg-7 mx-auto text-center mb-5">
                <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">Menus</h5>
            </div>
            <div class="row gx-3 h-100 align-items-center">
                <?php foreach ($menus as $menu) { ?>
                    <div class="col-sm-6 col-md-4 mb-5 h-100">
                        <div class="card card-span h-100 rounded-3">
                            <img class="img-fluid rounded-3" src="../admin/uploads/<?php echo $menu['image']; ?>" alt="..." style="height: 300px;" />
                            <div class="card-body ps-0">
                                <h5 class="fw-bold text-1000 text-truncate mb-1"><?php echo $menu['name']; ?></h5>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <a class="btn btn-lg btn-danger" href="items.php?restaurant_id=<?php echo $restaurant_id; ?>&menu_id=<?php echo $menu['id']; ?>" role="button">View Items</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
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