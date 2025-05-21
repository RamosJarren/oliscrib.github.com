<style>
    @font-face {
        font-family: Futura;
        src: url(futura.ttf);
    }
    @font-face {
        font-family: FuturaLight;
        src: url(futura1.ttf);
    }
    .btnedit:link {
        font-family: FuturaLight;
        border: 0px;
        border-radius: 100px;
        text-transform: capitalize;
        font-size: 15px;
    }
</style>

<?php
include("dbconi.php");
session_start(); // Ensure session is started

// Assuming the user's full name is set in the session when they log in
if (isset($_SESSION['userfullname'])) {
    $userfullname = mysqli_real_escape_string($dbc, $_SESSION['userfullname']);
    
    $items_per_page = 7;
    $page = isset($_POST['pagenum']) ? (int)$_POST['pagenum'] : 1;
    $offset = ($page - 1) * $items_per_page;
    
    // Modify the query to filter by user's full name
    $query = "SELECT * FROM payments WHERE fullname LIKE '$userfullname%' LIMIT $offset, $items_per_page";
    $result = mysqli_query($dbc, $query);
    
    // Get total number of items for pagination
    $total_query = "SELECT COUNT(*) as total FROM payments WHERE fullname LIKE '$userfullname%'";
    $total_result = mysqli_query($dbc, $total_query);
    $total_row = mysqli_fetch_assoc($total_result);
    $total_items = $total_row['total'];
    $total_pages = ceil($total_items / $items_per_page);

    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-striped">
            <thead>
                <tr>
                    <th>Transaction No.</th>
                    <th>Full Name</th>
                    <th>Items</th>
                    <th>Price</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>';
        
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr>
                <td>' . htmlspecialchars($row['id']) . '</td>
                <td>' . htmlspecialchars($row['fullname']) . '</td>
                <td>' . htmlspecialchars($row['items']) . '</td>
                <td>₱'.number_format($row['price'], 2).'</td>
                <td>' . htmlspecialchars($row['time']) . '</td>
                <td>' . htmlspecialchars($row['status']) . '</td>
                </tr>';
        }
        echo '</tbody></table>';

        // Pagination
        echo '<nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">';

        if ($page > 1) {
            echo '<li class="page-item">
                <a class="page-link" href="#" data-pagenum="1" aria-label="First">
                    <span aria-hidden="true">&laquo;&laquo;</span>
                </a>
                </li>';
        }

        if ($page > 1) {
            echo '<li class="page-item">
                <a class="page-link" href="#" data-pagenum="' . ($page - 1) . '" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                </li>';
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '">
                <a class="page-link" href="#" data-pagenum="' . $i . '">' . $i . '</a>
                </li>';
        }

        if ($page < $total_pages) {
            echo '<li class="page-item">
                <a class="page-link" href="#" data-pagenum="' . ($page + 1) . '" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>';
        }

        if ($page < $total_pages) {
            echo '<li class="page-item">
                <a class="page-link" href="#" data-pagenum="' . $total_pages . '" aria-label="Last">
                    <span aria-hidden="true">&raquo;&raquo;</span>
                </a>
                </li>';
        }

        echo '</ul></nav>';
    } else {
        echo '<div class="alert alert-primary text-center" role="alert">No Transaction Records found!</div>';
    }
} else {
    echo '<div class="alert alert-danger text-center" role="alert">User  not logged in!</div>';
}
?>