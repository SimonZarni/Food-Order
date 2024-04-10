<?php
session_name('user');
session_start();
include_once __DIR__ . '/controller/CartController.php';
include_once __DIR__ . '/controller/PaymentController.php';
include_once __DIR__ . '/controller/TownshipController.php';

$user_id = $_SESSION['id'];

$cart_controller = new CartController();
$carts = $cart_controller->getCartDetails($user_id);

$payment_controller = new PaymentController();
$payments = $payment_controller->getPayments();

$township_controller = new TownshipController();
$townships = $township_controller->getTownships();

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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($carts as $cart){
                            $totalPrice = $cart['price'] * $cart['quantity']; 
                        ?>
                        <tr>
                            <td><input type="checkbox" class="cart-item-checkbox" name="item_ids[]" value="<?php echo $cart['id']; ?>"></td>
                            <td><?php echo $cart['name']; ?></td>
                            <td><?php echo $cart['price']; ?></td>
                            <td class="d-flex">
                                <button class="btn btn-success decrease-quantity" type="button" data-price="<?php echo $cart['price']; ?>">-</button>
                                <input type="number" value="<?php echo $cart['quantity']; ?>" class="quantity" data-price="<?php echo $cart['price']; ?>">
                                <button class="btn btn-success increase-quantity" type="button" data-price="<?php echo $cart['price']; ?>">+</button>
                            </td>
                            <td class="total-price" id="totalPrice"><?php echo number_format($totalPrice, 2); ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <div class="mt-2">
                    <label for="" class="form-label">Township</label>
                    <select name="township" id="townshipSelect" class="form-select">
                        <option value="" disabled selected>Select township</option>
                        <?php
                        foreach($townships as $township){
                            if($township['status'] == null){
                        ?>
                        <option value="<?php echo $township['id']; ?>"><?php echo $township['name']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mt-2">
                    <label for="" class="form-label">Payment Method</label>
                    <select name="payment" id="paymentSelect" class="form-select">
                        <option value="" disabled selected>Select payment method</option>
                        <?php
                        foreach($payments as $payment){
                            if($payment['status'] == null){
                        ?>
                        <option value="<?php echo $payment['id']; ?>"><?php echo $payment['method']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <button type="button" id="submitOrder" class="btn btn-primary mt-2">Submit Order</button>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script>
        $(document).ready(function() {
            function updateTotalPrice(quantityInput) {
                var pricePerItem = $(quantityInput).data('price'); 
                var quantity = parseInt($(quantityInput).val()); 
                var totalPrice = pricePerItem * quantity; 
                $(quantityInput).closest('tr').find('.total-price').text(totalPrice.toFixed(2)); 
            }

            $('.increase-quantity').click(function() {
                var quantityInput = $(this).siblings('.quantity'); 
                var currentQuantity = parseInt(quantityInput.val());
                quantityInput.val(currentQuantity + 1); 
                updateTotalPrice(quantityInput); 
            });

            $('.decrease-quantity').click(function() {
                var quantityInput = $(this).siblings('.quantity'); 
                var currentQuantity = parseInt(quantityInput.val());
                if (currentQuantity > 1) { 
                    quantityInput.val(currentQuantity - 1);
                    updateTotalPrice(quantityInput); 
                }
            });
            $('#submitOrder').click(function() {
                var itemIds = $('input[name="item_ids[]"]:checked').map(function() { return $(this).val(); }).get();
                var townshipId = $('#townshipSelect').val();
                var paymentId = $('#paymentSelect').val();
                var totalPrice = $('#totalPrice').text();

                if(itemIds.length === 0 || !townshipId || !paymentId) {
                    alert('Please select at least one cart item and specify both township and payment method.');
                    return;
                }

                var formData = {
                    'item_ids': itemIds,
                    'township_id': townshipId,
                    'payment_id': paymentId,
                    'total_price': totalPrice
                };
                console.log(formData)

                $.ajax({
    type: 'POST',
    url: 'order.php', 
    data: formData,
    success: function(response) {
        alert('Order submitted successfully!');
        console.log(response);
        // Remove rows corresponding to ordered items
        $.each(itemIds, function(index, itemId) {
            $('input[value="' + itemId + '"]').closest('tr').remove();
        });
    },
    error: function() {
        alert('Error submitting order.');
    }
});

            });
        });
    </script>
</body>
</html>