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
<div class="container my-3" id="addfrm">
    <div class="row">
        <div class="col p-3">
            <div class="container-fluid" id="addst">
                <center>
                    <label> NEW PRODUCT DETAILS </label>
                </center>
            </div>
            <form id="frmprod" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtbrand">Brand Name</label>
                    <input type="text" class="form-control" id="txtbrand" name="txtbrand">
                </div>
                <div class="form-group">
                    <label for="txtmodel">Model Name</label>
                    <input type="text" class="form-control" id="txtmodel" name="txtmodel">
                </div>
                <div class="form-group">
                    <label for="txtpart">Part Type</label>
                    <input type="text" class="form-control" id="txtpart" name="txtpart">
                </div>
                <div class="form-group">
                    <label for="txttype">Item Type</label>
                    <input type="text" class="form-control" id="txttype" name="txttype">
                </div>
                <div class="form-group">
                    <label for="txtprice">Price</label>
                    <input type="text" class="form-control" id="txtprice" name="txtprice">
                </div>
                <div class="form-group">
                    <label for="txtstock">Stock</label>
                    <input type="text" class="form-control" id="txtstock" name="txtstock">
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
                        <button type="button" class="btn m-3" id="btnsave">ADD PRODUCT</button>
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
		var form = $('form#frmprod')[0]; 
		var formData = new FormData(form);
		
		$.ajax({
			url: "modules/items_addreq.php",
			type: 'post',
			data: formData,
			contentType: false,
			processData: false,
			success: function(d){
				if(d=='success'){
					alert("Successfully Saved");
					document.location = "./?page=items";
				} else {
					alert(d);
				}
			},
		});
	});
        $('#file-upload').change(function() {
        var filename = $(this).val().split('\\').pop();
        $('.file-upload-text').text(filename ? filename : 'Choose File');
    });
});
</script>
