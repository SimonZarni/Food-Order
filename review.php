<?php
include_once __DIR__ . '/layout/sidebar.php';
include_once __DIR__ . '/controller/ReviewController.php';
include_once __DIR__ . '/controller/ItemController.php';
include_once __DIR__ . '/controller/RestaurantController.php';

if (isset($_GET['restaurant_id']))
    $restaurant_id = $_GET['restaurant_id'];

if (isset($_SESSION['id']))
    $user_id = $_SESSION['id'];

$review_controller = new ReviewController();
$reviews = $review_controller->fetchReviewsByRestaurant($restaurant_id);
$summary = $review_controller->calculateRating($reviews);

$item_controller = new ItemController();
$items = $item_controller->getMenusAndItemsByRestaurant($restaurant_id);

$restaurant_controller = new RestaurantController();
$restaurants = $restaurant_controller->getRestaurant($restaurant_id);

usort($reviews, function ($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .scroll-container {
        display: flex;
        overflow-x: hidden;
        padding-bottom: 10px;
        gap: 10px;
        position: relative;
    }

    .scroll-container::before {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        pointer-events: none;
    }

    .scroll-container>* {
        position: relative;
    }
</style>

<body>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-md-10">
                <div>
                    <div class="d-flex justify-content-between" style="margin-top:6rem">
                        <div>
                            <h3>Reviews</h3>
                            <span style="font-size:1.2rem;"><?php if (isset($restaurants[0]['name'])) echo $restaurants[0]['name']; ?></span>
                        </div>
                        <div>
                            <button class="btn btn-outline-success" data-toggle="modal" data-target="#reviewModal" data-backdrop="false">Write Review</button>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-body">
                            <!-- Average Rating and Total Buying Instances -->
                            <div class="rating-summary mb-3 d-flex">
                                <div class="average-rating">
                                    <h3><?php echo $summary['average']; ?></h3>
                                </div>
                                <div class="mx-3 mt-2">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <?php if ($i <= floor($summary['average'])) : ?>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        <?php elseif ($i - $summary['average'] < 1) : ?>
                                            <i class="bi bi-star-half text-warning"></i>
                                        <?php else : ?>
                                            <i class="bi bi-star text-warning"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <div class="total-buying mt-2">
                                    <?php echo $summary['count']; ?>+
                                </div>
                            </div>

                            <!-- Ratings with Progress -->
                            <div class="ratings">
                                <h6>Ratings</h6>
                                <?php
                                foreach ([5, 4, 3, 2, 1] as $rating) :
                                    $percentage = $summary['count'] ? ($summary['distribution'][$rating] / $summary['count']) * 100 : 0;
                                ?>
                                    <div class="rating-bar card-item d-flex align-items-center mb-2">
                                        <span><?php echo $rating; ?> <i class="bi bi-star-fill text-warning"></i></span>
                                        <div class="progress flex-grow-1 mx-2">
                                            <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%; background-color:rgba(250,250,0,0.5)" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="rating-percentage"><?php echo round($percentage); ?>%</span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h5>User Comments</h5>
                    <?php
                    foreach ($reviews as $review) : ?>
                        <div class="comment card-item mb-3 p-3 border rounded">
                            <div class="user-profile d-flex align-items-center mb-2">
                                <span class="me-3"><strong><?php echo htmlspecialchars($review['user_name']); ?></strong></span>
                                <span class="text-muted">- <?php echo htmlspecialchars(date('Y-m-d', strtotime($review['date']))); ?></span>
                            </div>
                            <div class="rating mb-2">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <?php if ($i <= $review['rating']) : ?>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    <?php else : ?>
                                        <i class="bi bi-star text-warning"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                            <p><?php echo htmlspecialchars($review['review']); ?></p>
                            <div class="col-md-5 d-flex food-item border rounded item-display my-2 p-3">
                                <div class="col-md-6">
                                    <h5><?php echo $review['item_name']; ?></h5>
                                    <p class="mt-3"><?php echo $review['item_price']; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <img src="admin/uploads/<?php echo $review['item_image']; ?>" style="width: 160px;height:130px" alt="">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Review Form Modal -->
            <div class="modal" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form action="review.php" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reviewModalLabel">Write a Review</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="rating" class="form-label">Rating</label><br>
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <i class="bi bi-star-fill text-secondary rating-star fs-5 mx-2" data-value="<?php echo $i; ?>"></i>
                                    <?php endfor; ?>
                                    <input type="hidden" name="rating" id="rating" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="review" class="form-label">Review</label>
                                    <textarea class="form-control" id="review" name="review" rows="5" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Select the items that you bought</label>
                                    <div class="scroll-container">
                                        <?php foreach ($items as $item) : ?>
                                            <div class="col-md-3 d-flex food-item rounded my-2 p-3">
                                                <input type="radio" name="selected_item" id="review_<?php echo $item['item_id']; ?>" value="<?php echo $item['item_id']; ?>" class="d-none">
                                                <label for="review_<?php echo $item['item_id']; ?>" class="w-100 card-label">
                                                    <div class="row label_div">
                                                        <div class="col-md-7">
                                                            <h5><?php echo $item['item_name']; ?></h5>
                                                            <p class="mt-3"><?php echo $item['price']; ?></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <img src="admin/uploads/<?php echo $item['image']; ?>" class="img-fluid" alt="">
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="submit">Submit Review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

</body>

</html>

<?php
include_once __DIR__ . "/layout/footer.php";
?>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stars = document.querySelectorAll(".rating-star");

        stars.forEach(function(star) {
            // Click event
            star.addEventListener("click", function() {
                const value = parseInt(star.getAttribute("data-value"));
                document.getElementById("rating").value = value;
                updateStars(value);
                console.log(value)
            });

            // Mouseenter event
            star.addEventListener("mouseenter", function() {
                const value = parseInt(star.getAttribute("data-value"));
                updateStars(value);
            });

            // Mouseover event
            star.addEventListener("mouseover", function() {
                const value = parseInt(star.getAttribute("data-value"));
                highlightStars(value);
            });

            // Mouseout event
            star.addEventListener("mouseout", function() {
                const rating = document.getElementById("rating").value;
                highlightStars(rating);
            });
        });

        function updateStars(value) {
            stars.forEach(function(s) {
                s.classList.remove("text-warning");
                s.classList.add("text-secondary");
            });
            for (let i = 0; i < value; i++) {
                stars[i].classList.remove("text-secondary");
                stars[i].classList.add("text-warning");
            }
        }

        function highlightStars(value) {
            stars.forEach(function(s, index) {
                if (index < value) {
                    s.classList.remove("text-secondary");
                    s.classList.add("text-warning");
                } else {
                    s.classList.remove("text-warning");
                    s.classList.add("text-secondary");
                }
            });
        }
    });

    $(document).ready(function() {
        $('label.card-label').on('click', function() {
            const input = $('#' + $(this).attr('for'));
            const itemDiv = $(this).closest('.food-item');

            $('.food-item').removeClass('border border-5 border-warning');

            input.prop('checked', true);
            itemDiv.addClass('border border-5 border-warning');
        });

        $('label.card-label').on('mouseenter', function() {
            const itemDiv = $(this).closest('.food-item');
            if (!$(itemDiv).find('input').prop('checked')) {
                $(itemDiv).addClass('border border-5 border-warning');
            }
        });

        $('label.card-label').on('mouseleave', function() {
            const itemDiv = $(this).closest('.food-item');
            if (!$(itemDiv).find('input').prop('checked')) {
                $(itemDiv).removeClass('border border-5 border-warning');
            }
        });



        $('.scroll-container').on('wheel', function(e) {
            e.preventDefault();
            if (e.originalEvent.deltaX) {
                if (e.originalEvent.deltaX < 0) {
                    this.scrollLeft -= 50;
                } else {
                    this.scrollLeft += 50;
                }
            }
        });



        $('#submit').on('click', function(event) {
            event.preventDefault();

            var restaurant_id = '<?php echo $restaurant_id ?>';
            var rating = $('#rating').val();
            var review = $('#review').val();

            // Get the selected item ID
            var selectedItemID = $('input[name="selected_item"]:checked').val();

            if (!selectedItemID) {
                alert('Please select an item before submitting.');
                return;
            }

            $.ajax({
                url: 'add_review.php',
                type: 'POST',
                data: {
                    restaurant_id: restaurant_id,
                    rating: rating,
                    review: review,
                    item_id: selectedItemID
                },
                success: function(response) {
                    console.log(response);
                    alert('Review submitted successfully.');
                    location.reload()
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error occurred');
                }
            });
        });

    });
</script>