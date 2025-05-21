<?php
include 'dbconi.php';

$query = $_GET['q'];
$response = [];

if ($query) {
    $query = mysqli_real_escape_string($dbc, $query);
    $sql = "SELECT model, link FROM bikes WHERE model LIKE '%$query%' OR brand LIKE '%$query%' OR part LIKE '%$query%'";
    $result = mysqli_query($dbc, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }
}

echo json_encode($response);
?>