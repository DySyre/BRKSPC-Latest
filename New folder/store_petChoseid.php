<?php 
session_start();
 include("connect.php");

$PetidCode = $_POST['PetidCode'];

if($PetidCode == "newPet")
{
    
   // first if 

    $clientId =  $_SESSION['client_id'];
    $query2 = "select * from users_balagtas where user_id = '$clientId' limit 1";
    $result2 = mysqli_query($con, $query2);

       $user_data = mysqli_fetch_assoc($result2);

       $fname = $user_data['user_name'];
       $user_id = $user_data['id'];
       
 $queryCheckPet = "select * from pets where pet_user_id = '$user_id'";
              $resqueryCheckPet = mysqli_query($con, $queryCheckPet);
              if(mysqli_num_rows($resqueryCheckPet) > 0)
              {
                ?>
                <div class="col-md-12 mt-4">
                      <div class="col-md-4">
                  <label>Select Pet:</label>
                   <select class="form-control" id="selectPetd2" onchange="selectPet2()" name="">
                       <option hidden>Choose</option>
                      <?php

                      $queryPet = "select * from pets where pet_user_id = '$user_id'";
                      $resqqueryPet = mysqli_query($con, $queryPet);
                      while($rowresqqueryPet = mysqli_fetch_assoc($resqqueryPet))
                      {
                          ?>
                          <option value="<?php echo $rowresqqueryPet['id'] ?>"><?php echo $rowresqqueryPet['pet_name'] ?></option>
                          <?php
                      }
                      ?>
                      <option value="newPet">New Pet</option>
                      </select>
                      </div>
                  </div>
                   <div class="" id="ansShow2">
        
                    </div>
                  

            <script type="text/javascript">
              function selectPet2(){
      
      var x = document.getElementById("selectPetd2").value;
      // document.getElementById("potek").disabled = true;

      
     // alert(x);
        $.ajax({
                url:"store_event_id2.php",
                method:"POST",
                data:{
                  selectPetd: x
        
               
                },
                success: function(data){
                  $("#ansShow2").html(data);

                }
              })

      }
            </script>

                  <?php

              }

    // end first if


}
else
{ // else first

    $clientId =  $_SESSION['client_id'];
    $query2 = "select * from users_balagtas where user_id = '$clientId' limit 1";
    $result2 = mysqli_query($con, $query2);

       $user_data = mysqli_fetch_assoc($result2);

       $fname = $user_data['user_name'];
       $user_id = $user_data['id'];
       
 $queryCheckPet = "select * from pets where pet_user_id = '$user_id' AND id  = '$PetidCode'";
              $resqueryCheckPet = mysqli_query($con, $queryCheckPet);
              if(mysqli_num_rows($resqueryCheckPet) > 0)
              {
                ?>
                <div class="col-md-12 mt-4">
                      <div class="col-md-4">
                  <label>Select Pet:</label>
                   <select class="form-control" id="selectPetd2" onchange="selectPet2()" name="">
                       <option hidden>Choose</option>
                      <?php

                      $queryPet = "select * from pets where pet_user_id = '$user_id' AND id  != '$PetidCode'";
                      $resqqueryPet = mysqli_query($con, $queryPet);
                      while($rowresqqueryPet = mysqli_fetch_assoc($resqqueryPet))
                      {
                          ?>
                          <option value="<?php echo $rowresqqueryPet['id'] ?>"><?php echo $rowresqqueryPet['pet_name'] ?></option>
                          <?php
                      }
                      ?>
                      <option value="newPet">New Pet</option>
                      </select>
                      </div>
                  </div>
                   <div class="" id="ansShow2">
        
                    </div>
                  

            <script type="text/javascript">
              function selectPet2(){
      
      var x = document.getElementById("selectPetd2").value;
      // document.getElementById("potek").disabled = true;

      
     // alert(x);
        $.ajax({
                url:"store_event_id2.php",
                method:"POST",
                data:{
                  selectPetd: x
        
               
                },
                success: function(data){
                  $("#ansShow2").html(data);

                }
              })

      }
            </script>

                  <?php

              }

}// else dirst end

 

             
?>