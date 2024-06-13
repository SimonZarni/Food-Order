<?php
include_once __DIR__ . '/layout/sidebar.php';
include_once __DIR__ . '/controller/ItemController.php';
include_once __DIR__ . '/controller/CartController.php';
include_once __DIR__ . '/controller/PromotionController.php';

$restaurant_id = $_GET['restaurant_id'];
$discount = $_GET['discount'];
$user_id = $_SESSION['id'];

$cart_controller = new CartController();
$carts = $cart_controller->getCartDetails($user_id, $restaurant_id);

$promotion_controller = new PromotionController();
$results = $promotion_controller->getMenusAndItemsByRestaurantAndDiscount($restaurant_id, $discount);
var_dump($results);

$group_promotion = [];
foreach ($results as $promotion) {
    $menu_name = $promotion['menu_name'];
    if (!isset($group_promotion[$menu_name])) {
        $group_promotion[$menu_name] = [];
    }
    $group_promotion[$menu_name][] = $promotion;
}

?>

<style>
.original-price {
    text-decoration: line-through; 
    color: #999; 
}
</style>

<div class="container-fluid breadcrumb-menu">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="menu.php">Menu</a></li>
                <li class="breadcrumb-item active" aria-current="page">Restaurant</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-fluid">
    <div class="restaurant-bg">
        <img src="admin/uploads/<?php echo $results[0]["bg_img"]; ?>" class="img-fluid rounded" style="height: 200px;width:100%;object-fit:cover;" alt="">
    </div>
    <div class="restaurant-logo">
        <img src="admin/uploads/<?php echo $results[0]["profile_img"]; ?>" class="rounded-circle img-fluid" style="height: 80px;width:80px" alt="">
    </div>
    <div class="" style="margin-left:7rem;">
        <ol class="breadcrumb custom-breadcrumb">
            <?php
            $previousMenuName = null;
            foreach ($results as $result) {
                $menuName = $result['menu_name'];
                if ($menuName !== $previousMenuName) {
            ?>
                    <li class="breadcrumb-item"><?php echo $menuName; ?></li>
            <?php
                    $previousMenuName = $menuName;
                }
            }
            ?>
        </ol>
    </div>
    <div class="mx-3">
        <h4 class=""><?php if (isset($results['restaurant_name'])) echo $results[0]['restaurant_name']; ?></h4>
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <div class="restaurant-status">
                    <span class="btn btn-outline-success">Open</span>
                </div>
                <div class="delivery-status mx-2 mt-2">
                    <p>Delivery Available |</p>
                </div>
                <div class="rating-star mt-2">
                    <p><i class="bi bi-star-fill"></i> 4.1 <span>(+3000)</span></p>
                </div>
                <div>
                    <button class="btn btn-link text-dark" data-toggle="modal" data-target="#reviewModal" data-backdrop="false">
                        See Review |
                    </button>
                </div>
                <div>
                    <button class="btn btn-link text-dark" data-toggle="modal" data-target="#infoModal" data-backdrop="false">
                        Restaurant Info
                    </button>
                </div>
            </div>
            <div>
                <button class="btn btn-outline-danger">Add To Favourite</button>
            </div>
        </div>
    </div>

    <!-- Scrollable modal -->

    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Reviews</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Rating Card -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <!-- Average Rating and Total Buying Instances -->
                            <div class="rating-summary mb-3 d-flex">
                                <div class="average-rating">
                                    <h3>4.1</h3>
                                </div>
                                <div class="mx-3 mt-2">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-half text-warning"></i>
                                </div>
                                <div class="total-buying mt-2">
                                    3000+
                                </div>
                            </div>

                            <!-- Ratings with Progress -->
                            <div class="ratings">
                                <h6>Ratings</h6>
                                <!-- Each rating bar can be treated as a separate card item -->
                                <div class="rating-bar card-item d-flex align-items-center mb-2">
                                    <span>5 Stars</span>
                                    <div class="progress flex-grow-1 mx-2">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="rating-percentage">60%</span>
                                </div>
                                <div class="rating-bar card-item d-flex align-items-center mb-2">
                                    <span>4 Stars</span>
                                    <div class="progress flex-grow-1 mx-2">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="rating-percentage">20%</span>
                                </div>
                                <div class="rating-bar card-item d-flex align-items-center mb-2">
                                    <span>3 Stars</span>
                                    <div class="progress flex-grow-1 mx-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="rating-percentage">10%</span>
                                </div>
                                <div class="rating-bar card-item d-flex align-items-center mb-2">
                                    <span>2 Stars</span>
                                    <div class="progress flex-grow-1 mx-2">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 5%;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="rating-percentage">5%</span>
                                </div>
                                <div class="rating-bar card-item d-flex align-items-center mb-2">
                                    <span>1 Star</span>
                                    <div class="progress flex-grow-1 mx-2">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 5%;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="rating-percentage">5%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comment Cards -->
                    <div class="card">
                        <div class="card-body">
                            <h6>User Comments</h6>
                            <!-- Comment 1 -->
                            <div class="comment card-item mb-3">
                                <div class="user-profile d-flex align-items-center mb-2">
                                    <img src="images/food1.png" alt="User profile picture" class="rounded-circle" style="width: 40px; height: 40px;">
                                    <span><strong>John Doe</strong></span>
                                    <span class="text-muted">- 2 days ago</span>
                                </div>
                                <p>The chicken was juicy and flavorful! I ordered a 10-piece bucket and was not disappointed.</p>
                            </div>
                            <!-- Comment 2 -->
                            <div class="comment card-item mb-3">
                                <div class="user-profile d-flex align-items-center mb-2">
                                    <img src="images/food2.png" alt="User profile picture" class="rounded-circle" style="width: 40px; height: 40px;">
                                    <span><strong>Jane Smith</strong></span>
                                    <span class="text-muted">- 3 days ago</span>
                                </div>
                                <p>Great burgers and fast service. Highly recommend! I bought a meal for my family and everyone loved it!</p>
                            </div>
                            <!-- Comment 3 -->
                            <div class="comment card-item mb-3">
                                <div class="user-profile d-flex align-items-center mb-2">
                                    <img src="images/food3.jpg" alt="User profile picture" class="rounded-circle" style="width: 40px; height: 40px;">
                                    <span><strong>Mike Johnson</strong></span>
                                    <span class="text-muted">- 5 days ago</span>
                                </div>
                                <p>Not a fan of the fries, but the chicken was amazing. I bought the 12-piece bucket and it was enough for a party!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Apply Filters</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Restaurant-info -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Restaurant Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3700.8220401291637!2d96.09048487374693!3d21.941391855811773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30cb6d66ca891955%3A0xadc9227066fe2903!2sKFC%20The%20Move%2C%20Mingalar%20Mandalay!5e0!3m2!1sen!2smm!4v1713443954726!5m2!1sen!2smm" width="400" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <h5><?php echo $results[0]['restaurant_name']; ?></h5>
                    <div>
                        <div>
                            <p id="restaurant-address">
                                <i class="bi bi-geo-alt fs-3 mx-2"></i>
                                <?php echo $results[0]['address']; ?>
                                <i id="copy-icon" class="bi bi-copy fs-5 mx-3" style="cursor: pointer;"></i>
                            </p>
                        </div>
                        <div>
                            <p>
                                <i class="bi bi-clock mx-3 fs-4"></i> Now open until 20:00
                                <!-- Add a button to toggle the full schedule -->
                                <span id="toggle-schedule" style="color: blue; cursor: pointer;">Show more</span>
                            </p>
                            <!-- Full schedule initially hidden -->
                            <div id="full-schedule" style="display: none;margin-left:3.5rem;">
                                Monday - Sunday: 08:30 - 20:00
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>

