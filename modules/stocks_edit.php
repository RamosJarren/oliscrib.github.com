<?php
// Enable error reporting for debugging (remove or restrict in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("dbconi.php"); // Make sure this path is correct

function redirect_with_alert($msg, $url) {
    echo "<script>alert(" . json_encode($msg) . "); window.location.href=" . json_encode($url) . ";</script>";
    exit;
}

// Initialize $row to avoid undefined variable notice on first load if no ID is provided
$row = ['id' => '', 'stock' => ''];

// If POST: process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $isallok = true;
    $msg = "";

    // Validate inputs
    $bike_id = isset($_POST['txtid']) ? $_POST['txtid'] : '';
    $supplier_name = isset($_POST['txtsupp']) ? trim($_POST['txtsupp']) : '';
    $reference = isset($_POST['txtref']) ? trim($_POST['txtref']) : '';
    $stock = isset($_POST['txtstock']) ? intval($_POST['txtstock']) : 0;

    if ($bike_id === '') { $isallok = false; $msg .= "Invalid Bike ID\n"; }
    if ($supplier_name === '') { $isallok = false; $msg .= "Enter Supplier Name\n"; }
    if ($reference === '') { $isallok = false; $msg .= "Enter Reference Number\n"; }
    if ($stock <= 0) { $isallok = false; $msg .= "Enter valid Stock number\n"; }

    // Check file upload
    if(!isset($_FILES['payment_proof']) || $_FILES['payment_proof']['error'] !== UPLOAD_ERR_OK){
        $isallok = false;
        $msg .= "Upload Supplier Receipt Image\n";
    }

    if(!$isallok){
        echo nl2br(htmlspecialchars($msg));
        exit;
    }

    // Sanitize inputs for DB (though prepared statements handle most of this)
    $bike_id_db = mysqli_real_escape_string($dbc, $bike_id);
    $supplier_name_db = mysqli_real_escape_string($dbc, $supplier_name);
    $reference_db = mysqli_real_escape_string($dbc, $reference);

    // Handle file upload
    $upload_dir = __DIR__ . '/uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $file_tmp = $_FILES['payment_proof']['tmp_name'];
    $file_name = basename($_FILES['payment_proof']['name']);
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

    if(!in_array($file_ext, $allowed_ext)){
        echo "Invalid file type. Only JPG, PNG, GIF allowed.";
        exit;
    }

    $new_filename = uniqid('del_') . '.' . $file_ext;
    $target_file = $upload_dir . $new_filename;

    if(!move_uploaded_file($file_tmp, $target_file)){
        echo "Failed to upload image. Please check directory permissions.";
        exit;
    }

    // Store the full absolute path in the database
    $proof_path = $target_file;

    // Begin transaction
    mysqli_autocommit($dbc, false);
    $transaction_successful = true;
    $error_msg = "";

    // Update stock in bikes using prepared statement
    $update_stock_sql = "UPDATE bikes SET stock = ? WHERE id = ?";
    $stmt_update_stock = mysqli_prepare($dbc, $update_stock_sql);

    if ($stmt_update_stock) {
        mysqli_stmt_bind_param($stmt_update_stock, "is", $stock, $bike_id_db); // 'i' for integer, 's' for string
        if(!mysqli_stmt_execute($stmt_update_stock)){
            $transaction_successful = false;
            $error_msg .= "Failed to update stock: " . mysqli_stmt_error($stmt_update_stock) . "\n";
        }
        mysqli_stmt_close($stmt_update_stock);
    } else {
        $transaction_successful = false;
        $error_msg .= "Failed to prepare stock update statement: " . mysqli_error($dbc) . "\n";
    }

    // Get bike price using prepared statement
    $unit_price = 0;
    if($transaction_successful){
        $price_query = "SELECT price FROM bikes WHERE id = ?";
        $stmt_get_price = mysqli_prepare($dbc, $price_query);

        if ($stmt_get_price) {
            mysqli_stmt_bind_param($stmt_get_price, "s", $bike_id_db); // 's' for string
            mysqli_stmt_execute($stmt_get_price);
            $res = mysqli_stmt_get_result($stmt_get_price);

            if($res && mysqli_num_rows($res) > 0){
                $row_price = mysqli_fetch_assoc($res);
                $unit_price = floatval($row_price['price']);
            } else {
                $transaction_successful = false;
                $error_msg .= "Could not get bike unit price. Bike ID might be invalid.\n";
            }
            mysqli_stmt_close($stmt_get_price);
        } else {
            $transaction_successful = false;
            $error_msg .= "Failed to prepare get price statement: " . mysqli_error($dbc) . "\n";
        }
    }

    // Calculate total amount for payment record (unit price * stock added)
    $total_payment_amount = $unit_price * $stock;

    // Insert payment record using prepared statement
    if($transaction_successful){
        $current_time = date('Y-m-d H:i:s');
        $status = 'delivery'; // Or 'stock_in' or 'purchase'

        $insert_payment_sql = "INSERT INTO payments (fullname, items, price, reference, proof, time, status)
                               VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert_payment = mysqli_prepare($dbc, $insert_payment_sql);

        if ($stmt_insert_payment) {
            // 's' for string, 'd' for double/float
            mysqli_stmt_bind_param($stmt_insert_payment, "ssdssss",
                $supplier_name_db,
                $bike_id_db,
                $total_payment_amount,
                $reference_db,
                $proof_path,
                $current_time,
                $status
            );
            if(!mysqli_stmt_execute($stmt_insert_payment)){
                $transaction_successful = false;
                $error_msg .= "Failed to insert payment record: " . mysqli_stmt_error($stmt_insert_payment) . "\n";
            }
            mysqli_stmt_close($stmt_insert_payment);
        } else {
            $transaction_successful = false;
            $error_msg .= "Failed to prepare insert payment statement: " . mysqli_error($dbc) . "\n";
        }
    }

    if($transaction_successful){
        mysqli_commit($dbc);
        mysqli_autocommit($dbc, true);
        redirect_with_alert("Product Stock Successfully Updated and Payment Recorded!", "./?page=items");
    } else {
        mysqli_rollback($dbc);
        mysqli_autocommit($dbc, true);
        echo nl2br(htmlspecialchars("Transaction failed:\n" . $error_msg));
    }

    mysqli_close($dbc);
    exit;

} else { // If GET: show form
    $id = 0;
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
    }

    // Fetch bike details only on GET request for displaying the form
    $id_db = mysqli_real_escape_string($dbc, $id);
    $query = "SELECT * FROM bikes WHERE id = ?";
    $stmt_select_bike = mysqli_prepare($dbc, $query);

    if ($stmt_select_bike) {
        mysqli_stmt_bind_param($stmt_select_bike, "s", $id_db);
        mysqli_stmt_execute($stmt_select_bike);
        $result = mysqli_stmt_get_result($stmt_select_bike);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "Bike not found or invalid ID.";
            exit;
        }
        mysqli_stmt_close($stmt_select_bike);
    } else {
        echo "Failed to prepare bike selection statement: " . mysqli_error($dbc);
        exit;
    }
}
?>

