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
</style>

<?php
include("dbconi.php");

$items_per_page = 7;
$page = isset($_POST['pagenum']) ? (int)$_POST['pagenum'] : 1;
$offset = ($page - 1) * $items_per_page;
$search = isset($_POST['txtsearch']) ? mysqli_real_escape_string($dbc, $_POST['txtsearch']) : '';
$query = "SELECT * FROM payments WHERE (fullname LIKE '$search%' OR items LIKE '$search%' OR time LIKE '$search%') LIMIT $offset, $items_per_page";
$result = mysqli_query($dbc, $query);
$total_query = "SELECT COUNT(*) as total FROM payments WHERE (fullname LIKE '$search%' OR items LIKE '$search%' OR time LIKE '$search%')";
$total_result = mysqli_query($dbc, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $items_per_page);

if(mysqli_num_rows($result) > 0){
    echo '<table class="table table-striped">
        <thead>
            <tr>
                <th>Transaction No.</th>
                <th>Full Name</th>
                <th>Items</th>
                <th>Price</th>
                <th>Ref No.</th>
                <th>Time</th>
                <th>Status</th>
                <th>Proof</th>
            </tr>
        </thead>
        <tbody>';
    
    while($row = mysqli_fetch_array($result)){
        $proof = htmlspecialchars($row['proof']);
        $proof_id = 'proofModal' . $row['id'];
        // Always use only the filename for the image path
        $proof_file = basename($row['proof']);
        // Directly reference the image in the modules/uploads/ folder
        $img_url = 'modules/uploads/' . rawurlencode($proof_file);

        echo '<tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['fullname'].'</td>
            <td>'.$row['items'].'</td>
            <td>₱'.number_format($row['price'], 2).'</td>
            <td>'.$row['reference'].'</td>
            <td>'.$row['time'].'</td>
            <td>'.$row['status'].'</td>
            <td>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#'.$proof_id.'">
                    View Proof
                </button>
                <!-- Modal -->
                <div class="modal fade" id="'.$proof_id.'" tabindex="-1" role="dialog" aria-labelledby="'.$proof_id.'Label" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="'.$proof_id.'Label">Payment Proof</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-center">';
        if (!empty($proof_file) && $proof_file !== '.' && $proof_file !== '..') {
            echo '<img src="'.$img_url.'" alt="Proof Image" class="img-fluid" style="max-height:400px;" 
                    onerror="this.style.display=\'none\'; this.nextElementSibling.style.display=\'block\';">
                  <span style="display:none;" class="text-danger">File not found: '.htmlspecialchars($proof_file).'</span>';
        } else {
            echo '<span class="text-muted">No proof uploaded.</span>';
        }
        echo '        </div>
                    </div>
                  </div>
                </div>
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
    echo '<div class="alert alert-primary text-center" role="alert">No Transaction Records found!</div>';
}
?>

<!-- Make sure Bootstrap JS and jQuery are loaded for modal functionality -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