<nav id="navbar-example2" class="food-category bg-body-tertiary px-3 mb-3 shadow-sm">
    <div class="d-flex justify-content-between">
        <div class="">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        </div>
        <ul class="nav">
            <?php
            $previousMenuName = null;
            foreach ($results as $result) {
                $menuName = $result['menu_name'];
                if ($menuName !== $previousMenuName) {
            ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#<?php echo $menuName; ?>"><?php echo $menuName; ?></a>
                    </li>
            <?php
                    $previousMenuName = $menuName;
                }
            }
            ?>
        </ul>
        <div class=" cart-noti px-2">
            <button id="loadModelButton" class="fs-3 navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" data-user-id="<?php echo $user_id; ?>" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <i id="cart-icon" class="bi bi-cart4 text-dark"></i>
                <span id="cart-count" class="badge badge-pill badge-danger">0</span>
            </button>
        </div>
    </div>
</nav>

<div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="food-item-list scrollspy-example p-3 rounded-2" tabindex="0">
    <div class="gap-3">
        <?php foreach ($group_promotion as $menu_name => $items) : ?>
            <div class="row justify-content-center align-items-center mt-3">
                <h4 id="<?php echo $menu_name; ?>"><?php echo $menu_name; ?></h4>
                <div class="col d-flex gap-2">
                    <?php foreach ($items as $item) : ?>
                        <div class="col-md-4 d-flex food-item border rounded p-3 gap-2 item-display">
                            <div class="col-md-6">
                                <?php $promoted_price = $item['price'] - ($item['price'] * $discount / 100); ?>
                                <h6><?php echo $item['item_name']; ?></h6>
                                <p><?php echo $item['description']; ?></p>
                                <p class="original-price"><?php echo $item['price']; ?></p>
                                <p><?php echo $promoted_price; ?></p>
                            </div>
                            <div class="col-md-6">
                                <img src="admin/uploads/<?php echo $item['image']; ?>" style="width: 160px;height:130px" alt="">
                            </div>
                            <button class="item-add btn" data-toggle="modal" data-target="#itemDetailModal_<?php echo $item['item_id']; ?>"><i class="bi bi-plus-lg"></i></button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="itemDetailModal_<?php echo $item['item_id']; ?>" tabindex="-1" aria-labelledby="itemDetailModalLabel" aria-hidden="true" data-backdrop="false">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="itemDetailModalLabel">Item Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex align-items-center">
                                            <div class="col-md-6">
                                                <img src="admin/uploads/<?php echo $item['image']; ?>" class="img-fluid" alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <h4><?php echo $item['item_name']; ?></h4>
                                                <p class="original-price"><?php echo $item['price']; ?></p>
                                                <p><?php echo $promoted_price; ?></p>
                                                <p><?php echo $item['description']; ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer d-flex justify-content-between">
                                        <div class="mb-3 col-md-5 quantityBtn d-flex">
                                            <button class="btn mx-2 decrease-quantity" type="button"><i class="bi bi-dash-lg"></i></button>
                                            <input type="number mx-2" class="form-control quantity" readonly value="1">
                                            <button class="btn mx-2 increase-quantity" type="button"><i class="bi bi-plus-lg"></i></button>
                                        </div>
                                        <div class="col-md-5">
                                            <button class="btn btn-outline-dark add-to-cart" type="button" data-item-id="<?php echo $item['item_id']; ?>">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Cart items</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body position-relative">
        <div class="cart-container">
            <?php if (isset($carts)) foreach ($carts as $cart) : ?>
                <?php
                $totalPrice = $cart['price'] * $cart['quantity'];
                ?>
                <div class="d-flex mb-2 related-content" data-cart-id="<?php echo $cart['item_id']; ?>">
                    <div class="col-md-6">
                        <img src="admin/uploads/<?php echo $cart['image']; ?>" style="width: 100px;height:80px;border-radius:20px;" alt="">
                    </div>
                    <div class="col-md-6">
                        <h6><?php echo $cart['name']; ?></h6>
                        <p><?php echo $cart['price'] ?></p>
                        <p><?php echo $cart['description'] ?></p>
                    </div>
                </div>
                <div class="d-flex mb-5 ">
                    <div class="col-md-4 mt-3" id="totalPrice">
                        <?php echo number_format($totalPrice, 2); ?>
                    </div>
                    <div class="col-md-2">
                        <button class="remove-item btn btn-link mt-2" type="button" data-item-id="<?php echo $cart['item_id']; ?>"><i class="bi bi-trash text-danger fs-5"></i></button>
                    </div>
                    <div class="col-md-6 mt-2 d-flex justify-content-end buttonClass" data-cart-id="<?php echo $cart['cart_id']; ?>">
                        <button class="decrease-quantity1 btn btn-link text-warning" type="button" data-price="<?php echo $cart['price']; ?>"><i class="bi bi-dash-lg"></i></button>
                        <input type="number" value="<?php echo $cart['quantity']; ?>" class="quantity1 text-center form-control" data-price="<?php echo $cart['price']; ?>" data-cart-id="<?php echo $cart['id']; ?>" readonly>
                        <button class="increase-quantity1 btn btn-link text-warning" type="button" data-price="<?php echo $cart['price']; ?>"><i class="bi bi-plus-lg"></i></button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="position-absolute bottom-0 start-50 translate-middle">
            <button class="btn login px-5" id="checkoutBtn">Review Order</button>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . "/layout/footer.php";
