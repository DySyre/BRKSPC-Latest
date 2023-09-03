<?php session_start();
 include '../connect.php';
 
$idBill = $_POST['idx'];
  $sumRem = 0;

$sql3 = "SELECT * FROM `pet_services_his_tbl` WHERE pet_services_his_id = '$idBill'";

$totalQuery3 = mysqli_query($con,$sql3);
$row3 = mysqli_fetch_assoc($totalQuery3);

?>


<div class="row">
  <form id="paymentForm">
    
  
   <div class="col-md-12"> 
  
     <div class="input-group mb-3">

      <style>
    /* Style the textarea element */
    textarea {
      width: 400px; /* You can adjust this value to set the desired width */
      height: 150px; /* You can adjust this value to set the desired height */
      resize: none; /* Prevent resizing of the textarea by the user */
      /* You can also set other CSS properties like font-size, padding, etc. here */
    }
  </style>
               
  

    <textarea id="payments"><?php echo $row3['history_coment']; ?></textarea>
  </div>
  </div>


    <div class="d-flex justify-content-end">
  <div>
     <a href="javascript:void();" class="btn btn-sm  text-white"data-bs-dismiss="modal" style="border: none; background-color: grey;">CLOSE</a>

    <a href="javascript:void();" data-id="<?php echo $idBill ?>"  class="btn btn-sm btnProceed text-white"  style="border: none; background-color: blue;"id="btnPro"> Save</a>
  </div>
</div>

  </form>
</div>
<script type="text/javascript">

  

$('#paymentForm').on('click', '.btnProceed', function(event) {
  var idd = $(this).data('id');
 var payment = document.getElementById("payments").value;
      

  $.ajax({
    url: "patient_pet_commenteditmem_insert.php",
    method: "POST",
    data: {
      idd: idd,
      payment: payment,
    },
     success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
             $('#RegisPayModal1').modal('hide');
          
              swal({
                    title: "Success",
                    text: "Comment Success",
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