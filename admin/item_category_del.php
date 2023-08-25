<?php include('../connect.php');

$id = $_POST['id'];
$sql = "DELETE FROM item_category_tbl WHERE item_category_id  ='$id'";
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