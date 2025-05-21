<?php
session_start();
include 'dbconi.php';

$user_id = isset($_SESSION['userfullname']) ? $_SESSION['userfullname'] : 0;
$product_id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($user_id && $product_id) {
    // Get the user's current items
    $sql = "SELECT items FROM users WHERE fullname = '$user_id'";
    $result = mysqli_query($dbc, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && !empty($user['items'])) {
        // Remove the product ID from the user's items
        $item_ids = explode(',', $user['items']);
        $item_ids = array_filter($item_ids, function($id) use ($product_id) {
            return $id != $product_id;
        });
        
        $new_items = implode(',', $item_ids);
        $update_sql = "UPDATE users SET items = '$new_items' WHERE fullname = '$user_id'";
        
        if (mysqli_query($dbc, $update_sql)) {
            // Update the stock of the bike
            $updateStockSql = "UPDATE bikes SET stock = stock + 1 WHERE id = $product_id";
            if (mysqli_query($dbc, $updateStockSql)) {
                echo "Product removed from cart and stock updated.";
            } else {
                echo "Product removed from cart, but error updating stock: " . mysqli_error($dbc);
            }
        } else {
            echo "Error updating user items: " . mysqli_error($dbc);
        }
    } else {
        echo "No items found in the cart.";
    }
} else {
    echo "Invalid user or product ID.";
}
?>
    