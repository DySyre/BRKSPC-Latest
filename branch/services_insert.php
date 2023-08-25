<?php include('../connect.php'); 

$catId = $_POST['catId'];
$Sname = $_POST['Sname'];
$Sdes = $_POST['Sdes'];
$StimeCons = $_POST['StimeCons'];
$Sprice = $_POST['Sprice'];



    $sql2 = "SELECT * FROM `services_tbl` WHERE `services_name` = '$Sname';";
    $result2 = mysqli_query($con, $sql2);

    if (mysqli_num_rows($result2)==1)
    {
        $sql = "INSERT INTO `services_tbl`(`category_idfk`, `services_name`, `services_descrip`, `services_tconsume`, `services_price`) VALUES ('$catId','$Sname','$Sdes','$StimeCons','$Sprice')";

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
    }
    else
    {
        
     
        $sql = "INSERT INTO `services_tbl`(`category_idfk`, `services_name`, `services_descrip`, `services_tconsume`, `services_price`) VALUES ('$catId','$Sname','$Sdes','$StimeCons','$Sprice')";

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
        
       
   
    }
  


  



    
?>