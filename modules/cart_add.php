<?php
session_start();
include 'dbconi.php';

$user_id = isset($_SESSION['userfullname']) ? $_SESSION['userfullname'] : 0;
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

if ($user_id && $product_id) {
    // Update the user's cart
    $sql = "UPDATE users SET items = CONCAT_WS(',', items, '$product_id') WHERE fullname = '$user_id'";
    
    if (mysqli_query($dbc, $sql)) {
        // Now update the stock of the bike
        $updateStockSql = "UPDATE bikes SET stock = stock - 1 WHERE id = $product_id AND stock > 0";
        
        if (mysqli_query($dbc, $updateStockSql)) {
            echo "Product added to cart and stock updated.";
        } else {
            echo "Product added to cart, but error updating stock: " . mysqli_error($dbc);
        }
    } else {
        echo "Error adding product: " . mysqli_error($dbc);
    }
} else {
    echo "Invalid user or product ID.";
}
?>
