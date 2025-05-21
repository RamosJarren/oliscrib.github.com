<?php
include("dbconi.php");

$isallok = true;
$msg = "";

// Input validation
if(trim($_POST['txtuser']) == ''){
    $isallok = false;
    $msg .= "Enter User Name\n";
}
if(trim($_POST['txtpass']) == ''){
    $isallok = false;
    $msg .= "Enter Password\n";
}
if(trim($_POST['txtfull']) == ''){
    $isallok = false;
    $msg .= "Enter Full Name\n";
}
// Assuming your HTML input name for address is 'txtaddress'
if(trim($_POST['txtaddress']) == ''){
    $isallok = false;
    $msg .= "Enter Address\n";
}

// Image upload handling
$image_name = null; // Initialize to null
$upload_dir = "uploads/"; // Define your upload directory

// Check if a file was uploaded and there's no error
if (isset($_FILES['profile']) && $_FILES['profile']['error'] == UPLOAD_ERR_OK) {
    // Generate a unique filename to prevent overwrites
    $image_name = uniqid("acc_") . "_" . basename($_FILES['profile']['name']);
    $upload_path = $upload_dir . $image_name;

    // Attempt to move the uploaded file
    if (!move_uploaded_file($_FILES['profile']['tmp_name'], $upload_path)) {
        $isallok = false;
        $msg .= "Error uploading profile image.\n";
        // Log the error for debugging, similar to your payment proof example
        error_log("Failed to move uploaded profile image from " . $_FILES['profile']['tmp_name'] . " to " . $upload_path);
    }
} elseif (isset($_FILES['profile']) && $_FILES['profile']['error'] != UPLOAD_ERR_NO_FILE) {
    // Handle other potential upload errors (e.g., file too large)
    $isallok = false;
    $msg .= "An error occurred with the profile image upload: Error code " . $_FILES['profile']['error'] . "\n";
}


if ($isallok) {
    $username = $_POST['txtuser'];
    $password = $_POST['txtpass'];
    $fullname = $_POST['txtfull'];
    $address = $_POST['txtaddress'];
    $roles = 'client';
    $accstatus = 'active';

    // Prepare the SQL query to insert user data, including the profile image name
    // Make sure your 'users' table has a 'profile' column (e.g., VARCHAR)
    if ($stmt = $dbc->prepare("INSERT INTO users (username, password, fullname, address, roles, accstatus, profile) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
        // Bind parameters, including the new 'profile' parameter
        $stmt->bind_param("sssssss", $username, $password, $fullname, $address, $roles, $accstatus, $image_name);

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