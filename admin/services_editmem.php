<?php session_start();
include "../connect.php";
 
$userid = $_POST['id'];
 
$sql = "SELECT * FROM services_tbl join category_tbl on services_tbl.category_idfk = category_tbl.category_id where services_id =".$userid;
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) ){
?>

 <form id="updateServicesForm2" method="post" enctype="multipart/form-data">
    <div class="row">
        
   
 
 </div>
        <div class="row">
           
           
            
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Branch</label>
                     

                      <select class="form-control" name="ecatId">
                    <option value="<?php echo $row['category_id'] ?>" hidden><?php echo $row['category_name'] ?></option>
                      <?php
                      $queryBranch = "select * from category_tbl where category_isactive = '1'";
                        $resqueryBranch = mysqli_query($con, $queryBranch);

                        while($rowBranch = mysqli_fetch_assoc($resqueryBranch))
                        {
                           
                            ?>
                           <option value="<?php echo $rowBranch['category_id'] ?>"><?php echo $rowBranch['category_name'] ?></option>
                                
                          
                            <?php

                        }
                      ?>
                        </select>
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Services name</label>
                      <input type="text" class="form-control" name="eSname" id="classroom_name" required value="<?php echo $row['services_name']; ?>">
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Services description</label>
                      <input type="text" class="form-control" name="eSdes" id="classroom_name" required value="<?php echo $row['services_descrip']; ?>">
                       
                  </div>
              </div>
                <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Services Time Consume</label>
                     <input type="number" class="form-control" name="eStimeCons" id="classroom_name" required value="<?php echo $row['services_tconsume']; ?>">
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Service Price</label>
                     <input type="number" class="form-control" name="eSprice" id="Sprice" required value="<?php echo $row['services_price']; ?>">
                       
                  </div>
              </div>
              
            
            <input type="hidden" name="id" id="id" value="<?php echo $row['services_id']; ?>">

            
        </div>
         
    
     <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="submit" data-id='<?php echo $row['services_id']; ?>'  class="btn btn-primary">Save</button> 
       </div>                

  </form>


<script type="text/javascript">
$(document).on('submit', '#updateServicesForm2', function(e) {
    e.preventDefault();
    var form = $('#updateServicesForm2')[0];
    var formdata = new FormData(form);
    $.ajax({
        type: 'POST',
        url: 'services_memedit.php',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
                $('#addServicesModal').modal('hide');
               
                mytable = $('#tabledataServices').DataTable();

                swal({
                    title: "Success",
                    text: "Services Updated",
                    icon: "success",
                    button: false,
                    timer: 1000 
                  
                    
                });

                 
                     setTimeout(function() {
                  location.reload();
              }, 1000);
            } else {
                swal("Error", "Services Update Error", "error");
            }
        }
    });
});







</script>
 
 
<?php } 


?>