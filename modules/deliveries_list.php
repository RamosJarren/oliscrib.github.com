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
$query = "SELECT * FROM bikes WHERE (brand LIKE '$search%' OR model LIKE '$search%' OR part LIKE '$search%') LIMIT $offset, $items_per_page";
$result = mysqli_query($dbc, $query);
$total_query = "SELECT COUNT(*) as total FROM bikes WHERE (brand LIKE '$search%' OR model LIKE '$search%' OR part LIKE '$search%')";
$total_result = mysqli_query($dbc, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $items_per_page);

if(mysqli_num_rows($result) > 0){
    echo '<table class="table table-striped">
        <thead>
            <tr>
                <th>Bike No.</th>
                <th>Brand Name</th>
                <th>Model Name</th>
                <th>Stock</th>
                <th></th>
            </tr>
        </thead>
        <tbody>';
    while($row = mysqli_fetch_array($result)){
        echo '<tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['brand'].'</td>
            <td>'.$row['model'].'</td>
            <td>'.$row['stock'].'</td>
            <td>
                <a href="./?page=stocks_edit&id='.$row['id'].'" class="btn btn-warning btnedit" id="btnedit">Add Stock</a>
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