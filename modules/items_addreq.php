<?php
include("dbconi.php");

$isallok = true;
$msg = "";

if(trim($_POST['txtbrand'])==''){
	$isallok = false; $msg .="Enter Brand Name\n";
}
if(trim($_POST['txtmodel'])==''){
	$isallok = false; $msg .="Enter Model Name\n";
}
if(trim($_POST['txtpart'])==''){
	$isallok = false; $msg .="Enter Part Type\n";
}
if(trim($_POST['txttype'])==''){
	$isallok = false; $msg .="Enter Item Type\n";
}
if(trim($_POST['txtprice'])==''){
	$isallok = false; $msg .="Enter Price\n";
}
if(trim($_POST['txtstock'])==''){
	$isallok = false; $msg .="Enter Stock\n";
}

$image_name = null; // Initialize to null
$upload_dir = "uploads/"; // Define your upload directory

if (isset($_FILES['profile']) && $_FILES['profile']['error'] == UPLOAD_ERR_OK) {
    // Generate a unique filename to prevent overwrites
    $image_name = uniqid("bike_") . "_" . basename($_FILES['profile']['name']);
    $upload_path = $upload_dir . $image_name;

    // Attempt to move the uploaded file
    if (!move_uploaded_file($_FILES['profile']['tmp_name'], $upload_path)) {
        $isallok = false;
        $msg .= "Error uploading image.\n";
        // Log the error for debugging, similar to your payment proof example
        error_log("Failed to move uploaded image from " . $_FILES['profile']['tmp_name'] . " to " . $upload_path);
    }
} elseif (isset($_FILES['profile']) && $_FILES['profile']['error'] != UPLOAD_ERR_NO_FILE) {
    // Handle other potential upload errors (e.g., file too large)
    $isallok = false;
    $msg .= "An error occurred with the image upload: Error code " . $_FILES['profile']['error'] . "\n";
}

if ($isallok) {
    $brand = $_POST['txtbrand'];
    $model = $_POST['txtmodel'];
    $part = $_POST['txtpart'];
    $type = $_POST['txttype'];
    $price = $_POST['txtprice'];
    $stock = $_POST['txtstock'];

    // Prepare the SQL query to insert user data, including the profile image name
    // Make sure your 'users' table has a 'profile' column (e.g., VARCHAR)
    if ($stmt = $dbc->prepare("INSERT INTO bikes (brand, model, part, type, price, stock, image) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
        // Bind parameters, including the new 'profile' parameter
        $stmt->bind_param("sssssss", $brand, $model, $part, $type, $price, $stock, $image_name);

        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $dbc->error;
    }
} else {
    echo "Error: " . $msg;
}

mysqli_close($dbc);
?>