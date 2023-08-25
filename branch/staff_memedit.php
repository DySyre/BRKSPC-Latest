<?php session_start();
include "../connect.php";

$estaff_fname =$_POST['estaff_fname'];
$estaff_lname =$_POST['estaff_lname'];

$estaff_email =$_POST['estaff_email'];

$estaff_pass =$_POST['estaff_pass'];

$ebranchId =$_POST['ebranchId'];

$id = $_POST["id"];


// Image extension validation

        $sql = "UPDATE `staff_tbl` SET `staff_fname`='$estaff_fname',`staff_lname`='$estaff_lname',`staff_branch`='$ebranchId',`staff_email`='$estaff_email',`staff_pass`='$estaff_pass' WHERE  staff_id ='$id'";

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
