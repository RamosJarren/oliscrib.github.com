<?php
// Include database connection
include 'dbconi.php';  // Changed to single quotes for consistency

// Check if all required fields are set and not empty
if (isset($_POST['txtusername'], $_POST['txtpassword'], $_POST['txtfullname']) && 
    !empty($_POST['txtusername']) && !empty($_POST['txtpassword']) && 
    !empty($_POST['txtfullname']) && !empty($_POST['txtaddress'])) {

    // Sanitize input to prevent SQL injection
    $username = mysqli_real_escape_string($dbc, $_POST['txtusername']);
    $password = mysqli_real_escape_string($dbc, $_POST['txtpassword']);
    $fullname = mysqli_real_escape_string($dbc, $_POST['txtfullname']);
    $address = mysqli_real_escape_string($dbc, $_POST['txtaddress']);
    $roles = 'client';
    $accstatus = 'active';

    // Use prepared statements to prevent SQL injection
    if ($stmt = mysqli_prepare($dbc, "INSERT INTO users (username, password, fullname, address, roles, accstatus) VALUES (?, ?, ?, ?, ?, ?)")) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssssss", $username, $password, $fullname, $address, $roles, $accstatus);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Success!";
        } else {
            echo "Error: " . mysqli_stmt_error($stmt); // Use mysqli_stmt_error
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($dbc); // Use mysqli_error
    }
} else {
    echo "Error: All fields are required.";
}

// Close the database connection
mysqli_close($dbc);
?>
