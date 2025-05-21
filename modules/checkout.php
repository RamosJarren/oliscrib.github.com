<?php
include 'dbconi.php';

$user_id = isset($_SESSION['userfullname']) ? $_SESSION['userfullname'] : 0;
$products = []; // Initialize products as an empty array

// Initialize variables
$subtotal = 0;
$discountAmount = 0;
$totalPrice = 0;

if ($user_id) {
    $sql = "SELECT items FROM users WHERE fullname = '$user_id'";
    $result = mysqli_query($dbc, $sql);
    $user = mysqli_fetch_assoc($result);
    if ($user && !empty($user['items'])) {
        $item_ids = explode(',', $user['items']);
        foreach ($item_ids as $item_id) {
            $item_id = intval($item_id);
            $product_sql = "SELECT * FROM bikes WHERE id = $item_id";
            $product_result = mysqli_query($dbc, $product_sql);
            if ($product_result) {
                while ($product = mysqli_fetch_assoc($product_result)) {
                    $products[] = $product; // Add product to the products array
                }
            }
        }
    }
}

// Calculate subtotal if products are available
if (!empty($products)) {
    $subtotal = array_sum(array_column($products, 'price'));
}

// Calculate total price on page load
$shipping = 300;
$totalPrice = $subtotal + $shipping - $discountAmount; // Calculate total price

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    $fullname = mysqli_real_escape_string($dbc, $user_id);
    $items = mysqli_real_escape_string($dbc, implode(',', array_column($products, 'id')));
    $discountCode = isset($_POST['discountCode']) ? $_POST['discountCode'] : '';
    $validDiscounts = [
        'BIKES10' => 0.10,
        'BIKES20' => 0.20
    ];
    if (array_key_exists($discountCode, $validDiscounts)) {
        $discountAmount = $subtotal * $validDiscounts[$discountCode];
    }
    $totalPrice = $subtotal + $shipping - $discountAmount; // Recalculate total price
    $currentTime = date('Y-m-d H:i:s');

    $insert_sql = "INSERT INTO payments (fullname, items, price, time, status) VALUES ('$fullname', '$items', $totalPrice, '$currentTime', 'pending')";
    if (mysqli_query($dbc, $insert_sql)) {
        // Get the last inserted payment ID
        $payment_id = mysqli_insert_id($dbc);
        // Redirect to the payment page with the payment ID
        echo "<script>window.location.href = '?page=checkout_payment&payment_id=$payment_id';</script>";
    } else {
        echo "<script>alert('Error processing payment: " . mysqli_error($dbc) . "');</script>";
    }
}
?>

<div class="py-3"></div>
<section class="shopping-cart dark">
    <div class="container">
        <div class="block-heading">
            <h2><?php echo htmlspecialchars($user_id); ?>'s Shopping Cart</h2>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="items">
                        <?php if (empty($products)): ?>
                            <p>No items in the cart.</p>
                        <?php else: ?>
                            <?php foreach ($products as $product): ?>
                                <div class="product">
                                    <a href="./?page=views&id=<?php echo htmlspecialchars($product['id']); ?>" style="text-decoration: none; color: inherit;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img class="img-fluid mx-auto d-block image" style="border-radius:10px;" src="images/bayk1.png" alt="<?php echo htmlspecialchars($product['model']); ?>">
                                            </div>
                                            <div class="col-md-7">
                                                <div class="info">
                                                    <div class="row">
                                                        <div class="col-md-6 product-name">
                                                            <div class="product-name">
                                                                <?php echo htmlspecialchars($product['model']); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="product-info">
                                                                <div>Brand: <span class="value"><?php echo htmlspecialchars($product['brand']); ?></span></div>
                                                                <div>Quantity: 1</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 price text-center">
                                                            <span>₱<?php echo number_format($product['price'], 2, '.', ','); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 remove-button-container">
                                                <button class="btn btn-sm mb-1" onclick="deleteItem(<?php echo htmlspecialchars($product['id']); ?>)">
                                                    <i class="fa fa-times" style="color: red;"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="summary">
                        <h3>Summary</h3>
                        <div class="summary-item"><span class="text">Subtotal</span><span class="price">₱<?php echo number_format($subtotal, 2, '.', ','); ?></span></div>
                        <div class="summary-item"><span class="text">Discount</span><span class="price" id="discountAmount">₱<?php echo number_format($discountAmount, 2, '.', ','); ?></span></div>
                        <div class="summary-item"><span class="text">Shipping</span><span class="price">₱<?php echo number_format($shipping, 2, '.', ','); ?></span></div>
                        <div class="summary-item"><span class="text">Total</span><span class="price" id="totalPrice">₱<?php echo number_format($totalPrice, 2, '.', ','); ?></span></div>
                        <form method="POST" action="" onsubmit="return confirmCheckout();">
                            <button type="submit" name="checkout" class="checkout-button">Checkout</button>
                        </form>
                        <div class="discount-section">
                            <button type="button" class="discount-button" onclick="applyDiscount()">Apply Discount</button>
                            <input type="text" id="discountCode" placeholder="Enter discount code" class="form-control" style="margin-top: 10px;">
                            <div id="discountMessage" style="margin-top: 10px;"></div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</section>
