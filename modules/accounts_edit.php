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
#txtbrand, #txtmodel, #txtpart, #txtprice, #txtstock{
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
.form-group label {
    font-family: FuturaLight;
    font-size: 15px;
    color: #333;
    margin-bottom: 5px;
    display: block;
}

.form-control {
    border: 2.5px solid #8c756a;
    border-radius: 25px;
    background-color: #ccc;
    padding: 10px;
    font-size: 15px;
    width: 100%;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: #0292b7;
    box-shadow: 0 0 5px rgba(2, 146, 183, 0.5);
}

#file-upload {
    opacity: 0;
    position: absolute;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.file-upload-wrapper {
    position: relative;
    display: inline-flex;
    align-items: center;
    background-color: #fff;
    border: 2.5px solid #8c756a;
    border-radius: 25px;
    padding: 8px 16px;
    text-align: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: fit-content;
}

.file-upload-wrapper:hover {
    background-color: #f8f8f8;
}

.file-upload-text {
    font-size: 15px;
    color: #333;
    margin-right: 8px;
    font-family: FuturaLight;
}

.file-upload-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background-color: #0292b7;
    color: #fff;
    font-size: 16px;
}
</style>
<?php
$id = 0;
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
include("dbconi.php");
$query = "SELECT * FROM users WHERE id= '".mysqli_real_escape_string($dbc, $id)."'";
$result = mysqli_query($dbc, $query);
if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
?>
<div class="container my-3" id="editfrm">
    <div class="row">
        <div class="col p-3">
        <div class="container-fluid" id="editst">
                <center>
                    <label> UPDATE ACCOUNT DETAILS </label>
                </center>
            </div>
            <form id="frmprod" enctype="multipart/form-data">
                <input type="hidden" name="txtid" value="<?php echo $row['id']; ?>" />
                <div class="form-group">
                    <label for="txtuser">User Name</label>
                    <input type="text" class="form-control" id="txtuser" name="txtuser" value="<?php echo $row['username']; ?>">
                </div>
                <div class="form-group">
                    <label for="txtpass">Password</label>
                    <input type="password" class="form-control" id="txtpass" name="txtpass" value="<?php echo $row['password']; ?>">
                </div>
                <div class="form-group">
                    <label for="txtfull">Full Name</label>
                    <input type="text" class="form-control" id="txtfull" name="txtfull" value="<?php echo $row['fullname']; ?>">
                </div>
                <div class="form-group">
                    <label for="txtaddress">Address</label>
                    <input type="text" class="form-control" id="txtaddress" name="txtaddress" value="<?php echo $row['address']; ?>">
                </div>
                <div class="form-group">
                    <label for="imageUpload">Profile Image</label>
                    <div class="file-upload-wrapper">
                        <span class="file-upload-text">Choose File</span>
                        <i class="fa fa-user-circle"></i>
                        <input type="file" id="file-upload" name="profile" accept="image/*" />
                    </div>
                </div>
                <div>
                    <center>
                        <button type="button" class="btn m-3" id="btnsave">UPDATE ACCOUNT</button>
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
        document.location = "./?page=accounts";
    });

    $("#btnsave").click(function(){
        var formData = new FormData($("form#frmprod")[0]);
        $.ajax({
            url: "modules/accounts_editreq.php",
            type: "post",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                if(response == 'success'){
                    alert("Account Successfully Updated");
                    document.location = "./?page=accounts";
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