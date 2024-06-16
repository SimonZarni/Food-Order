<?php
include_once __DIR__ . '/layout/sidebar.php';
include_once __DIR__ . '/controller/FavouriteController.php';

$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

$favourite_controller = new FavouriteController();
$favourites = $user_id ? $favourite_controller->getFavouriteRestaurants($user_id) : [];
$favouritesCount = count($favourites);
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
    <div class="container">
        <div style="margin-top:80px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="menu.php" style="color:rgb(209, 186, 130);">Menu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Favourite</li>
                </ol>
            </nav>
        </div>
        <h4>Your Favourite Restaurants</h4>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach ($favourites as $favourite) {
            ?>
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card restaurant-display">
                        <a href="item.php?restaurant_id=<?php echo $favourite['id']; ?>">
                            <div class="d-flex justify-content-center">
                                <img src="admin/uploads/<?php echo $favourite['profile_img']; ?>" class="img-fluid" style="height:180px" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $favourite['name']; ?></h5>
                                <p class="card-text"><?php echo $favourite['open_time']; ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="favourite_restaurant" style="margin-top:8rem;">

        </div>
    </div>
</body>

</html>
<?php
include_once __DIR__ . '/layout/footer.php';
?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const userId = '<?php echo isset($user_id) ? $user_id : ''; ?>';
        const favouritesCount = <?php echo $favouritesCount; ?>;
        const favourite_restaurant = document.querySelector('.favourite_restaurant');

        if (!userId) {
            favourite_restaurant.innerHTML = `
            <div>
                <div class="text-center">
                    <img src="images/favourite-empty.png" style="width:100px;height:100px;" alt="Empty">
                    <h4 class="text-danger mt-5">Please log in to view your favourite restaurants</h4>
                </div>
            </div>
        `;
        } else if (favouritesCount === 0) {
            favourite_restaurant.innerHTML = `
            <div>
                <div class="text-center">
                    <img src="images/favourite-empty.png" style="width:100px;height:100px;" alt="No Favourites">
                    <h4 class="text-warning mt-5">You have not added any favourite restaurants yet</h4>
                </div>
            </div>
        `;
        }
    });
</script>