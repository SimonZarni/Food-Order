<?php
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/ItemController.php';

$id = $_GET['id'];
$item_controller = new ItemController();
$item = $item_controller->getItem($id);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="card bg-body-tertiary shadow rounded" style="width: 400px;">
                        <img src="<?php echo '../../uploads/' . $item['image']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">ID: <?php echo $item['id']; ?></p>
                            <p class="card-text">Item Name: <?php  echo $item['name']; ?></p>
                            <p class="card-text">Price: <?php  echo $item['price']; ?></p>
                            <p class="card-text">Description: <?php  echo $item['description']; ?></p>
                            <a href="item_list.php" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . '/../../layouts/footer.php';
?>