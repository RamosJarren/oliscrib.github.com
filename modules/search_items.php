<?php
include("dbconi.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_POST['search'])) {
    $searchTerm = mysqli_real_escape_string($dbc, $_POST['search']);
    $query = "SELECT * FROM bikes WHERE brand LIKE '%$searchTerm%' OR model LIKE '%$searchTerm%' OR part LIKE '%$searchTerm%'";
    $result = mysqli_query($dbc, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="product-item">
                    <span>' . htmlspecialchars($row['brand']) . ' - ' . htmlspecialchars($row['model']) . ' - ' . htmlspecialchars($row['part']) . '</span>
                    <button class="btn btn-primary select-product" data-id="' . $row['id'] . '" data-name="' . htmlspecialchars($row['brand'] . ' ' . $row['model']) . '">Select</button>
                  </div>';
        }
    } else {
        echo '<div>No products found</div>';
    }
}

