<head>
    <meta name="google" content="notranslate" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> OLIs CRIB </title>

    <link type="text/css" rel="stylesheet" href="style.css"/>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery/jquery.form.js"></script>
    <script src="script.js"></script>
</head>
<body style="background-color: #f7ebdb;">
    <div class="container-fluid" id="logintitle">
        <center>
            <label style="padding: 50px 0px 30px 0px; font-family:Futura; font-size:30px;"> Register to start session </label>
        </center>
    </div>
    <div class="card mx-auto col-md-5 my-5 shadow">
        <div class="card-body">
            <h2 class="card-title">Register</h5>
            <form method="POST" id="frmregis">
                <div class="form-group">
                    <label for="txtusername">Username</label>
                    <input type="text" class="form-control" id="txtusername" name="txtusername" aria-describedby="emailHelp" placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label for="txtpassword">Password</label>
                    <input type="password" class="form-control" id="txtpassword" name="txtpassword" placeholder="Enter Password">
                </div>
                <div class="form-group">
                    <label for="txtfullname">Full Name</label>
                    <input type="text" class="form-control" id="txtfullname" name="txtfullname" placeholder="Enter Full Name">
                </div>
                <div class="form-group">
                    <label for="txtfullname">Address</label>
                    <input type="text" class="form-control" id="txtaddress" name="txtaddress" placeholder="Enter Address">
                </div>
                <button type="button" class="btn btn-primary" id="btnlogin">Login</button>
                <button type="submit" class="btn btn-warning" id="btnregis">Register</button>
                <button type="button" class="btn btn-secondary" id="btncancel">Cancel</button>
            </form>
        </div>
    </div>
<script>
$(document).ready(function(){
    $("#btnregis").click(function(){
        event.preventDefault();
        $.post("register_req.php",$("form#frmregis").serialize(),function(d){
            if(d=='Success!'){
                document.location.href = "../?page=home";
            } else {
                alert(d);
            }
        });
    });
    $("#btnlogin").click(function(){
		document.location = "./login.php";
	});
	$("#btncancel").click(function(){
		document.location.href = "../?page=home";
	});
});
</script>
</body>
