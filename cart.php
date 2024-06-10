<?php
session_name('user');
session_start();
include_once __DIR__ . '/controller/CartController.php';
include_once __DIR__ . '/controller/PaymentController.php';
include_once __DIR__ . '/controller/TownshipController.php';
include_once __DIR__ . '/controller/PromotionController.php';

$user_id = $_SESSION['id'];
$restaurant_id = $_GET['restaurant_id'];

$cart_controller = new CartController();
$carts = $cart_controller->getCartDetails($user_id, $restaurant_id);

$payment_controller = new PaymentController();
$payments = $payment_controller->getPayments();

$township_controller = new TownshipController();
$townships = $township_controller->getTownships();

$promotion_controller = new PromotionController();
$promotions = $promotion_controller->getPromotionByRestaurant($restaurant_id);

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
    <style>
        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .cart-item {
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .cart-item:hover {
            transform: translateY(-5px);
        }

        .item-image {
            flex-shrink: 0;
            margin-right: 20px;
        }

        .item-image img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 5px;
            object-fit: cover;
        }

        .item-details {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            gap: 10px;
        }

        .item-name {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }

        .item-price,
        .item-quantity,
        .item-subtotal {
            font-size: 1em;
            color: #555;
        }

        .item-quantity input {
            width: 60px;
            margin-left: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        .total-price {
            font-weight: bold;
            color: #007bff;
        }

        .item-subtotal {
            margin-top: 10px;
            font-size: 1.1em;
        }

        @media (max-width: 768px) {
            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .item-quantity {
                margin-top: 10px;
            }
        }
    </style>
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
                <!-- <table class="table table-striped">
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
                                <td style="display: none;"><input type="checkbox" class="cart-item-checkbox" name="item_ids[]" value="<?php echo $cart['id']; ?>" checked></td>
                                <td></td>
                                <td><?php echo $cart['name']; ?></td>
                                <td><?php echo $cart['price']; ?></td>
                                <td class="d-flex">
                                    <input type="number" value="<?php echo $cart['quantity']; ?>" class="quantity form-control" data-price="<?php echo $cart['price']; ?>" disabled>
                                </td>
                                <td class="total-price" id="totalPrice"><?php echo number_format($totalPrice, 2); ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table> -->
                <div class="cart-container">
                    <?php
                    $subtotal = 0;
                    foreach ($carts as $cart) {
                        $totalPrice = $cart['price'] * $cart['quantity'];
                        $subtotal += $totalPrice;
                    ?>
                        <div class="cart-item" data-id="<?php echo $cart['id']; ?>">
                            <input type="checkbox" class="cart-item-checkbox" name="item_ids[]" value="<?php echo $cart['id']; ?>" style="display: none;" checked>
                            <div class="item-image">
                                <img src="admin/uploads/<?php echo $cart['image']; ?>" alt="<?php echo $cart['name']; ?>">
                            </div>
                            <div class="item-details">
                                <div class="item-name"><?php echo $cart['name']; ?></div>
                                <div class="item-price">Price: $<?php echo number_format($cart['price'], 2); ?></div>
                                <div class="item-quantity">
                                    Quantity: <input type="number" value="<?php echo $cart['quantity']; ?>" class="quantity" data-price="<?php echo $cart['price']; ?>" disabled>
                                </div>
                                <div class="item-subtotal">Subtotal: $<span class="total-price"><?php echo number_format($totalPrice, 2); ?></span></div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="cart-subtotal">
                        Subtotal of all items: $<span class="subtotal-price"><?php echo number_format($subtotal, 2); ?></span>
                    </div>
                </div>
                <div class="mx-3">
                    <a href="item.php?restaurant_id=<?php echo $restaurant_id ?>" class="btn btn-primary">Go Back</a>
                </div>
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
                <div class="mt-2">
                    <label for="" class="form-label">Phone</label>
                    <input type="number" name="phone" id="phone" class="form-control" placeholder="Please fill your phone number">
                </div>
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
                    <label for="" class="form-label">Voucher Code</label>
                    <input type="number" name="voucher" id="voucher" class="form-control" placeholder="Apply Voucher Code">
                    <button id="applyVoucher" class="btn btn-success mt-2" type="button" onclick="applyVoucher()">Apply</button>
                </div>
                <div class="mt-2">
                    Total Price: <span id="subtotal">0.00</span>
                </div>
                <button type="button" id="submitOrder" class="btn btn-primary mt-2">Submit Order</button>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script>
        // const promotions = <?php echo json_encode($promotions); ?>;
        // let currentVoucher = null;

        // function applyVoucher() {
        //     const voucherCode = $("#voucher").val();

        //     const matchingPromotion = promotions.find(p => p.voucher_code === voucherCode);

        //     if (matchingPromotion) {
        //         currentVoucher = matchingPromotion;
        //         alert("Voucher applied successfully!");
        //         updateSubtotal();
        //     } else {
        //         currentVoucher = null;
        //         alert("Invalid voucher code.");
        //     }
        // }


        // function updateTotalPrice(quantityInput) {
        //     const pricePerItem = $(quantityInput).data('price');
        //     const quantity = parseInt($(quantityInput).val());
        //     const totalPrice = pricePerItem * quantity;
        //     $(quantityInput).closest('.cart-item').find('.total-price').text(totalPrice.toFixed(2));
        //     return totalPrice;
        // }

        // function updateSubtotal() {
        //     let totalPriceWithoutFee = 0;
        //     $('.cart-item-checkbox:checked').each(function() {
        //         const quantityInput = $(this).closest('.cart-item').find('.quantity');
        //         totalPriceWithoutFee += updateTotalPrice(quantityInput);
        //     });
        //     const townshipFee = parseFloat($('#townshipSelect option:selected').data('fee'));
        //     let subtotal = totalPriceWithoutFee + townshipFee;

        //     if (currentVoucher) {
        //         const discountAmount = subtotal * (currentVoucher.discount / 100);
        //         subtotal -= discountAmount;
        //     }

        //     $('#subtotal').text(subtotal.toFixed(2));
        //     $('#subtotal').data('value', subtotal);
        // }

        // jQuery(document).ready(function($) {
        //     $('#townshipSelect').change(function() {
        //         const townshipFee = parseFloat($(this).find('option:selected').data('fee'));
        //         $('.township-fee').text(townshipFee.toFixed(2));
        //         updateSubtotal();
        //     });

        //     $('#voucher').on('input', function() {
        //         if (!$(this).val().trim()) {
        //             currentVoucher = null;
        //             updateSubtotal();
        //         }
        //     });

        //     $('#submitOrder').click(function() {
        //         var itemIds = $('input[name="item_ids[]"]:checked').map(function() {
        //             return $(this).val();
        //         }).get();
        //         var quantities = $('.quantity').map(function() {
        //             return $(this).val();
        //         }).get();
        //         var townshipId = $('#townshipSelect').val();
        //         var paymentId = $('#paymentSelect').val();

        //         if (itemIds.length === 0 || !townshipId || !paymentId) {
        //             alert('Please select at least one cart item and specify both township and payment method.');
        //             return;
        //         }

        //         var totalPrices = [];
        //         $('.total-price').each(function() {
        //             totalPrices.push(parseFloat($(this).text()));
        //         });

        //         var address = $('#address').val();
        //         var phone = $('#phone').val();

        //         var formData = {
        //             'item_ids': itemIds,
        //             'quantities': quantities,
        //             'total_prices': totalPrices,
        //             'township_id': townshipId,
        //             'phone': phone,
        //             'address': address,
        //             'payment_id': paymentId,
        //             'subtotal': $('#subtotal').text(),
        //         };

        //         $.ajax({
        //             type: 'POST',
        //             url: 'order.php',
        //             data: formData,
        //             success: function(response) {
        //                 alert('Order submitted successfully!');
        //                 $.each(itemIds, function(index, itemId) {
        //                     $('input[value="' + itemId + '"]').closest('.cart-item').remove();
        //                 });
        //                 updateSubtotal();
        //             },
        //             error: function() {
        //                 alert('Error submitting order.');
        //             }
        //         });
        //     });
        // });

        var promotions = <?php echo json_encode($promotions); ?>;

        function applyVoucher() {
            var voucherCode = $('#voucher').val();
            var foundPromotion = promotions.find(function(promotion) {
                return promotion.voucher_code === voucherCode;
            });

            if (foundPromotion) {
                var discount = foundPromotion.discount;
                var subtotal = parseFloat($('#subtotal').text());
                var discountedPrice = subtotal * (1 - discount / 100);
                $('#subtotal').text(discountedPrice.toFixed(2));
                alert('Voucher applied successfully!');
            } else {
                alert('Invalid voucher code. Please try again.');
            }
        }

        jQuery(document).ready(function($) {
            function updateTotalPrice(quantityInput) {
                var pricePerItem = $(quantityInput).data('price');
                var quantity = parseInt($(quantityInput).val());
                var totalPrice = pricePerItem * quantity;
                $(quantityInput).closest('.cart-item').find('.total-price').text(totalPrice.toFixed(2));
                return totalPrice;
            }

            function updateSubtotal() {
                var totalPriceWithoutFee = 0;

                $('.cart-item-checkbox:checked').each(function() {
                    var quantityInput = $(this).closest('.cart-item').find('.quantity');
                    totalPriceWithoutFee += updateTotalPrice(quantityInput);
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
                    'phone': phone,
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
                            $('input[value="' + itemId + '"]').closest('.cart-item').remove();
                        });
                        updateSubtotal();
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

<?php
include_once __DIR__ . "/layout/footer.php";
?>