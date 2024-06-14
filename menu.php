<?php

include_once __DIR__ . "/layout/sidebar.php";
include_once __DIR__ . '/controller/MenuController.php';
include_once __DIR__ . '/controller/RestaurantController.php';
include_once __DIR__ . '/controller/ReviewController.php';
include_once __DIR__ . '/controller/PromotionController.php';
include_once __DIR__ . '/controller/FavouriteController.php';

if (isset($_SESSION['id']))
    $user_id = $_SESSION['id'];

$menu_controller = new MenuController();
$menus = $menu_controller->getMenus();

$restaurant_controller = new RestaurantController();
$restaurants = $restaurant_controller->getRestaurants();

$review_controller = new ReviewController();
$ratings = $review_controller->fetchAverageRatingsForAllRestaurants();

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
}

if (isset($keyword)) {
    $restaurants = $restaurant_controller->searchRestaurantsByKeyword($keyword);
}

$promotion_controller = new PromotionController();
$promotion_restaurants = $promotion_controller->getPromotionRestaurants();

$favourite_controller = new FavouriteController();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .modal-backdrop {
        z-index: 1040;
    }

    .modal {
        z-index: 1050;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="subnav d-flex justify-content-around shadow bg-body-tertiary py-2">
                <ul class="nav">
                    <li class="mt-2">
                        <form class="d-flex btn-search me-3" role="search" action="menu.php" method="get">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                            <button class="btn" type="submit">Search</button>
                        </form>
                    </li>
                    <li>
                        <button type="button" class="btn btn-link fs-4" style="color: rgb(209, 186, 130);" data-toggle="modal" data-target="#filterModal" data-backdrop="false">
                            <i class="bi bi-funnel"></i>
                        </button>
                    </li>
                </ul>

                <!-- Modal -->
                <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filterModalLabel">Filter Options</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="cuisineType"><b>Sort By</b></label>
                                        <div class="d-flex">
                                            <div class="form-check mx-3">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    Recommended
                                                </label>
                                            </div>
                                            <div class="form-check mx-3">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Rating
                                                </label>
                                            </div>
                                            <div class="form-check mx-3">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Delivery Time
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Filter Options -->
                                    <div class="form-group">
                                        <label for="cuisineType"><b>Cuisine Type</b></label>
                                        <select class="form-control" id="cuisineType">
                                            <option>Italian</option>
                                            <option>Chinese</option>
                                            <option>Mexican</option>
                                            \
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="priceRange"><b>Price Range</b></label>
                                        <input type="range" class="form-control-range" id="priceRange" min="1000" max="100000" step="1000" value="1000" oninput="updatePriceRange(this)">
                                        <span id="priceRangeValue">1,000</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="rating"><b>Rating</b></label>
                                        <select class="form-control" id="rating">
                                            <option>1 star</option>
                                            <option>2 stars</option>
                                            <option>3 stars</option>
                                            <option>4 stars</option>
                                            <option>5 stars</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Apply Filters</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- promotion -->
    <div class="container-fluid promo-container">
        <h2 class="mx-5">Find the Promotion</h2>
        <div class="promo-scroll">
            <?php
            foreach ($promotion_restaurants as $promotion_restaurant) {
            ?>
                <a href="item.php?restaurant_id=<?php echo $promotion_restaurant['restaurant_id']; ?>">
                    <div class="promo-item m-4">
                        <img src="admin/uploads/<?php echo $promotion_restaurant['image']; ?>" class="img-fluid" alt="">
                        <h5>Get Up To <?php echo $promotion_restaurant['discount']; ?>% Off</h5>
                    </div>
                </a>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="container-fluid scroll-container">
        <h2 class="mx-5">Your Favourite cuisines</h2>
        <div class="side-scroll">
            <?php
            foreach ($menus as $menu) {
                if ($menu['status'] == null) {
            ?>
                    <div class="scroll-item">
                        <button class="prev-button">❮</button> <!-- Previous button -->
                        <a href="restaurants.php?menu_id=<?php echo $menu['id']; ?>">
                            <div class="d-flex justify-content-center">
                                <img src="admin/uploads/<?php echo $menu['image']; ?>" class="img-fluid" style="width:130px;heigth:100px;" alt="">
                            </div>
                        </a>
                        <button class="next-button">❯</button> <!-- Next button -->
                        <div class="text-center">
                            <p><?php echo $menu['name']; ?></p>
                        </div>
                    </div>

            <?php
                }
            }
            ?>

        </div>

    </div>

    <!-- Restaurant -->

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

    <div class="modal fade" id="thankModal" tabindex="-1" aria-labelledby="thankYouModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center" id="processingMessage">
                        <img src="images/cooking.png" style="width: 100px; height:100px" alt="">
                        <h4 class="fw-bold">Your order is processing...</h4>
                        <h6 class="fw-bold mt-3">Please Waiting for your order, it will faster to be delivered</h6>
                    </div>
                    <div class="text-center d-none" id="thankYouMessage">
                        <h4 class="fw-bold">Thank you for your order!</h4>
                        <img src="images/order-success.jpg" style="width: 100px; height:100px" alt="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnModal d-none" data-bs-dismiss="modal">Continue</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="enjoyFoodModal" tabindex="-1" role="dialog" aria-labelledby="enjoyFoodModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enjoyFoodModalLabel">Enjoy Your Food</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Enjoy your food! Your delivery has been accepted.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script>
        jQuery(document).ready(function($) {
            function updateCartCount() {
                $.ajax({
                    type: 'GET',
                    url: 'cart_count.php',
                    success: function(response) {
                        $('#cart-count').text(response);
                    },
                    error: function() {
                        console.error('Error fetching cart count.');
                    }
                });
            }

            updateCartCount();
        });
    </script>

    <script>
        jQuery(document).ready(function($) {
            $('.heart-icon').click(function() {
                var $heartIcon = $(this);
                var restaurantId = $heartIcon.data('restaurant_id');
                console.log(restaurantId);

                $.ajax({
                    type: 'POST',
                    url: 'add_to_favourite.php',
                    data: {
                        restaurant_id: restaurantId
                    },
                    success: function(response) {
                        if (response.success) {
                            $heartIcon.addClass('text-danger');
                        }
                    },
                });
                alert('Restaurant added to favourites!');
            });
        });

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

    <script>
        $(document).ready(function() {
            if (sessionStorage.getItem('orderSuccess') === 'true') {
                $('#thankModal').modal('show');
                sessionStorage.removeItem('orderSuccess');

                $('#processingMessage').removeClass('d-none');
                $('#thankYouMessage').addClass('d-none');

                setTimeout(function() {
                    $('#processingMessage').addClass('d-none')
                    $('#thankYouMessage').removeClass('d-none')
                    $('.btnModal').removeClass('d-none')
                }, 3000);
            }

        });
        $(document).ready(function() {
            if (sessionStorage.getItem('deliveryAccepted') === 'true') {
                $('#enjoyFoodModal').modal('show');

                sessionStorage.removeItem('deliveryAccepted');
                console.log("enjoy food")
            }
        });
    </script>

</body>

</html>
<?php
include_once __DIR__ . "/layout/footer.php";
?>