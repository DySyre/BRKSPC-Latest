<?php session_start();
include "../connect.php";

$ordernum = $_POST['idd'];
$amount = $_POST['amount'];

$amountTotal = number_format($amount,2);

?>

<div class="row">
	<form id="paymentForm">
		
	
  <div class="col-md-12">

    	<label>Total Amount:</label>

    <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">PHP</span>
  <input type="text" class="form-control" value="<?php echo $amountTotal; ?>" aria-label="Username" aria-describedby="basic-addon1" id="TotalAmount" readonly>
</div>
 
    
  </div>
   <div class="col-md-12">
   <input type="hidden" name="ordNumberId" value="<?php echo $ordernum ?>">
 
    <label>Payment:</label>
     <div class="input-group mb-3">
	  <span class="input-group-text" id="basic-addon1">PHP</span>
	  <input type="text" class="form-control" onkeyup="payment()"  aria-label="Username" aria-describedby="basic-addon1" id="payments" required >
	</div>
  </div>

   <div class="col-md-12">
     <label>Change:</label>
     <div class="input-group mb-3">
	  <span class="input-group-text" id="basic-addon1">PHP</span>
	  <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" id="changeBal" readonly>
	</div>
 
   
  </div>

  	<div class="d-flex justify-content-end">
  <div>
  	 <a href="javascript:void();" class="btn btn-sm  text-white"data-bs-dismiss="modal" style="border: none; background-color: grey;">CLOSE</a>

    <a href="javascript:void();" data-id="<?php echo $ordernum ?>"  class="btn btn-sm btnProceed text-white"  style="border: none; background-color: blue;"id="btnPro"> PROCEED</a>
  </div>
</div>

  </form>
</div>

<script type="text/javascript">
	document.getElementById("btnPro").disabled = true;
  function payment() {
  var tAmount = parseFloat(document.getElementById("TotalAmount").value.replace(/,/g, ''));
    var payment = parseInt(document.getElementById("payments").value);

    console.log(tAmount);
    console.log(payment);
    var balance = payment - tAmount;

    console.log(balance);


    if(balance < 0 )
    {
    	document.getElementById("btnPro").disabled = true;
    }
    else
    {
    	document.getElementById("btnPro").disabled = false;

    }
    var formattedTotal = balance.toLocaleString(undefined, {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  });
    document.getElementById("changeBal").value = formattedTotal;


  }

$('#paymentForm').on('click', '.btnProceed', function(event) {
  var idd = $(this).data('id');
  var payments = parseInt($('#payments').val());
  var TotalAmount = parseInt($('#TotalAmount').val());
  var changeBal = parseInt($('#changeBal').val());
      

  $.ajax({
    url: "pos_payment_insert.php",
    method: "POST",
    data: {
      idd: idd,
      payment: payments,
      TotalAmounts: TotalAmount,
      changeBals: changeBal
    },
     success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
          
          
              swal({
                    title: "Success",
                    text: "Order Success",
                    icon: "success",
                    button: false,
                    timer: 1000 
                  
                    
                });

                 
                     setTimeout(function() {
                  window.location = 'pos_order_reciept.php';
              }, 1000);

            }
            else if (status == 'already') {
              
             swal("Error", " Already Exist", "error");


            }
            
            
             else if (status == 'false') {
              
              swal("Error", " Added Error", "error");
            }
          }
  });
});
</script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

