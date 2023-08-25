
<?php session_start();
include "../connect.php";
 
$userid = $_POST['id'];
 
$sql = "SELECT * FROM `item_tbl` JOIN item_category_tbl ON item_tbl.item_categoryidfk = item_category_tbl.item_category_id JOIN branch_tbl on item_category_tbl.item_category_branch = branch_tbl.branch_id  where item_id =".$userid;
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) ){
?>

 <form id="updateStaffForm2" method="post" enctype="multipart/form-data">
    <div class="row">
        
   
 
 </div>
        <div class="row">
           
        
        
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">ITEM CODE</label>
                      <input type="text" class="form-control" name="itmCode" id="classroom_name" required placeholder="" value="<?php echo $row['item_code'] ?>"  readonly>
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Item</label>
                      <input type="text" class="form-control" name="eItemName" id="classroom_name" required value="<?php echo $row['item_name'] ?>" readonly>
                       
                  </div>
              </div>
             
               
              <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Old Stock</label>
                     <input type="number" class="form-control" name="eStockName" id="classroom_name" required placeholder="" value="<?php echo $row['item_stock'] ?>" >
                       
                  </div>
              </div>
              <div class="col-md-12">
                   <div class="form-group">
                  
                      <label style="font-size: 1rem;" for="fname">Enter New Stock</label>
                     <input type="number" class="form-control" name="neweStockName" id="classroom_name">
                       
                  </div>
              </div>
        
            
            
            <input type="hidden" name="id" id="id" value="<?php echo $row['item_id']; ?>">

            
        </div>
         
    
     <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="submit" data-id='<?php echo $row['item_id']; ?>'  class="btn btn-primary">Add</button> 
       </div>                

  </form>


<script type="text/javascript">
$(document).on('submit', '#updateStaffForm2', function(e) {
    e.preventDefault();
    var form = $('#updateStaffForm2')[0];
    var formdata = new FormData(form);
    $.ajax({
        type: 'POST',
        url: 'item_StockInsert.php',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
                $('#memClassroomModal2').modal('hide');
                $('#addStaffModal2').modal('hide');
                mytable = $('#tabledataStaff').DataTable();

                swal({
                    title: "Success",
                    text: "Stock Added",
                    icon: "success",
                    button: false,
                    timer: 1000 
                  
                    
                });

                 
                     setTimeout(function() {
                  location.reload();
              }, 1000);
            } else {
                swal("Error", "Item Update Error", "error");
            }
        }
    });
});







</script>
 
 
<?php } 


?>