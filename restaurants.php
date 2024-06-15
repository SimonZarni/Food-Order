<?php
include_once __DIR__ . '/layout/sidebar.php';
include_once __DIR__ . '/controller/RestaurantController.php';
include_once __DIR__ . '/controller/FavouriteController.php';

$menu_id = $_GET['menu_id'];

$restaurant_controller = new RestaurantController();
$restaurants = $restaurant_controller->getRestaurantsByMenu($menu_id);
$favourite_controller = new FavouriteController();
if (isset($_SESSION['id']))
    $user_id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Restaurants</h2>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach ($restaurants as $restaurant) {
                $isFavourite = $favourite_controller->isFavourite($user_id, $restaurant['id']);
                $favouriteClass = $isFavourite ? 'text-danger' : ''; // Change to text-danger for favorited restaurants
                $favouriteData = $isFavourite ? 'true' : 'false';
            ?>
                <!-- Restaurant card -->
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card restaurant-display">
                        <!-- Heart icon for favourite -->
                        <i class="bi bi-heart-fill heart-icon <?php echo $favouriteClass; ?>" data-liked="<?php echo $favouriteData; ?>" data-restaurant_id="<?php echo $restaurant['id']; ?>"></i>
                        <!-- Restaurant details -->
                        <a href="item.php?restaurant_id=<?php echo $restaurant['id']; ?>">
                            <div class="d-flex justify-content-center">
                                <img src="admin/uploads/<?php echo $restaurant['profile_img']; ?>" style="height:180px;width:200px" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $restaurant['name']; ?></h5>
                                <p class="card-text"><?php echo $restaurant['open_time']; ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const heartIcons = document.querySelectorAll('.heart-icon');

        heartIcons.forEach(icon => {
            icon.addEventListener('click', function() {
                const restaurantId = this.dataset.restaurant_id;
                const isLiked = this.dataset.liked === 'true';
                const newLikedStatus = !isLiked;

                fetch('toggle_favourite.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `restaurant_id=${restaurantId}&is_liked=${newLikedStatus}`,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update the UI immediately
                            if (newLikedStatus) {
                                icon.classList.add('text-danger');
                            } else {
                                icon.classList.remove('text-danger');
                            }
                            icon.dataset.liked = newLikedStatus.toString();
                        } else {
                            console.error('Error toggling favourite status:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error toggling favourite status:', error);
                    });
                location.reload();
            });
        });
    });
</script>

</html>