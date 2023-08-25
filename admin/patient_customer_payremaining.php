<?php session_start();
 include '../connect.php';
 
$idBill = $_POST['idx'];
  $sumRem = 0;

$sql3 = "SELECT * FROM `appointment_bill_tbl` WHERE appointment_bill_id = '$idBill'";

$totalQuery3 = mysqli_query($con,$sql3);
$row3 = mysqli_fetch_assoc($totalQuery3);

 $appointment_bill_total = $row3['appointment_bill_total'];
 $appointment_bill_payment = $row3['appointment_bill_payment'];

  $sumRem = $appointment_bill_total - $appointment_bill_payment;
$amountTotal = number_format($sumRem,2);
?>


<div class="row">
	<form id="paymentForm">
		
	
  <div class="col-md-12">

    	<label>Remaining Amount:</label>
   <input type="hidden" name="ordNumberId" value="<?php echo $idBill ?>">

    <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">PHP</span>
  <input type="text" class="form-control" value="<?php echo $amountTotal; ?>" aria-label="Username" aria-describedby="basic-addon1" id="TotalAmount" readonly>
</div>
 
    
  </div>
   <div class="col-md-12"> 
    <label>Enter Amount:</label>
     <div class="input-group mb-3">
	  <span class="input-group-text" id="basic-addon1">PHP</span>
	  <input type="text" class="form-control" onkeyup="payment()"  aria-label="Username" aria-describedby="basic-addon1" id="payments" required >
	</div>
  </div>

   <div class="col-md-12">
     <label>Change Amount:</label>
     <div class="input-group mb-3">
	  <span class="input-group-text" id="basic-addon1">PHP</span>
	  <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" id="changeBal" readonly>
	</div>
 
   
  </div>

  	<div class="d-flex justify-content-end">
  <div>
  	 <a href="javascript:void();" class="btn btn-sm  text-white"data-bs-dismiss="modal" style="border: none; background-color: grey;">CLOSE</a>

    <a href="javascript:void();" data-id="<?php echo $idBill ?>"  class="btn btn-sm btnProceed text-white"  style="border: none; background-color: blue;"id="btnPro"> Pay</a>
  </div>
</div>

  </form>
</div>
<script type="text/javascript">

  function payment() {
  var tAmount = parseFloat(document.getElementById("TotalAmount").value.replace(/,/g, ''));
    var payment = parseInt(document.getElementById("payments").value);

    console.log(tAmount);
    console.log(payment);
    var balance = payment - tAmount;

    console.log(balance);


    
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
      
      console.log(payments);

  $.ajax({
    url: "patient_customer_payremaining_insert.php",
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
             $('#RegisPayModal').modal('hide');
          
              swal({
                    title: "Success",
                    text: "Payment Success",
                    icon: "success",
                    button: false,
                    timer: 1000 
                  
                    
                });

                 
              //        setTimeout(function() {
                 
              // }, 1000);

            }
            else if (status == 'already') {
              
             swal("Error", " Already Exist", "error");


            }
            else if (status == 'checkInv') {
              
             swal("Error", " error Please Refresh the page", "error");


            }
            
            
             else if (status == 'false') {
              
              swal("Error", " Added Error", "error");
            }
          }
  });
});
</script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>