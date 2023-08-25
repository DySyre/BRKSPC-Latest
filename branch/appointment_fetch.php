<?php 
session_start();
$branchId = $_SESSION['branch_idd'];
include '../connect.php';

$output= array();
$sql = "SELECT * FROM `appointment_tbl` JOIN users_balagtas ON appointment_tbl.pet_ownerid = users_balagtas.id JOIN schedule_tbl ON appointment_tbl.appointment_date = schedule_tbl.schedule_id  WHERE  appointment_branch = '$branchId'";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'appointment_payment_id',
	1 => 'schedule_date',
	2 => 'user_name',
	3 => 'last_name',
	4 => 'pet_ownerid',
	5 => 'appointment_payment_status',
	6 => 'appointment_payment_dor',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " AND (appointment_payment_id like '%".$search_value."%'";
	$sql .= " OR schedule_date like '%".$search_value."%'";
	$sql .= " OR user_name like '%".$search_value."%'";
	$sql .= " OR last_name like '%".$search_value."%'";

	$sql .= " OR appointment_payment_dor like '%".$search_value."%')";

		
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY appointment_payment_id asc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	if($row['appointment_payment_status'] == 'pending' || $row['appointment_payment_status'] == 'Resched' )
	{
		$sub_array = array();
		
		$sub_array[] = $row['last_name'];
		$sub_array[] = $row['user_name'];
		$sub_array[] = $row['schedule_date'];
		$sub_array[] = $row['appointment_payment_status'];


		$sub_array[] = '<a href="javascript:void();" data-id="'.$row['appointment_payment_id'].'"  class="btn btn-sm btnViewAppointment btn-primary">View</a>';
		$data[] = $sub_array;

	}
	else
	{

	}
	
		
	
	
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
