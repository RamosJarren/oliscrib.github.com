<?php
include 'dbconi.php';
session_start(); // Start the session to access session variables

$user_id = isset($_SESSION['userfullname']) ? $_SESSION['userfullname'] : 0;
$products = [];
$totalPrice = 0;
$userAddress = ""; // Initialize user address

// Fetch user order details
if ($user_id) {
    $sql = "SELECT items, address FROM users WHERE fullname = '$user_id'";
    $result = mysqli_query($dbc, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $userAddress = $user['address']; // Assuming you have an address field
        if (!empty($user['items'])) {
            $item_ids = explode(',', $user['items']);
            foreach ($item_ids as $item_id) {
                $item_id = intval($item_id);
                $product_sql = "SELECT * FROM bikes WHERE id = $item_id";
                $product_result = mysqli_query($dbc, $product_sql);
                if ($product_result) {
                    while ($product = mysqli_fetch_assoc($product_result)) {
                        $products[] = $product;
                    }
                }
            }
        }
    }
}

// Calculate total price
$totalPrice = array_sum(array_column($products, 'price')) + 300; // Add shipping cost

// Generate QR Code
$paymentInfo = "Total: ₱" . $totalPrice . " | User: " . $user_id; // Example payment info
$qrCodeData = urlencode($paymentInfo);
$qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?data=$qrCodeData&size=200x200";

// Handle payment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $referenceNumber = mysqli_real_escape_string($dbc, $_POST['referenceNumber']);
    $totalPrice = mysqli_real_escape_string($dbc, $_POST['totalPrice']);

    // Insert payment details into the database
    $currentTime = date('Y-m-d H:i:s');
    $insert_sql = "INSERT INTO payments (fullname, reference_number, price, time) VALUES ('$user_id', '$referenceNumber', $totalPrice, '$currentTime')";

    if (mysqli_query($dbc, $insert_sql)) {
        echo "<script>alert('Payment processed successfully!'); window.location.href='success_page.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error processing payment: " . mysqli_error($dbc) . "');</script>";
    }
}
?>

    <div class="container">
        <h2>Review Your Order</h2>
        <div class="order-summary">
            <h3>Order Summary</h3>
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <p><?php echo htmlspecialchars($product['model']); ?> - ₱<?php echo htmlspecialchars($product['price']); ?></p>
                </div>
            <?php endforeach; ?>
            <p>Shipping: ₱300</p>
            <p>Total: ₱<?php echo $totalPrice; ?></p>
        </div>

        <div class="address">
            <h3>Your Address</h3>
            <p><?php echo htmlspecialchars($userAddress); ?></p> <!-- Display user address -->
        </div>

        <div class="qr-code">
            <h3>Payment QR Code</h3>
            <img src="<?php echo $qrCodeUrl; ?>" alt="QR Code for Payment">
        </div>

        <form method="POST" action="">
            <label for="referenceNumber">Enter Reference Number:</label>
            <input type="text" id="referenceNumber" name="referenceNumber" required>
            <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">
            <button type="submit">Submit Payment</button>
        </form>
    </div>
