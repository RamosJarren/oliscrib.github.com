<?php
include("dbconi.php");

$username = mysqli_real_escape_string($dbc, $_POST['txtusername']);
$password = mysqli_real_escape_string($dbc, $_POST['txtpassword']);

$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($dbc, $query);

if (!$result) {
    echo "Query Error: " . mysqli_error($dbc);
    exit();
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

    if ($row['accstatus'] == 'disabled') {
        echo "Account is disabled.";
        exit();
    }

    if ($password === $row['password']) {
        session_start();
        $_SESSION['loginok'] = '1';
        $_SESSION['userid'] = $row['id'];
        $_SESSION['userfullname'] = $row['fullname'];
        $_SESSION['userrole'] = $username === 'useradmin' ? 'admin' : $row['roles']; 

        if ($_SESSION['userrole'] === 'admin') {
            echo 'admin';
        } else {
            echo 'client';
        }

        $reset = "UPDATE users SET attempt = 0 WHERE username = '$username'";
        if (!mysqli_query($dbc, $reset)) {
            echo "Error resetting attempts: " . mysqli_error($dbc);
        }
    } else {
        echo "Invalid Credentials.";
        $update = "UPDATE users SET attempt = attempt + 1 WHERE username = '$username'";
        if (!mysqli_query($dbc, $update)) {
            echo "Error updating attempts: " . mysqli_error($dbc);
        }

        $attsQuery = "SELECT attempt FROM users WHERE username = '$username'";
        $attsResult = mysqli_query($dbc, $attsQuery);
        $attsRow = mysqli_fetch_array($attsResult);

        if ($attsRow['attempt'] >= 10) {
            $disable = "UPDATE users SET accstatus = 'disabled' WHERE username = '$username'";
            if (!mysqli_query($dbc, $disable)) {
                echo "Error disabling account: " . mysqli_error($dbc);
            }
            echo "Your account has been disabled.";
        }
    }
} else {
    echo "User not Found.";
}
?>