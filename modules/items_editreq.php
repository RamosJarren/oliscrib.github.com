<?php
include("dbconi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['txtid'];
    $brand = $_POST['txtbrand'];
    $model = $_POST['txtmodel'];
    $part = $_POST['txtpart'];
    $type = $_POST['txttype'];
	$price = $_POST['txtprice'];

    $image_name = null;
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
        $upload_dir = "uploads/";
        $image_name = uniqid("bike_") . "_" . basename($_FILES['profile']['name']);
        $upload_path = $upload_dir . $image_name;

        if (move_uploaded_file($_FILES['profile']['tmp_name'], $upload_path)) {
        } else {
            echo "Error uploading image.";
            exit;
        }
    }

    $query = "UPDATE bikes SET brand = ?, model = ?, part = ?, type = ?, price = ?";
    $params = array($brand, $model, $part, $type, $price);

    if ($image_name !== null) {
        $query .= ", image = ?";
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