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

        #btnsearchpay{
			background-color: #0292b7;
			color: #f9fafd;
			font-family: FuturaLight;
			border: 0px;
			border-radius: 100px;
		}

		#btnsearchpay:hover{
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
        	<form id="frmsearchpay">
				<table class="table-borderless w-100">
					<tr>
						<td><input type="text" class="form-control" name="txtsearch" placeholder="Search Transactions" id="searchS" /></td>
                        <td width="125"><button type="button" class="btn btn-success" id="btnaddS">Add Deliveries</button></td>
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
    LoadPayment(1); 

    function LoadPayment(pageNum){
        $.post("modules/payment_list.php", {
            pagenum: pageNum,
            txtsearch: $("input[name='txtsearch']").val()
        }, function(paymentData) {
            $("#contS").html(paymentData);
            history.pushState(null, '', '?page=payment&pagenum=' + pageNum + '&txtsearch=' + encodeURIComponent($("input[name='txtsearch']").val()));
        }).fail(function() {
            console.error("Error loading transaction data.");
        });
    }
	
	$(document).on('click', '.pagination .page-link', function(e) {
        e.preventDefault();
        var pageNum = $(this).data('pagenum'); 
        LoadPayment(pageNum);
    });

    $("input[name='txtsearch']").on('input', function() {
        LoadPayment(1);
    });

	$("#btnsearchpay").click(function(event){
		event.preventDefault();
		LoadPayment();
	});

    $("#btnaddS").click(function(){
		document.location = "./?page=deliveries";
	});
});
</script>