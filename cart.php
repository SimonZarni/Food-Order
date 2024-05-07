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
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="csss/bootstrap-steps.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="stepper-wrapper">
        <div class="stepper-item completed">
            <div class="step-counter">1</div>
            <div class="step-name">Menu</div>
        </div>
        <div class="stepper-item completed">
            <div class="step-counter">2</div>
            <div class="step-name">Cart</div>
        </div>
        <div class="stepper-item active">
            <div class="step-counter">3</div>
            <div class="step-name">Checkout</div>
        </div>
    </div>
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
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($carts as $cart) {
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
                        foreach ($townships as $township) {
                            if ($township['status'] == null) {
                        ?>
                                <option value="<?php echo $township['id']; ?>" data-fee="<?php echo $township['fee']; ?>">
                                    <?php echo $township['name']; ?>
                                </option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mt-2">
                    Delivery Fee: <span class="township-fee"></span>
                </div>
                <!-- <div class="mt-2">
                    <label for="" class="form-label">Phone</label>
                    <input type="phone" name="phone" id="phone" class="form-control" placeholder="Please fill your phone number">
                </div> -->
                <div class="mt-2">
                    <label for="" class="form-label">Address</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Please fill in your address">
                </div>
                <div class="mt-2">
                    <label for="" class="form-label">Payment Method</label>
                    <select name="payment" id="paymentSelect" class="form-select">
                        <option value="" disabled selected>Select payment method</option>
                        <?php
                        foreach ($payments as $payment) {
                            if ($payment['status'] == null) {
                        ?>
                                <option value="<?php echo $payment['id']; ?>"><?php echo $payment['method']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mt-2">
                    Total Price: <span id="subtotal">0.00</span>
                </div>
                <button type="button" id="submitOrder" class="btn btn-primary mt-2">Submit Order</button>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        jQuery.noConflict();
        // $(document).ready(function() {
        jQuery(document).ready(function($) {
            function updateTotalPrice(quantityInput) {
                var pricePerItem = $(quantityInput).data('price');
                var quantity = parseInt($(quantityInput).val());
                var totalPrice = pricePerItem * quantity;
                $(quantityInput).closest('tr').find('.total-price').text(totalPrice.toFixed(2));
                return totalPrice;
            }

            function updateSubtotal() {
                var totalPriceWithoutFee = 0;

                $('.quantity').each(function() {
                    totalPriceWithoutFee += updateTotalPrice(this);
                });

                console.log('Total Price Without Fee:', totalPriceWithoutFee);

                var townshipFee = parseFloat($('#townshipSelect option:selected').data('fee'));
                console.log('Township Fee:', townshipFee);

                var subtotal = totalPriceWithoutFee + townshipFee;
                console.log('Subtotal:', subtotal);

                $('#subtotal').text(subtotal.toFixed(2));
            }

            $('#townshipSelect').change(function() {
                var townshipFee = parseFloat($(this).find('option:selected').data('fee'));
                $('.township-fee').text(townshipFee.toFixed(2));
                updateSubtotal();
            });

            $('.quantity').change(function() {
                updateSubtotal();
            });

            $('.increase-quantity').click(function() {
                var quantityInput = $(this).siblings('.quantity');
                var currentQuantity = parseInt(quantityInput.val());
                quantityInput.val(currentQuantity + 1);
                updateTotalPrice(quantityInput);
                updateSubtotal();
            });

            $('.decrease-quantity').click(function() {
                var quantityInput = $(this).siblings('.quantity');
                var currentQuantity = parseInt(quantityInput.val());
                if (currentQuantity > 1) {
                    quantityInput.val(currentQuantity - 1);
                    updateTotalPrice(quantityInput);
                    updateSubtotal();
                }
            });

            $('#submitOrder').click(function() {
                var itemIds = $('input[name="item_ids[]"]:checked').map(function() {
                    return $(this).val();
                }).get();
                var quantities = $('.quantity').map(function() {
                    return $(this).val();
                }).get();
                console.log(quantities);
                var townshipId = $('#townshipSelect').val();
                var paymentId = $('#paymentSelect').val();

                if (itemIds.length === 0 || !townshipId || !paymentId) {
                    alert('Please select at least one cart item and specify both township and payment method.');
                    return;
                }

                var totalPrices = [];
                $('.total-price').each(function() {
                    totalPrices.push(parseFloat($(this).text()));
                });

                var address = $('#address').val();
                var phone = $('#phone').val();

                var formData = {
                    'item_ids': itemIds,
                    'quantities': quantities,
                    'total_prices': totalPrices,
                    'township_id': townshipId,
                    // 'phone': phone,
                    'address': address,
                    'payment_id': paymentId,
                    'subtotal': $('#subtotal').text()
                };

                $.ajax({
                    type: 'POST',
                    url: 'order.php',
                    data: formData,
                    success: function(response) {
                        alert('Order submitted successfully!');
                        console.log(response);
                        $.each(itemIds, function(index, itemId) {
                            $('input[value="' + itemId + '"]').closest('tr').remove();
                        });
                    },
                    error: function() {
                        console.log(error);
                        alert('Error submitting order.');
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