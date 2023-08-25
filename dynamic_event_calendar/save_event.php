<?php                
require 'database_connection.php'; 
$id = $_POST['id'];
$code = $_POST['code'];
$schedule = $_POST['schedule'];
$owner_name = $_POST['owner_name'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$address = $_POST['address'];
$category_id = $_POST['category_id'];
$breed = $_POST['breed'];
$age = $_POST['age'];
$service_ids = $_POST['service_ids'];
$status = $_POST['status'];
$date_created = date("y-m-d", strtotime($_POST['date_created'])); 
$date_updated = date("y-m-d", strtotime($_POST['date_updated'])); 
			
$insert_query = "insert into `appointment_list`(`id`,`code`,`schedule`,`owner_name`,`contact`,`email`,`address`,`category_id`,`breed`,`age`,`service_ids`,`status`,`date_created`,`date_updated`) values 
('".$id."''".$code."''".$schedule."''".$owner_name."''".$contact."''".$email."''".$address."','".$category_id."','".$breed."''".$age."''".$service_ids."''".$status."''".$date_created."''".$date_updated."')";             
if(mysqli_query($con, $insert_query))
{
	$data = array(
                'status' => true,
                'msg' => 'Event added successfully!'
            );
}
else
{
	$data = array(
                'status' => false,
                'msg' => 'Sorry, Event not added.'				
            );
}
echo json_encode($data);	
?>
