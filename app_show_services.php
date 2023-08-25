<?php session_start();
include "../connect.php";

$userid = $_POST['id'];
$orderNumId = $_POST['orderNumId'];



$sql = "SELECT * FROM `category_tbl` JOIN services_tbl ON category_tbl.category_id = services_tbl.services_id where services_id =".$userid;
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) )
{
	$item_id = $row['services_id'];
	$itemName = $row['services_name'];
	$item_selling_price = $row['services_price'];

	$sql2 = "SELECT * FROM `pos_order_list_tbl` WHERE pos_order_list_itemidfk = '$item_id'";
	$result2 = mysqli_query($con,$sql2);

	if(mysqli_num_rows($result2) == true)
	{
		?>
		<style>
      .responsive-th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }                      
      </style>

      <div class="card-body" style="height: 100%;">
      
            <div class="table-responsive" style="height: 100%;">
            	<form id="MyForm">
            			<input type="hidden" name="" id="ordernumIdd" value="<?php echo $orderNumId ?>">
              <table id="tabledataSale" class="table table dataTables_wrapper" style="height: 100%;">
                <thead>
                  <th>Item</th>
                  <th>Stock</th>
                  <th>QTY</th>
                  <th>Price</th>
                  <th>Amount</th>   
                  <th></th>                                    
                </thead>
                  
                  	<?php 
                  	$sql1 = "SELECT * FROM `pos_order_list_tbl` WHERE pos_order_list_visble = '1'";
					$result1 = mysqli_query($con,$sql1);
					while( $row1 = mysqli_fetch_array($result1) )
					{

						?>
						<tbody>
						 <td><?php echo $row1['pos_order_list_itemName']?></td>
						 
						
						 <td><input type="number" style="width: 90%; border: none;" name="stockName[]" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?php echo $row1['pos_order_list_itmstock']?>"  id="Stock_<?php echo $row1['pos_order_list_id']; ?>" readonly></td>

						 <td><input type="number" style="width: 60%;"  name="qty[]" class="qty" min="1" value="1" onchange="StockChange2('<?php echo $row1['pos_order_list_id']; ?>')" id="Quantity_<?php echo $row1['pos_order_list_id']; ?>"></td>

						 <td><input type="number" style="width: 100%; border: none;" name="stockName[]" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?php echo $row1['pos_order_list_itemprice']?>"  id="Priced_<?php echo $row1['pos_order_list_id']; ?>" readonly></td>
						 <td><input type="text" name="amount[]" class="price" style="background-color: transparent; width: 80%; border: none;" id="priceIDdd<?php echo $row1['pos_order_list_id']; ?>"  value="<?php echo $row1['pos_order_list_itemprice']; ?>" readonly></td>
						
						 <td><a href="javascript:void();" data-id="<?php echo $row1['pos_order_list_id']; ?>"  class="btn btn-sm btnAdd text-white"  style="border: none; background-color: #3D1A5A;"> Add</a></td>
						<td><a href="javascript:void();" data-id="<?php echo $row1['pos_order_list_id']; ?>"  class="btn btn-sm btnDel text-white"  style="border: none; background-color: red;"> Del</a></td>

						 </tbody>



						<?php

					}




                  	?>
                
                
              </table>  
          </form>
            </div>
          </div>
          <script type="text/javascript">

          	function StockChange2(pid) {
          	  var quantity = parseInt(document.getElementById("Quantity_" + pid).value);
          	  var pricePro = parseInt(document.getElementById("Priced_" + pid).value);
          	  var stockPro = parseInt(document.getElementById("Stock_" + pid).value);


			console.log(quantity);
			console.log(stockPro);


			 

			  if(quantity > stockPro)
			  {
			  	alert("out ouf stock");
			   document.getElementById("Quantity_" + pid).value = '1';


			  }
			  else
			  {
			  	 var totalPrice = quantity * pricePro;
			  	  console.log(totalPrice);

				  	  document.getElementById("priceIDdd" + pid).value = totalPrice;
				  totalPrice = totalPrice.toLocaleString(undefined, {
				    minimumFractionDigits: 2,
				    maximumFractionDigits: 2
				  });
				    // document.getElementById("priceIDd" + pid).value = "₱" + totalPrice;
			  }
 
			}

	$('#MyForm').on('click', '.btnAdd', function(event) {
  var idd = $(this).data('id');
  var quantity = parseInt($('#Quantity_' + idd).val());
   var ordernumId = $('#ordernumIdd').val();

  $.ajax({
    url: "pos_insert_orderlist.php",
    method: "POST",
    data: {
      idd: idd,
      quantity: quantity,
      ordernumIdd: ordernumId
    },
    success: function(data) {
      // Remove the clicked row from the table
    	$("#ShowPruchases").html(data);
      $(event.target).closest('tr').remove();
    }
  });
});
	$('#MyForm').on('click', '.btnDel', function(event) {
  var idd = $(this).data('id');

  $.ajax({
    url: "pos_del_orderlist.php",
    method: "POST",
    data: {
      idd: idd
    },
    success: function(data) {
      // Remove the clicked row from the table
      $(event.target).closest('tr').remove();
    }
  });
});


          	
          </script>

		<?php
		
	}
	else
	{ //start else
		$sql3 = "INSERT INTO `pos_order_list_tbl`(`pos_order_list_itemidfk`, `pos_order_list_itemName`, `pos_order_list_itemprice`,`pos_order_list_ordernum`,`pos_order_list_itmstock`) VALUES ('$item_id','$itemName','$item_selling_price','$orderNumId','$item_stock')";
	$query3= mysqli_query($con,$sql3);
	$lastId3 = mysqli_insert_id($con);

	?>
	 <style>
      .responsive-th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }                      
      </style>
          <div class="card-body" style="height: 100%;">
      	

            <div class="table-responsive" style="height: 100%;">
              <form id="MyForm">
              	<input type="hidden" name="" id="ordernumIdd" value="<?php echo $orderNumId ?>">
              <table id="tabledataSale" class="table table dataTables_wrapper" style="height: 100%;">
                <thead>
                  <th>Item</th>
                  <th>Stock</th>
                  <th>QTY</th>
                  <th>Price</th>
                  <th>Amount</th>   
                  <th></th>                                    
                </thead>
                  
                  	<?php 
                  	$sql1 = "SELECT * FROM `pos_order_list_tbl` WHERE pos_order_list_visble = '1'";
					$result1 = mysqli_query($con,$sql1);
					while( $row1 = mysqli_fetch_array($result1) )
					{

						?>
						<tbody>
						 <td><?php echo $row1['pos_order_list_itemName']?></td>
						
						  <td><input type="number" style="width: 90%; border: none;" name="stockName[]" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?php echo $row1['pos_order_list_itmstock']?>"  id="Stock_<?php echo $row1['pos_order_list_id']; ?>" readonly></td>

						 <td><input type="number" style="width: 60%;"  name="qty[]" class="qty" min="1" value="1" onchange="StockChange2('<?php echo $row1['pos_order_list_id']; ?>')" id="Quantity_<?php echo $row1['pos_order_list_id']; ?>"></td>

						 <td><input type="number" style="width: 100%; border: none;" name="stockName[]" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?php echo $row1['pos_order_list_itemprice']?>"  id="Priced_<?php echo $row1['pos_order_list_id']; ?>" readonly></td>
						 <td><input type="text" name="amount[]" class="price" style="background-color: transparent; width: 80%; border: none;" id="priceIDdd<?php echo $row1['pos_order_list_id']; ?>"  value="<?php echo $row1['pos_order_list_itemprice']; ?>" readonly></td>
						
						 <td><a href="javascript:void();" data-id="<?php echo $row1['pos_order_list_id']; ?>"  class="btn btn-sm btnAdd text-white"  style="border: none; background-color: #3D1A5A;"> Add</a></td>
						<td><a href="javascript:void();" data-id="<?php echo $row1['pos_order_list_id']; ?>"  class="btn btn-sm btnDel text-white"  style="border: none; background-color: red;"> Del</a></td>

						 </tbody>



						<?php

					}




                  	?>
                
                
              </table>  
          </form>
            </div>
          </div>
           <script type="text/javascript">

          	function StockChange2(pid) {
          	  var quantity = parseInt(document.getElementById("Quantity_" + pid).value);
          	  var pricePro = parseInt(document.getElementById("Priced_" + pid).value);
          	  var stockPro = parseInt(document.getElementById("Stock_" + pid).value);


			console.log(quantity);
			console.log(stockPro);


			 

			  if(quantity > stockPro)
			  {
			  	alert("out ouf stock");
			   document.getElementById("Quantity_" + pid).value = '1';


			  }
			  else
			  {
			  	 var totalPrice = quantity * pricePro;
			  	  console.log(totalPrice);

				  	  document.getElementById("priceIDdd" + pid).value = totalPrice;
				  totalPrice = totalPrice.toLocaleString(undefined, {
				    minimumFractionDigits: 2,
				    maximumFractionDigits: 2
				  });
				    // document.getElementById("priceIDd" + pid).value = "₱" + totalPrice;
			  }
 
			}

	$('#MyForm').on('click', '.btnAdd', function(event) {
  var idd = $(this).data('id');
  var quantity = parseInt($('#Quantity_' + idd).val());
   var ordernumId = $('#ordernumIdd').val();



  $.ajax({
    url: "pos_insert_orderlist.php",
    method: "POST",
    data: {
      idd: idd,
      quantity: quantity,
      ordernumIdd: ordernumId
    },
    success: function(data) {
      // Remove the clicked row from the table
    	$("#ShowPruchases").html(data);
      $(event.target).closest('tr').remove();
    }
  });
});
	$('#MyForm').on('click', '.btnDel', function(event) {
  var idd = $(this).data('id');

  $.ajax({
    url: "pos_del_orderlist.php",
    method: "POST",
    data: {
      idd: idd
    },
    success: function(data) {
      // Remove the clicked row from the table
      $(event.target).closest('tr').remove();
    }
  });
});




          	
          </script>
          <?php

	} // end else


}