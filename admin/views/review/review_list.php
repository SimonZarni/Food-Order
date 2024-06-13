<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/ReviewController.php';

$review_controller = new ReviewController();
$reviews = $review_controller->getReviews();

?>

<div class="container-fluid">
    <?php
    if (isset($_GET['delete_status'])) {
        echo ' <div class="alert alert-success" role="alert">Review deleted successfully.</div>';
    } 
    ?>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-block align-items-center justify-content-between mb-9">
                    <table class="table table-striped text-center" id="reviewTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Restaurant</th>
                                <th>Item</th>
                                <th>Item Image</th>
                                <th>User</th>
                                <th>Review</th>
                                <th>Rating</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($reviews as $review) {
                            ?>
                                <tr>
                                    <td><?php echo $review['id']; ?></td>
                                    <td><?php echo $review['restaurant_name']; ?></td>
                                    <td><?php echo $review['item_name']; ?></td>
                                    <td><img src="../../uploads/<?php echo $review['item_image']; ?>" alt="" style="width: 200px;" class="rounded-3"></td>
                                    <td><?php echo $review['username']; ?></td>
                                    <td><?php echo $review['review']; ?></td>
                                    <td><?php echo $review['rating']; ?><i class="bi bi-star-fill text-warning"></i></td>
                                    <td><?php echo $review['date']; ?></td>
                                    <td>
                                        <a href="delete_review.php?id=<?php echo $review['id']; ?>" onclick="return confirm('Are you sure to delete this review?');" class="btn btn-danger mx-2"><i class="ti ti-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . '/../../layouts/footer.php';
?>