<?php include('../connect.php');

$id = $_POST['id'];
$sql = "DELETE FROM services_tbl WHERE services_id  ='$id'";
$delQuery =mysqli_query($con,$sql);
if($delQuery==true)
{
    $data = array(
        'status'=>'success',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'failed',
      
    );

    echo json_encode($data);
} 

?>