?>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                const offcanvas = document.querySelector('.offcanvas-body')
                const itemId = this.dataset.itemId;
                const userId = <?php echo json_encode($_SESSION['id']); ?>;
                const btnLogin = document.querySelector('.login')

                fetch('remove_item.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            user_id: userId,
                            item_id: itemId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const cartItem = document.querySelector(`[data-cart-id="${itemId}"]`);
                        if (data.success) {
                            cartItem.nextElementSibling.remove();
                            cartItem.remove();
                            const remainingItems = document.querySelectorAll('[data-cart-id]');
                            if (remainingItems.length === 0) {
                                btnLogin.classList.remove('login');
                                btnLogin.classList.add('bg-secondary')
                                btnLogin.classList.add('disabled')
                                offcanvas.innerHTML += `
                                <div class="text-center">
                                <img src="images/cart-empty.png">
                                <h4 class="text-danger">Oops!Your cart is empty</h4>
                                </div>`
                            }
                        } else {
                            alert('Failed to remove item from cart.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    });
            });
        });
    });
</script>

<script>
    var restaurantId = <?php echo json_encode($restaurant_id); ?>;

    $(document).ready(function() {
        function updateCartCount() {
            $.ajax({
                type: 'GET',
                url: 'cart_count.php',
                data: {
                    restaurant_id: restaurantId
                },
                success: function(response) {
                    $('#cart-count').text(response);
                },
                error: function() {
                    console.error('Error fetching cart count.');
                }
            });
        }
        updateCartCount()

        var item_id = <?php echo $item['item_id']; ?>;
        var itemAdded = localStorage.getItem('itemAdded' + item_id);

        function checkItemInCart() {
            $.ajax({
                type: 'POST',
                url: 'check_item_in_cart.php',
                data: {
                    item_id: item_id
                },
                success: function(response) {
                    if (response.includes("Item is already in the cart")) {} else {
                        $('.add-to-cart').text('Add to Cart').prop('disabled', false).addClass('btn-outline-dark').removeClass('btn-outline-success');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", xhr.responseText);
                }
            });
        }

        checkItemInCart();

        $('.increase-quantity, .decrease-quantity').on('click', function() {
            let input = $(this).siblings('.quantity');
            let value = parseInt(input.val());

            if ($(this).hasClass('increase-quantity')) {
                value++;
            } else {
                value = value > 1 ? value - 1 : 1;
            }

            input.val(value);
            updateTotalPrice();
        });

        $('.quantity').on('input', function() {
            updateTotalPrice();
        });

        $('.increase-quantity1, .decrease-quantity1').on('click', function() {
            var input = $(this).siblings('.quantity1');
            var value = parseInt(input.val());

            if ($(this).hasClass('increase-quantity1')) {
                value++;
            } else {
                value = value > 1 ? value - 1 : 1;
            }
            input.val(value);

            var buttonClass = $(this).closest('.buttonClass');
            var cart_id = buttonClass.data('cartId');
            var quantity = parseInt(buttonClass.find('.quantity1').val());
            var price = input.data('price')

            var totalPriceElement = $(this).closest('.related-content').find('#totalPrice');
            totalPriceElement.text((quantity * price).toFixed(2))

            $.ajax({
                url: 'update_cart.php',
                method: 'POST',
                data: {
                    cart_id: cart_id,
                    quantity: quantity
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('#checkoutBtn').on('click', function() {
            window.location.href = 'cart.php?restaurant_id=<?php echo $restaurant_id ?>';
        });


        $('.add-to-cart').on('click', function() {
            var user_id = <?php echo isset($_SESSION['id']) ? $_SESSION['id'] : 'null'; ?>;
            if (!user_id) {
                alert('Please log in to add items to the cart.');
                return;
            }

            var modal = $(this).closest('.modal-content');
            var quantity = parseInt(modal.find('.quantity').val());
            var item_id = modal.find('.add-to-cart').data('item-id');
            var totalPrice = parseFloat(sessionStorage.getItem('total_price'));

            $.ajax({
                type: 'POST',
                url: 'add_to_cart.php',
                data: {
                    quantity: quantity,
                    item_id: item_id,
                    total_price: totalPrice
                },
                success: function(response) {
                    alert("Item added to cart successfully.");
                    if (!localStorage.getItem('itemAdded' + item_id)) {
                        $(this).text('Add to Cart').prop('disabled', false).addClass('btn-outline-dark').removeClass('btn-outline-success');
                        localStorage.setItem('itemAdded' + item_id, 'true');
                    } else {
                        $(this).text('Added to Cart').prop('disabled', false).addClass('btn-outline-success').removeClass('btn-outline-dark');
                        localStorage.setItem('itemAdded' + item_id, 'true');
                    }
                    updateCartCount()
                    location.reload();
                }.bind(this),
                error: function(xhr, status, error) {
                    console.error("Error:", xhr.responseText);
                    alert("Failed to add item to cart. Please try again later.");
                }
            });
        });
    });
</script>