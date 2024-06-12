<?php
session_name('user');
session_start();
include_once __DIR__ . '/controller/FavouriteController.php';

$user_id = $_SESSION['id'];

$favourite_controller = new FavouriteController();
$favourites = $favourite_controller->getFavouriteRestaurants($user_id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="csss/bootstrap-steps.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    if ($favourites) {
    ?>
        <div class="container mt-5">
            <h2>Your Favourite Restaurants</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php foreach ($favourites as $favourite) {
                ?>
                    <div class="col">
                        <div class="card restaurant-display">
                            <a href="item.php?restaurant_id=<?php echo $favourite['id']; ?>">
                                <img src="admin/uploads/<?php echo $favourite['profile_img']; ?>" class="img-fluid" style="height:180px" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $favourite['name']; ?></h5>
                                    <p class="card-text"><?php echo $favourite['open_time']; ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "You haven't added any restaurant to your favourites.";
            }
            ?>
            </div>
        </div>
</body>

</html>