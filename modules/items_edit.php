<style>
@font-face{
    font-family: Futura;
    src: url(futura.ttf);
}
@font-face{
    font-family: FuturaLight;
    src: url(futura1.ttf);
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
    background-color:  #f9fafd;
    border: 2.5px solid #8c756a;
    border-radius: 25px;
    width: 50%;
}
#frmprod{
    font-family: FuturaLight;
    font-size: 15px;
}
#txtbrand, #txtmodel, #txtpart, #txtprice, #txtstock, #txttype{
    border: 2.5px solid  #8c756a;
    border-radius: 25px;
    background-color: #ccc;
}
#btnsave{
    background-color: #0292b7;
    color: #f9fafd;
    font-family: FuturaLight;
    font-size: 15px;
    border: 0px;
    border-radius: 100px;
}
#btncancel{
    background-color: #d22b2b;
    color: #f9fafd;
    font-family: FuturaLight;
    font-size: 15px;
    border: 0px;
    border-radius: 100px;
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
<?php
$id = 0;
if(isset($_GET['id'])){
	$id = $_GET['id'];
}
include("dbconi.php");
$query = "SELECT * FROM bikes WHERE id= '".mysqli_real_escape_string($dbc, $id)."'";
$result = mysqli_query($dbc, $query);
if(mysqli_num_rows($result)>0){
	$row = mysqli_fetch_array($result);
?>
<div class="container my-3" id="editfrm">
    <div class="row">
        <div class="col p-3">
        <div class="container-fluid" id="editst">
                <center>
                    <label> UPDATE PRODUCTS DETAILS </label>
                </center>
            </div>
            <form id="frmprod" enctype="multipart/form-data">
                <input type="hidden" name="txtid" value="<?php echo $row['id']; ?>" />
                <div class="form-group">
                    <label for="txtbrand">Brand Name</label>
                    <input type="text" class="form-control" id="txtbrand" name="txtbrand" value="<?php echo $row['brand']; ?>">
                </div>
                <div class="form-group">
                    <label for="txtmodel">Model Name</label>
                    <input type="text" class="form-control" id="txtmodel" name="txtmodel" value="<?php echo $row['model']; ?>">
                </div>
                <div class="form-group">
                    <label for="txtpart">Part Type</label>
                    <input type="text" class="form-control" id="txtpart" name="txtpart" value="<?php echo $row['part']; ?>">
                </div>
                <div class="form-group">
                    <label for="txttype">Item Type</label>
                    <input type="text" class="form-control" id="txttype" name="txttype" value="<?php echo $row['type']; ?>">
                </div>
                <div class="form-group">
                    <label for="txtprice">Price</label>
                    <input type="text" class="form-control" id="txtprice" name="txtprice" value="<?php echo $row['price']; ?>">
                </div>
                <div class="file-upload-wrapper">
                        <span class="file-upload-text">Choose File</span>
                        <i class="fa fa-user-circle"></i>
                        <input type="file" id="file-upload" name="profile" accept="image/*" />
                    </div>
                <div>
                    <center>
                        <button type="button" class="btn m-3" id="btnsave">UPDATE PRODUCT</button>
                        <button type="button" class="btn m-3" id="btncancel">CANCEL</button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $("#btncancel").click(function(){
        document.location = "./?page=items";
    });
    
    $("#btnsave").click(function(){
        var formData = new FormData($("form#frmprod")[0]);
        $.ajax({
            url: "modules/items_editreq.php",
            type: "post",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                if(response == 'success'){
                    alert("Item Successfully Updated");
                    document.location = "./?page=items";
                } else {
                    alert(response);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
                alert("An error occurred while updating the account. Please check the console for details.");
            }
        });
    });

    $('#file-upload').change(function() {
        var filename = $(this).val().split('\\').pop();
        $('.file-upload-text').text(filename ? filename : 'Choose File');
    });
});
</script>
<?php
}
?>

