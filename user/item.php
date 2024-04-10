<?php
session_name('user');
session_start();
include_once __DIR__ . '/controller/ItemController.php';

$id = $_GET['id'];

$item_controller = new ItemController();
$item = $item_controller->getItem($id); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodwagon</title>
    <link rel="apple-touch-icon" sizes="180x180" href="public/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="public/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="public/assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="public/assets/img/favicons/favicon.ico">
    <link rel="manifest" href="public/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="public/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link href="public/assets/css/theme.css" rel="stylesheet" />
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="../admin/uploads/<?php echo $item['image']; ?>" alt="" class="img-fluid">
        </div>
        <div class="col-md-6">
            <p><?php echo $item['name']; ?></p>
            <p><?php echo $item['price']; ?></p>
            <div class="container">
                <button class="btn btn-success decrease-quantity" type="button">-</button>
                <input type="number" value="1" class="quantity">
                <button class="btn btn-success increase-quantity" type="button">+</button>
            </div>
            Total Price: <span class="total-price"><?php echo $_SESSION['total_price']; ?></span>
            <button class="btn btn-primary add-to-cart">Add to Cart</button>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    
    <script>
        $(document).ready(function() {
            updateTotalPrice();

            $('.increase-quantity, .decrease-quantity').on('click', function() {
                var input = $(this).siblings('.quantity');
                var value = parseInt(input.val());

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

            function updateTotalPrice() {
                var quantity = parseInt($('.quantity').val());
                var price = parseFloat('<?php echo $item['price']; ?>');
                var totalPrice = quantity * price;
                $('.total-price').text(totalPrice.toFixed(2));
                sessionStorage.setItem('total_price', totalPrice.toFixed(2));
            }

            $('.add-to-cart').on('click', function() {
                var quantity = parseInt($('.quantity').val());
                var item_id = <?php echo $item['id']; ?>;
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
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", xhr.responseText);
                        alert("Failed to add item to cart. Please try again later.");
                    }
                });
            });
        });
    </script>
</body>
</html>

