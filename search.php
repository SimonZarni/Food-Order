<?php
include_once __DIR__ . '/layout/sidebar.php';
include_once __DIR__ . '/controller/RestaurantController.php';

$keyword = $_GET['keyword'];

$restaurant_controller = new RestaurantController();
$restaurants = $restaurant_controller->searchRestaurantsByKeyword($keyword);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Available Restaurants</h2>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach ($restaurants as $restaurant) {
            ?>
                <div class="col">
                    <div class="card restaurant-display">
                    <i class="bi bi-heart-fill heart-icon" data-liked="false" data-restaurant_id="<?php echo $restaurant['id']; ?>"></i>
                        <a href="item.php?restaurant_id=<?php echo $restaurant['id']; ?>">
                            <img src="admin/uploads/<?php echo $restaurant['profile_img']; ?>" class="img-fluid" style="height:180px" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $restaurant['restaurant_name']; ?></h5>
                                <p class="card-text"><?php echo $restaurant['open_time']; ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>