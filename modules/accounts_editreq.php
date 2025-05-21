<?php
include("dbconi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['txtid'];
    $username = $_POST['txtuser'];
    $password = $_POST['txtpass'];
    $fullname = $_POST['txtfull'];
    $address = $_POST['txtaddress'];

    $image_name = null;
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
        $upload_dir = "uploads/";
        $image_name = uniqid("acc_") . "_" . basename($_FILES['profile']['name']);
        $upload_path = $upload_dir . $image_name;

        if (move_uploaded_file($_FILES['profile']['tmp_name'], $upload_path)) {
        } else {
            echo "Error uploading image.";
            exit;
        }
    }

    $query = "UPDATE users SET username = ?, password = ?, fullname = ?, address = ?";
    $params = array($username, $password, $fullname, $address);

    if ($image_name !== null) {
        $query .= ", profile = ?";
        $params[] = $image_name;
    }

    $query .= " WHERE id = ?";
    $params[] = $id;

    $stmt = mysqli_prepare($dbc, $query);
    $types = str_repeat('s', count($params) - 1) . 'i';
    mysqli_stmt_bind_param($stmt, $types, ...$params);

    if (mysqli_stmt_execute($stmt)) {
        echo "success";
    } else {
        echo "Error updating record: " . mysqli_error($dbc);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($dbc);
} else {
    echo "Invalid request.";
}
?>