<script>
let subtotal = <?php echo $subtotal; ?>; // Use the calculated subtotal
let shipping = 300;
let discountAmount = 0;

function applyDiscount() {
    const discountCode = document.getElementById('discountCode').value;
    const validDiscounts = {
        'BIKES10': 0.10,
        'BIKES20': 0.20
    };
    if (discountCode in validDiscounts) {
        discountAmount = subtotal * validDiscounts[discountCode];
        document.getElementById('discountMessage').innerText = 'Discount applied: ₱' + discountAmount.toFixed(2, '.', ',');
    } else {
        discountAmount = 0;
        document.getElementById('discountMessage').innerText = 'Invalid discount code. Please try again.';
    }
    updateTotalPrice();
}

function updateTotalPrice() {
    const totalPrice = subtotal + shipping - discountAmount;
    document.getElementById('totalPrice').innerText = '₱' + number_format(totalPrice, 2, '.', ',');
    document.getElementById('discountAmount').innerText = '₱' + number_format(discountAmount, 2, '.', ','); // Update discount amount display
}

//helper function
function number_format(number, decimals, dec_point, thousands_sep) {
  // Strip all the non-numeric characters
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function (n, prec) {
          var k = Math.pow(10, prec);
          return '' + (Math.round(n * k) / k).toFixed(prec);
      };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
      s[1] = s[1] || '';
      s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}
</script>

<style>
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: #f8f9fa;
}
.checkout-button, .discount-button {
    background: #CEC4C2;
    padding: 10px;
    display: inline-block;
    outline: 0;
    border: 1px solid #A39594;
    border-radius: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    width: 100%;
}

.checkout-button:hover, .discount-button:hover {
    box-shadow: 0 4px 15px rgba(255, 233, 191, 0.65);
}

.shopping-cart {
    padding-bottom: 50px;
    font-family: 'Montserrat', sans-serif;
}

.shopping-cart .content {
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
    background-color: #F0F0F0;
}

.shopping-cart .block-heading {
    margin-bottom: 40px;
    text-align: center;
}

.shopping-cart .block-heading h2,
.shopping-cart .block-heading h3 {
    margin-bottom: 1.2rem;
    color: #44443B;
}

.shopping-cart .items {
    margin: auto;
}

.shopping-cart .items .product {
    background-color: #CEC4C2;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 15px;
    transition: box-shadow 0.3s ease;
    margin-bottom: 20px;
}

.shopping-cart .items .product:hover {
    box-shadow: 0 4px 15px rgba(255, 233, 191, 0.8);
}

.shopping-cart .items .product .info {
    padding: 10px;
    text-align: left;
}

.shopping-cart .items .product .info .product-name {
    font-weight: 600;
    text-decoration: none;
}

.shopping-cart .items .product .info .product-name a {
    color: #44443B;
    text-decoration: none;
}

.shopping-cart .items .product .info .product-name a:hover {
    font-weight: bold;
    text-decoration: none;
}

.shopping-cart .items .product .info .quantity .quantity-input {
    margin: auto;
    width: 80px;
}

.shopping-cart .items .product .info .price {
    color: #44443B;
    font-size: 1.5em;
}

.shopping-cart .summary {
    border-top: 2px solid #44443B;
    background-color: #f7fbff;
    height: 100%;
    padding: 30px;
}

.shopping-cart .summary h3 {
    text-align: center;
    font-size: 1.3em;
    font-weight: 600;
    padding-top: 20px;
    padding-bottom: 20px;
}

.shopping-cart .summary .summary-item:not(:last-of-type) {
    padding-bottom: 10px;
    padding-top: 10px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.shopping-cart .summary .text {
    font-size: 1em;
    font-weight: 600;
}

.shopping-cart .summary .price {
    font-size: 1em;
    float: right;
}

.shopping-cart .summary button {
    margin-top: 20px;
}

.remove-button-container {
    text-align: right;
}

@media (min-width: 768px) {
    .shopping-cart .items .product .info {
        padding-top: 25px;
        text-align: left; 
    }

    .shopping-cart .items .product .info .price {
        font-weight: bold;
        font-size: 22px;
    }

    .shopping-cart .items .product .info .quantity {
        text-align: center; 
    }
    .shopping-cart .items .product .info .quantity .quantity-input {
        padding: 4px 10px;
        text-align: center; 
    }
}
</style>
