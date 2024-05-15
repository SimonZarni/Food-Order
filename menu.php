<?php

include_once __DIR__ . '/layout/sidebar.php';
include_once __DIR__ . '/controller/MenuController.php';
include_once __DIR__ . '/controller/RestaurantController.php';

$menu_controller = new MenuController();
$menus = $menu_controller->getMenus();

$restaurant_controller = new RestaurantController();
$restaurants = $restaurant_controller->getRestaurants();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="subnav d-flex justify-content-around">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Delivery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pick Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Shop</a>
                    </li>
                </ul>
                <ul class="nav mt-2 cartbtn">
                    <li>
                        <!-- Filter Button -->
                        <button type="button" class="btn btn-link text-dark fs-4" data-toggle="modal" data-target="#filterModal" data-backdrop="false">
                            <i class="bi bi-funnel"></i>
                        </button>
                    </li>
                    <li class="mx-3 mt-2">
                        <a class="text-decoration-none" href="favourite.php?user_id=<?php if (isset($_SESSION['id'])) echo $_SESSION['id']; ?>"><i class="bi bi-heart"></i></a>
                    </li>
                    <li class="mx-3 mt-2">
                    <a class="text-decoration-none" href="cart.php">
                            <i class="bi bi-cart4"></i>
                            <?php
                            if(isset($_SESSION['id'])){
                            ?>
                            <span id="cart-count" class="badge badge-pill badge-danger">0</span>
                            <?php
                            } else {
                            ?>
                            <span id="" class="badge badge-pill badge-danger"></span>
                            <?php
                            }
                            ?>
                        </a>
                    </li>
                    <li class="mx-3 mt-2">
                        <a class="text-decoration-none" href="orders.php?id=<?php if (isset($_SESSION['id'])) echo $_SESSION['id']; ?>"><i class="bi bi-phone"></i></a>
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
                                            <!-- Add more cuisine options -->
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
                                    <!-- Add more filter options -->
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
            <div class="promo-item">
                <img src="images/promo1.png" class="img-fluid" alt="">
                <h5>Get Up To 25% Off</h5>
            </div>
            <div class="promo-item">
                <img src="images/promo2.jpg" class="img-fluid" alt="">
                <h5>Get Up To 30% Off</h5>
            </div>
            <div class="promo-item">
                <img src="images/promo2.png" class="img-fluid" alt="">
                <h5>Get Up To 25% Off</h5>
            </div>
            <div class="promo-item">
                <img src="images/promo3.jpg" class="img-fluid" alt="">
                <h5>Get Up To 15% Off</h5>
            </div>
            <div class="promo-item">
                <img src="images/promo3.jpg" class="img-fluid" alt="">
                <h5>Get Up To 35% Off</h5>
            </div>
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
                        <a href="restaurants.php?menu_id=<?php echo $menu['id']; ?>"><img src="admin/uploads/<?php echo $menu['image']; ?>" class="img-fluid" alt=""></a>
                        <button class="next-button">❯</button> <!-- Next button -->
                        <p><?php echo $menu['name']; ?></p>
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
                if ($restaurant['status'] == null) {
            ?>
                    <div class="col">
                        <div class="card restaurant-display">
                            <i class="bi bi-heart-fill heart-icon" data-liked="false" data-restaurant_id="<?php echo $restaurant['id']; ?>"></i>
                            <a href="item.php?restaurant_id=<?php echo $restaurant['id']; ?>">
                                <img src="admin/uploads/<?php echo $restaurant['profile_img']; ?>" class="img-fluid" style="height:180px" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $restaurant['name']; ?></h5>
                                    <p class="card-text"><?php echo $restaurant['open_time']; ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
            <?php }
            } ?>
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
                        } else {
                            alert('Failed to add restaurant to favorites.');
                        }
                    },

                });
                alert('Restaurant added to favourites!');
            });
        });
    </script>

    <script>
        jQuery(document).ready(function($) {
            $(document).on('click', '.heart-icon', function() {
                var restaurantId = $(this).data('restaurant_id');
                var heartIcon = $(this);

                $.ajax({
                    type: 'POST',
                    url: 'check_favourite.php',
                    data: {
                        restaurant_id: restaurantId
                    },
                    success: function(response) {
                        if (response.isFavourite) {
                            heartIcon.addClass('text-danger');
                        }
                    },
                    error: function() {
                        alert('Error occurred while processing request.');
                    }
                });
            });
        });
    </script>

</body>

</html>
<?php
include_once __DIR__ . "/layout/footer.php";
?>