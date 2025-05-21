<style>
        @font-face{
            font-family: Futura;
            src: url(uploads/futura.ttf);
        }
        @font-face{
            font-family: FuturaLight;
            src: url(uploads/futura1.ttf);
        }
		#searchS{
			border: 1px solid #8c756a;
			border-radius: 100px;
			font-family: FuturaLight;
            margin-bottom: 10px;
		}

        #btnsearchprod{
			background-color: #0292b7;
			color: #f9fafd;
			font-family: FuturaLight;
			border: 0px;
			border-radius: 100px;
		}

		#btnsearchprod:hover{
			opacity:0.75;
		}

		#btnaddS{
			font-family: FuturaLight;
			border: 0px;
			border-radius: 100px;
			text-transform:capitalize;
		}

        #eventtitle{
            font-family:Futura;
            font-size:30px;
			margin-top: 20px;
            padding-bottom: 10px;
        }
		body {
    		display: flex;
    		flex-direction: column;
    		min-height: 100vh;
    		background-color: #f8f9fa;
		}
</style>

<div class="py-3">
</div>
<div class="container">
	<div class="row">
    	<div class="col p-3">
        	<form id="frmsearchprod">
				<table class="table-borderless w-100">
					<tr>
						<td><input type="text" class="form-control" name="txtsearch" placeholder="Search Products" id="searchS" /></td>
					</tr>
				</table>
            </form>
        	<div id="contS"></div>
			<br><br>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    LoadProduct(1); 

    function LoadProduct(pageNum){
        $.post("modules/deliveries_list.php", {
            pagenum: pageNum,
            txtsearch: $("input[name='txtsearch']").val()
        }, function(productData) {
            $("#contS").html(productData);
            history.pushState(null, '', '?page=deliveries&pagenum=' + pageNum + '&txtsearch=' + encodeURIComponent($("input[name='txtsearch']").val()));
        }).fail(function() {
            console.error("Error loading product data.");
        });
    }
	
	$(document).on('click', '.pagination .page-link', function(e) {
        e.preventDefault();
        var pageNum = $(this).data('pagenum'); 
        LoadProduct(pageNum);
    });

    $("input[name='txtsearch']").on('input', function() {
        LoadProduct(1);
    });

	$("#btnsearchprod").click(function(event){
		event.preventDefault();
		LoadProduct();
	});


	$("#btnaddS").click(function(){
		document.location = "./?page=stocks";
	});
});
</script>