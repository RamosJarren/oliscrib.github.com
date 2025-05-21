<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Payment</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        .checkout-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1, h2, h3 {
            color: #333;
            text-align: center;
        }

        .payment-gateway, .review-details, .upload-section {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .gateway-option {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .gateway-option img {
            width: 150px;
            height: auto;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
        }

        .upload-section input[type="file"] {
            margin-top: 10px;
        }

        #checkout-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        #checkout-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        #zoomed-image {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        #zoomed-image img {
            max-width: 90%;
            max-height: 90%;
        }

        .order-summary {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        .order-summary h3 {
            margin-top: 0;
        }

        .price-details {
            margin-top: 10px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }

        .total-price {
            font-weight: bold;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>

<?php
include 'dbconi.php';

$payment_id = 0;
$total_price = 0.00;
$user_id = isset($_SESSION['userfullname']) ? $_SESSION['userfullname'] : 'Guest';

if (isset($_GET['payment_id']) && !empty($_GET['payment_id'])) {
    $payment_id = intval($_GET['payment_id']);
    $stmt = mysqli_prepare($dbc, "SELECT * FROM payments WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $payment_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result && mysqli_num_rows($result) > 0) {
        $payment = mysqli_fetch_assoc($result);
        $total_price = $payment['price'];
    } else {
        echo "<script>alert('Payment not found!'); window.location.href = '?page=checkout';</script>";
        exit();
    }
}

$upload_dir = __DIR__ . '/uploads/'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_payment'])) {
    $reference = isset($_POST['reference_number']) ? $_POST['reference_number'] : '';
    $payment_proof = $_FILES['payment_proof'];

    if ($payment_proof['error'] === UPLOAD_ERR_OK) {
        $proof_path = $upload_dir . uniqid('cus_') . '-' . basename($payment_proof['name']);
        if (move_uploaded_file($payment_proof['tmp_name'], $proof_path)) {
            echo "<script>alert('File uploaded successfully.');</script>";
        } else {
            echo "<script>alert('Error moving uploaded file.');</script>";
            error_log("Failed to move uploaded file from " . $payment_proof['tmp_name'] . " to " . $proof_path);
            exit();
        }
    }

    $stmt = mysqli_prepare($dbc, "UPDATE payments SET status = 'paid', reference = ?, proof = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssi", $reference, $proof_path, $payment_id);
    
    if (mysqli_stmt_execute($stmt)) {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>alert('Payment processed successfully!'); window.location.href = '?page=checkout';</script>";
        } else {
            echo "<script>alert('No changes made to the payment status.');</script>";
        }
    } else {
        echo "<script>alert('Error updating payment status: " . mysqli_error($dbc) . "');</script>";
    }
}

?>

<div class="checkout-container">
    <h1>Complete Your Payment</h1>
    
    <div class="order-summary">
        <h3>Order Summary</h3>
        <p><strong>Order ID:</strong> #<?php echo htmlspecialchars($payment_id); ?></p>
        <span>₱<?php echo htmlspecialchars(number_format($total_price, 2)); ?></span>
        <div class="price-details">
            <div class="total-price price-row">
                <span>Total Amount:</span>
                <span>₱<?php echo number_format($total_price, 2); ?></span>
            </div>
        </div>
    </div>
    
    <form id="payment-form" method="POST" action="" enctype="multipart/form-data" onsubmit="return confirmPayment();">
        <div class="payment-gateway">
            <h2>Payment Gateway</h2>
            <div class="gateway-option">
                <img src="images/qr.png" alt="QR Code" id="qr-code-img">
                <label for="QRcode">QR Code</label>
                <input type="radio" id="QRcode" name="payment_method" value="QRcode" required>
            </div>
        </div>

        <div class="review-details">
            <h2>Review Your Details</h2>
            <p><strong>Name:</strong> <span id="customer-name"><?php echo htmlspecialchars($user_id); ?></span></p>
            <p><strong>Shipping Address:</strong> <span id="shipping-address">123 Main St, Anytown, USA</span></p>

            <div class="upload-section">
                <h3>Upload Payment Proof and Enter Reference Number</h3>
                <input type="file" id="payment-proof" name="payment_proof" accept="image/*">
                <p>Please upload a screenshot of your payment confirmation.</p>
                
                <h3>Reference Number</h3>
                <input type="text" id="reference-number" name="reference_number" placeholder="Enter payment reference number" style="width: 100%; padding: 8px; margin-top: 10px;">
                <p id="upload-error" class="error-message"></p>
            </div>
        </div>

        <input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>">
        <button id="checkout-button" type="submit" name="submit_payment">Complete Payment</button>
        <p id="payment-message"></p>
    </form>
</div>

<div id="zoomed-image" >
    <img id="zoomed-qr-code" src="images/qr.png" alt="Zoomed QR Code">
</div>

<script>
function confirmPayment() {
    return confirm("Are you sure you want to proceed with the payment?");
}

document.addEventListener('DOMContentLoaded', function() {
    const paymentProofInput = document.getElementById('payment-proof');
    const referenceNumberInput = document.getElementById('reference-number');
    const checkoutButton = document.getElementById('checkout-button');
    const uploadError = document.getElementById('upload-error');
    const qrCodeImg = document.getElementById('qr-code-img');
    const zoomedImage = document.getElementById('zoomed-image');
    const zoomedQrCode = document.getElementById('zoomed-qr-code');


    function validateForm() {
        if (paymentProofInput.files.length > 0 && referenceNumberInput.value.trim() !== '') {
            uploadError.textContent = '';
            checkoutButton.disabled = false;
            return true;
        } else {
            if (paymentProofInput.files.length === 0) {
                uploadError.textContent = 'Please upload a payment proof.';
            } else if (referenceNumberInput.value.trim() === '') {
                uploadError.textContent = 'Please enter a reference number.';
            }
            checkoutButton.disabled = true;
            return false;
        }
    }

    paymentProofInput.addEventListener('change', validateForm);
    referenceNumberInput.addEventListener('input', validateForm);

    qrCodeImg.addEventListener('click', function() {
        zoomedImage.style.display = 'flex';
    });

    zoomedImage.addEventListener('click', function() {
        this.style.display = 'none';
    });

    // Initial validation
    checkoutButton.disabled = true;
});
</script>
