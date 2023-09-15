<?php session_start();
include "../connect.php";
$Enduser_id =  $_SESSION['Enduser_id'];
$idd = $_POST['idd'];
$quantity = $_POST['quantity'];
$ordernumIdd = $_POST['ordernumIdd'];
$toalAmount = 0;


$sql = "SELECT * FROM `pos_order_list_tbl` WHERE pos_order_list_id = '$idd'";
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) )
{
	
	$order_list_idfk = $row['pos_order_list_id'];
	$itemId =  $row['pos_order_list_itemidfk'];
	$price = $row['pos_order_list_itemprice'];
	$itemName = $row['pos_order_list_itemName'];
	

	$toalAmount = $quantity * $price;

	$sql2 = "INSERT INTO `pos_purchase_tbl`(`pos_purchase_itemidfk`, `pos_purchase_itemname`, `pos_purchase_itemprice`, `pos_purchase_itemqty`, `pos_purchase_itemtotalAmt`, `pos_purchase_ordrnum`,`pos_order_list_idfk`) VALUES ('$itemId','$itemName','$price','$quantity','$toalAmount','$ordernumIdd','$order_list_idfk')";

	 $query2= mysqli_query($con,$sql2);
         $lastId2 = mysqli_insert_id($con);


         $sql21 = "INSERT INTO `pos_purchase_his_tbl`(`pos_purchase_hisitemidfk`, `pos_purchase_hisitemname`, `pos_purchase_hisitemprice`, `pos_purchase_hisitemqty`, `pos_purchase_hisitemtotalAmt`, `pos_purchase_hisordrnum`,`pos_hisorder_list_idfk`,`lastid`,`pos_purchase_his_enduser`) VALUES ('$itemId','$itemName','$price','$quantity','$toalAmount','$ordernumIdd','$order_list_idfk','$lastId2','$Enduser_id')";

	 $query21= mysqli_query($con,$sql21);
        

	 $sql3 = "DELETE FROM `pos_order_list_tbl` WHERE  `pos_order_list_id` ='$idd'";

       
	$query3= mysqli_query($con,$sql3);
	
	?>
	<style>
      .responsive-th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    tbody{
    	   white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
   


      </style>

      <div class="card-body" style="height: 100%;">
            <div class="table-responsive" style="height: 100%;">
            	<form id="MyForm2">
              <table id="tabledataSale2" class="table table dataTables_wrapper" style="height: 100%;">
                <thead>
                  <th>Item</th>
                  <th>QTY</th>
                  <th>Price</th>
                  <th>Amount</th>
                  <th></th>                                    
                </thead>
                  
                  	<?php 
                  	$sql1 = "SELECT * FROM `pos_purchase_tbl`";
                    $sql1 = "SELECT *, (pos_purchase_itemprice - (pos_purchase_itemprice * pos_purchase_discount / 100)) as discounted_price FROM `pos_purchase_tbl`";

                    
					$result1 = mysqli_query($con,$sql1);

					$sql2 = "SELECT sum(`pos_purchase_itemtotalAmt`) as `sumAmount` FROM `pos_purchase_tbl`";
					$result2 = mysqli_query($con,$sql2);
					$row2 = mysqli_fetch_array($result2);
					$sql3 = "SELECT count(`pos_purchase_id`) as `sumItems` FROM `pos_purchase_tbl`";
					$result3 = mysqli_query($con,$sql3);
					$row3 = mysqli_fetch_array($result3);
					$sql4 = "SELECT sum(`pos_purchase_itemqty`) as `sumQty` FROM `pos_purchase_tbl`";
					$result4 = mysqli_query($con,$sql4);
					$row4 = mysqli_fetch_array($result4);
          

          
					while($row1 = mysqli_fetch_array($result1))
					{
    //          $discountedPrice = $row1['pos_purchase_itemprice'] - ($row1['pos_purchase_itemprice'] * $row1['pos_purchase_discount'] / 100);
    // $discountedAmount = $discountedPrice * $row1['pos_purchase_itemqty'];
						?>
						<tbody>
						 <td style="color: black; font-weight: bold; text-transform:capitalize; margin: 2%;"><?php echo $row1['pos_purchase_itemname']?></td>
					
						 <td><input style="width: 50%; background-color: transparent; border: none;" type="text" name="" id="itemqty_<?php echo $row1['pos_purchase_id']?>" value="<?php echo $row1['pos_purchase_itemqty']?>"readonly></td>
						
						  <td><input style="width: 90%; border: none;background-color: transparent;" type="text" name="" id="PriceD_<?php echo $row1['pos_purchase_id']?>" value="<?php echo $row1['pos_purchase_itemprice']?>"readonly></td>
						 <td><input style="width: 90%; border: none;background-color: transparent;" type="text" name="" id="itemAmont_<?php echo $row1['pos_purchase_id']?>" value="<?php echo $row1['pos_purchase_itemtotalAmt']?>"readonly></td>
             
            
          

						
					
						 <td><a href="javascript:void();" data-id="<?php echo $row1['pos_purchase_id']; ?>"  class="btn btn-sm btnDel2 text-white"  style="border: none; background-color: red;"> Del</a></td>

						 </tbody>
						  
 

						<?php

					}
                  	?>
                  	

                 

                
                
              </table>
     
              <hr>
              <div class="row" style="margin: 2%;">
  <div class="col-md-10">
    <label style="font-weight: bold;">Item's:</label>
    <input style="width: 10%; border: none; background-color: transparent; margin: 3%;" type="text" name="" id="itemId" value="<?php echo $row3['sumItems'] ?>pcs." readonly>
    <label style="font-weight: bold;">Qty's:</label>
    <input style="width: 5%; border: none; background-color: transparent;  margin: 3%;" type="text" name="" id="sumQtyId" value="<?php echo $row4['sumQty'] ?>x" readonly>
    <hr>
    <label style="font-weight: bold;">Total Amount: </label>₱
    <input style="margin: 10px; width: 20%; " type="text" name="" id="sumAmountId" value="<?php echo $row2['sumAmount'] ?>" readonly>
  </div>
</div>
              <hr>
              <div class="col-md-9">
    <div id="divv">
    	<a href="javascript:void();" data-id="<?php echo $ordernumIdd; ?>"  class="btn btn-sm btnPayment text-white btn-success"  style="width: 130%;border: none; background-color:; border: 10px; font-size: 1.3rem;">Checkout</a>
    </div>
  </div>
          </form>
            </div>
          </div>
          
   <!-- modal-->

    <div class="modal fade" id="memViewAppointmentModal" role="dialog">
  <div class="modal-dialog modal-l modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Payment</h4>
      </div>
      <div class="modal-body modalresponseViewAppointment">
        <!-- Modal body content goes here -->
      </div>
    </div>
  </div>
</div>

        <script type="text/javascript">


  $('#MyForm2').on('click', '.btnDel2', function(event) {
    var idd = $(this).data('id');

    var PriceD = parseInt($('#itemAmont_' + idd).val());
     var itemqty = parseInt($('#itemqty_' + idd).val());

     var totalqty = parseInt($('#sumQtyId').val());
      var amount = parseInt($('#sumAmountId').val());
      var totalItem = parseInt($('#itemId').val());
  


	sumTotalAmount = amount - PriceD;

	sumTotalqty = totalqty - itemqty;
	sumTotalitem = totalItem - 1;

    console.log(sumTotalAmount);
    document.getElementById("sumAmountId").value = sumTotalAmount;
    document.getElementById("sumQtyId").value = sumTotalqty;
    document.getElementById("itemId").value = sumTotalitem;


    $.ajax({
      url: "pos_del_summary.php",
      method: "POST",
      data: {
        idd: idd
      },
      success: function(data) {
        $(event.target).closest('tr').remove();
    
      }
    });
  });



  $('#MyForm2').on('click', '.btnPayment', function(event) {
    var idd = $(this).data('id');
    var amount = parseInt($('#sumAmountId').val());

    $.ajax({
      url: "pos_payment.php",
      method: "POST",
      data: {
        idd: idd,
        amount: amount
      },
      success: function(response) {
            $('.modalresponseViewAppointment').html(response); 
            $('#memViewAppointmentModal').modal('show');
        }
    });
  });



 


 
</script>




	<?php

}