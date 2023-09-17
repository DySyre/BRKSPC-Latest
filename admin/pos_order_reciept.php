<?php session_start();
$ordernum = $_SESSION['ordernumSes'];
include "../connect.php";

	?>
	<!DOCTYPE html>
	<html>
 <head>

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>BARKSPACE</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
          <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

              <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    </head>
	<body>
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
      <div class="card-body" >
            <div class="table-responsive">
            	<form id="MyForm2">
              <table id="tabledataStaff" class="table table dataTables_wrapper" >
                <thead>
                  <th class="responsive-th">Item</th>
                  <th>QTY</th>
                  <th>Price</th>
                  <th>Amount</th>   
                  <th></th>                                    
                </thead>
                 
                  	<?php 

                  	$sql1 = "SELECT * FROM `pos_purchase_his_tbl` WHERE pos_purchase_hisordrnum = '$ordernum' AND isProceed = '1'";
					$result1 = mysqli_query($con,$sql1);

					$sql2 = "SELECT sum(pos_purchase_hisitemtotalAmt) as sumAmount FROM `pos_purchase_his_tbl` WHERE pos_purchase_hisordrnum = '$ordernum' AND isProceed = '1'";
					$result2 = mysqli_query($con,$sql2);
					$row2 = mysqli_fetch_array($result2);
					$sql3 = "SELECT count(pos_purchase_his_id) as sumItems FROM `pos_purchase_his_tbl` WHERE pos_purchase_hisordrnum = '$ordernum' AND isProceed = '1'";
					$result3 = mysqli_query($con,$sql3);
					$row3 = mysqli_fetch_array($result3);
					$sql4 = "SELECT sum(pos_purchase_hisitemqty) as sumQty FROM `pos_purchase_his_tbl` WHERE pos_purchase_hisordrnum = '$ordernum' AND isProceed = '1'";
					$result4 = mysqli_query($con,$sql4);
					$row4 = mysqli_fetch_array($result4);

            $sql5 = "SELECT * FROM `pos_purchase_his_tbl` WHERE pos_purchase_hisordrnum = '$ordernum' limit 1 ";
          $result5 = mysqli_query($con,$sql5);
          $row5 = mysqli_fetch_array($result5);

          $idUser =  $row5['pos_purchase_his_enduser'];



					while($row1 = mysqli_fetch_array($result1))
					{

						?>
						 <tbody>
						 <td><?php echo $row1['pos_purchase_hisitemname']?></td>
						 <td><?php echo $row1['pos_purchase_hisitemqty']?></td>
						 <td>₱<?php echo $row1['pos_purchase_hisitemprice']?></td>
						 <td>₱<?php echo $row1['pos_purchase_hisitemtotalAmt']?></td>

						 </tbody>
						  
 

						<?php

					}
                  	?>
                  	
                  	 <div class="row" id="printDiv">
  <div class="col-md-10">
    <label style="font-weight: bold;">Item's:</label>
    <input style="width: 15%; border: none;" type="text" name="" id="itemId" value="<?php echo $row3['sumItems'] ?>" readonly>
    <br>
    <label style="font-weight: bold;">Qty's:</label>
    <input style="width: 15%; border: none;" type="text" name="" id="sumQtyId" value="<?php echo $row4['sumQty'] ?>" readonly>
    <br>
    <label style="font-weight: bold;">Total Amount: </label> ₱
    <input style="width: 20%; border: none;" type="text" name="" id="sumAmountId" value="<?php echo $row2['sumAmount'] ?>" readonly>
    
    
          


    <br>
    <?php 
    $CheckServId = "SELECT * FROM `staff_tbl`  WHERE staff_id = '$idUser'";
    $reCheckServId = mysqli_query($con, $CheckServId);
    $rowreCheckServId = mysqli_fetch_assoc($reCheckServId);
 

    ?>
    <label style="font-weight: bold;">By: </label>
    <input style="width: 20%; border: none;" type="text" name="" id="" value="<?php echo  $rowreCheckServId['staff_fname'] ?>" readonly>
    
  </div>
  
</div>           
                
              </table> 

          </form>
          <button onclick="printTable()" style="float: right; margin-right: 10px;"  class="btn btn-print no-print btn-primary"><i class="fa fa-print"></i>Print</button>
            </div>
          </div>
   <!-- modal-->

  
	
	</body>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    <script src="../js/script.js"></script>


       <script type="text/javascript">


  const fontSizeSelect = document.getElementById('font-size-select');
  const table = document.getElementById('tabledataStaff');

  fontSizeSelect.addEventListener('change', () => {
    table.style.fontSize = fontSizeSelect.value;
  });

  function printTable() {
    var printContents = document.getElementById("tabledataStaff").outerHTML;
    printContents += document.getElementById("printDiv").outerHTML; // Add the HTML content of the div
    var originalContents = document.body.innerHTML;
    var popupWin = window.open('', '_blank', 'width=800,height=600');
    popupWin.document.open();
    popupWin.document.write('<html><head><title></title><style type="text/css">\
      th {\
        text-align: left;\
      }\
      body {\
        text-align: left;\
      }\
      h4{\
        margin-left: 100px;\
      }\
      h3{\
        margin-left: 50px;\
      }\
      @media print {\
        table {\
          width: 30%;\
          border-collapse: collapse;\
        }\
        th, td {\
          word-break: break-all;\
          word-wrap: break-word;\
        }\
      }\
      </style></head><br><br><h3>Barkspace Pet Grooming</h3><h3>And Wellness Center</h3><h4>RECEIPT</h4><body>' + printContents + '</body></html>');
    popupWin.document.close();
    popupWin.focus();
    popupWin.print();
    popupWin.close();
    return false;
  }
</script>
	</html>
	

      
 