<style>
@font-face{
    font-family: Futura;
    src: url(futura.ttf); /* Ensure this file exists */
}
@font-face{
    font-family: FuturaLight;
    src: url(futura1.ttf); /* Ensure this file exists */
}
body {
    font-family: Arial, sans-serif; /* Fallback font */
}
a:link{
    color: black;
    font-size: 20px;
    font-family: FuturaLight;
    padding-right: 20px;
    text-decoration: none;
}
a:hover{
    color:#e5753c;
}
#addst{
    padding: 20px 0px 30px 0px;
    font-family:Futura;
    font-size:30px;
}
#addfrm{
    background-color:  #f9fafd;
    border: 2.5px solid #8c756a;
    border-radius: 25px;
    width: 50%;
    margin: 20px auto; /* Center the form container */
    padding: 20px;
}
#frmprod{
    font-family: FuturaLight;
    font-size: 15px;
}
.form-group {
    margin-bottom: 15px;
}
.form-control { /* General styling for inputs */
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    box-sizing: border-box; /* Include padding in element's total width and height */
    border: 2.5px solid  #8c756a;
    border-radius: 25px;
    background-color: #ccc;
}
#txtbrand, #txtmodel, #txtpart, #txtprice, #txtstock, #txtsupp, #txtref { /* Specific overrides if needed */
    /* Add any specific styles for these inputs if different from .form-control */
}

#btnsave, #btncancel {
    padding: 10px 20px;
    font-family: FuturaLight;
    font-size: 15px;
    border: 0px;
    border-radius: 100px;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
}
#btnsave{
    background-color: #0292b7;
    color: #f9fafd;
}
#btncancel{
    background-color: #d22b2b;
    color: #f9fafd;
}
#btnsave:hover{
    background-color: #99dfec;
    color:black;
}
#btncancel:hover{
    background-color: #ff7f7f;
    color: black;
}
</style>

<div class="container my-3" id="addfrm"> <div class="row">
        <div class="col p-3">
            <div class="container-fluid" id="editst">
                <center>
                    <label> UPDATE STOCKS DETAILS </label>
                </center>
            </div>
            <form id="frmprod" method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="txtid" value="<?php echo htmlspecialchars($row['id'] ?? ''); ?>" />
                <div class="form-group">
                    <label for="txtsupp">Supplier Name</label>
                    <input type="text" class="form-control" id="txtsupp" name="txtsupp" required>
                </div>
                <div class="form-group">
                    <label for="txtref">Reference Number</label>
                    <input type="text" class="form-control" id="txtref" name="txtref" required>
                </div>
                <div class="form-group">
                    <label for="txtstock">Stock</label>
                    <input type="number" min="0" class="form-control" id="txtstock" name="txtstock" value="<?php echo htmlspecialchars($row['stock'] ?? '0'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="payment_proof">Upload Supplier Receipt</label>
                    <input type="file" id="payment_proof" name="payment_proof" accept="image/*" required>
                </div>
                <div>
                    <center>
                        <button type="submit" class="btn m-3" id="btnsave">UPDATE STOCK</button>
                        <button type="button" class="btn m-3" id="btncancel">CANCEL</button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $("#btncancel").click(function(){
        document.location = "./?page=deliveries";
    });
});
</script>
