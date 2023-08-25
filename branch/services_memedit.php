<?php session_start();
include "../connect.php";

$eSname =$_POST['eSname'];
$eSdes =$_POST['eSdes'];

$eStimeCons =$_POST['eStimeCons'];

$eSprice =$_POST['eSprice'];

$ecatId =$_POST['ecatId'];

$id = $_POST["id"];


// Image extension validation

        $sql = "UPDATE `services_tbl` SET `category_idfk`='$ecatId',`services_name`='$eSname',`services_descrip`='$eSdes',`services_tconsume`='$eStimeCons',`services_price`='$eSprice' WHERE  services_id ='$id'";

         $query= mysqli_query($con,$sql);
         $lastId = mysqli_insert_id($con);
        if($query ==true)
            {
   
            $data = array(
            'status'=>'true',
       
            );

             echo json_encode($data);
            }
        else
            {
            $data = array(
            'status'=>'false',
      
            );

            echo json_encode($data);
            }   
