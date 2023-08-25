<?php session_start();
include "../connect.php";

$userid = $_POST['id'];


$sql = "SELECT * FROM services_tbl join category_tbl on services_tbl.category_idfk = category_tbl.category_id where services_id =".$userid;
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) )
{
	

	?>

	  <input type="hidden" name="services_id[]" style="width: 7%;" id="" value="<?php echo $row['services_id']; ?>">
	  <input type="hidden" name="new[]" style="width: 7%;" id="" value="0">

		<div class="col-md-3 mt-3">
			<label>QTY:</label>
			<input type="number" style="width: 35%; margin-left: 5px;" name="qty[]" class="qty" min="0" max="99" onkeypress="if(this.value.length == 2) return false;" value="0" onchange="StockChange2('<?php echo $row['services_id']; ?>')" id="Quantid_<?php echo $row['services_id']; ?>">
			
		</div>
			<div class="col-md-4 mt-3">
		   <label>Price:</label>
			<input type="text" style="width: 35%;" name="pricess[]" id="pricedd_<?php echo $row['services_id']; ?>" value="<?php echo  $row['services_price'] ?>" readonly>
			
		</div>
			<div class="col-md-3 mt-3">
			<label>Amount:</label>
				<input type="text" name="" class="" style="background-color: transparent; width: 50%; border: none;" id="priceIDd2<?php echo $row['services_id']; ?>"  value="0" readonly>
				
			
		</div> 
		<div class="col-md-3 mt-3">
			

				<input type="hidden" name="amount[]" class="price" style="background-color: transparent; width: 25%;border: none;" id="priceIDddd<?php echo $row['services_id']; ?>"  value="0" readonly>
		</div>
		

	  

	



	

	<?php
}
?>

<script type="text/javascript">

	function StockChange2(pid) {
  var quantity2 = document.getElementById("Quantid_" + pid).value;
  var pricePro2 = document.getElementById("pricedd_" + pid).value;

  var totalPrice2 = quantity2 * pricePro2;
   var totalPrice3 = quantity2 * pricePro2;

 console.log(totalPrice2);
  document.getElementById("priceIDddd" + pid).value = totalPrice2;
  totalPrice2 = totalPrice2.toLocaleString(undefined, {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  });

   console.log(totalPrice3);
  document.getElementById("priceIDd2" + pid).value = "₱" + totalPrice2;

  var totalAmount2 = document.getElementById("totalAmountInput2").value;






  var totalSum = parseFloat(totalPrice3) + parseFloat(totalAmount2);


 var formattedTotal = totalSum.toLocaleString(undefined, {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  });

  document.getElementById("totalAmountInput2").value = totalSum;


  
calculateTotal();

console.log(totalSum);
   
  
}
</script>