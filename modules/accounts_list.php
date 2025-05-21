<style>
    @font-face{
        font-family: Futura;
        src: url(futura.ttf);
    }
    @font-face{
        font-family: FuturaLight;
        src: url(futura1.ttf);
    }
    .btnedit:link{
        font-family: FuturaLight;
        border: 0px;
        border-radius: 100px;
        text-transform: capitalize;
        font-size: 15px;
    }
    .btnedit{
        font-family: FuturaLight;
        font-size: 15px;
        border: 0px;
        border-radius: 100px;
    }
</style>

<?php
include("dbconi.php");

$items_per_page = 7;
$page = isset($_POST['pagenum']) ? (int)$_POST['pagenum'] : 1;
$offset = ($page - 1) * $items_per_page;
$search = isset($_POST['txtsearch']) ? mysqli_real_escape_string($dbc, $_POST['txtsearch']) : '';
$query = "SELECT * FROM users WHERE (username LIKE '$search%' OR fullname LIKE '$search%' OR roles LIKE '$search%') LIMIT $offset, $items_per_page";
$result = mysqli_query($dbc, $query);
$total_query = "SELECT COUNT(*) as total FROM users WHERE (username LIKE '$search%' OR fullname LIKE '$search%' OR roles LIKE '$search%')";
$total_result = mysqli_query($dbc, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $items_per_page);

// Change this to your actual image column name if different
$image_column = 'profile'; // e.g., 'profile_pic' or 'image'

if(mysqli_num_rows($result) > 0){
    echo '<table class="table table-striped">
        <thead>
            <tr>
                <th>Account No.</th>
                <th>User Name</th>
                <th>Full Name</th>
                <th>Roles</th>
                <th>Address</th>
                <th>Items</th>
                <th>Status</th>
                <th>Image</th>
                <th></th>
            </tr>
        </thead>
        <tbody>';
    while($row = mysqli_fetch_array($result)){
        $img_id = 'imgModal' . $row['id'];
        $img_file = isset($row[$image_column]) ? basename($row[$image_column]) : '';
        $img_url = 'modules/uploads/' . rawurlencode($img_file);

        echo '<tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['username'].'</td>
            <td>'.$row['fullname'].'</td>
            <td>'.$row['roles'].'</td>
            <td>'.$row['address'].'</td>
            <td>'.$row['items'].'</td>
            <td>'.$row['accstatus'].'</td>
            <td>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#'.$img_id.'">
                    View Image
                </button>
                <!-- Modal -->
                <div class="modal fade" id="'.$img_id.'" tabindex="-1" role="dialog" aria-labelledby="'.$img_id.'Label" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="'.$img_id.'Label">User Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-center">';
        if (!empty($img_file) && $img_file !== '.' && $img_file !== '..') {
            echo '<img src="'.$img_url.'" alt="User Image" class="img-fluid" style="max-height:400px;" 
                    onerror="this.style.display=\'none\'; this.nextElementSibling.style.display=\'block\';">
                  <span style="display:none;" class="text-danger">File not found: '.htmlspecialchars($img_file).'</span>';
        } else {
            echo '<span class="text-muted">No image uploaded.</span>';
        }
        echo '        </div>
                    </div>
                  </div>
                </div>
            </td>
            <td>
                <a href="./?page=accounts_edit&id='.$row['id'].'" class="btn btn-warning btnedit" id="btnedit">Edit</a>
            </td>
            </tr>';
    }
    echo '</tbody></table>';

    echo '<nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">';

    if($page > 1){
        echo '<li class="page-item">
            <a class="page-link" href="#" data-pagenum="1" aria-label="First">
                <span aria-hidden="true">&laquo;&laquo;</span>
            </a>
            </li>';
    }

    if($page > 1){
        echo '<li class="page-item">
            <a class="page-link" href="#" data-pagenum="'.($page - 1).'" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
            </li>';
    }

    for($i = 1; $i <= $total_pages; $i++){
        echo '<li class="page-item '.($i == $page ? 'active' : '').'">
            <a class="page-link" href="#" data-pagenum="'.$i.'">'.$i.'</a>
            </li>';
    }

    if($page < $total_pages){
        echo '<li class="page-item">
            <a class="page-link" href="#" data-pagenum="'.($page + 1).'" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
            </li>';
    }

    if($page < $total_pages){
        echo '<li class="page-item">
            <a class="page-link" href="#" data-pagenum="'.$total_pages.'" aria-label="Last">
                <span aria-hidden="true">&raquo;&raquo;</span>
            </a>
            </li>';
    }

    echo '</ul></nav>';
} else {
    echo '<div class="alert alert-primary text-center" role="alert">No Product Records found!</div>';
}
?>

<!-- Make sure Bootstrap JS and jQuery are loaded for modal functionality -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
