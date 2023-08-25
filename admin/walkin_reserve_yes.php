<?php session_start();
include "../connect.php";

$choice = $_POST['id'];



if($choice == '1')
{
	?>


<div class="col-md-6">
	<label>Payment For reservation</label>
     <div class="input-group">
	  <span class="input-group-text" id="basic-addon1">PHP</span>
	  <input type="number" class="form-control" onkeyup="payment()"  aria-label="Username" aria-describedby="basic-addon1" id="payments" required >
	</div>
 </div>

 <div class="col-md-4">
     <label>Change:</label>
     <div class="input-group">
	  <span class="input-group-text" id="basic-addon1">PHP</span>
	  <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" id="changeBal" readonly>
	</div>
</div>

<div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">Proceed</button>
  </div>

 <script type="text/javascript">
 	function payment() {
    var payment = parseInt(document.getElementById("payments").value);
    console.log(payment);
    var balance = payment - 50;

    console.log(balance);
    var formattedTotal = balance.toLocaleString(undefined, {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  });
    document.getElementById("changeBal").value = formattedTotal;


  }
 </script>
<?php

}
//else
else
{
	?>
	<div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">Proceed</button>
  </div>
	<?php

}
//end else

