<?php
session_start();

include '../connect.php';

$output= array();
$sql = "SELECT DISTINCT(id), last_name, `user_name`, email FROM `users_balagtas`  JOIN appointment_tbl ON users_balagtas.id = appointment_tbl.pet_ownerid ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'last_name',
	2 => 'user_name',
	3 => 'email',
	
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " where (id like '%".$search_value."%'";
	$sql .= " OR last_name like '%".$search_value."%'";
	$sql .= " OR user_name like '%".$search_value."%'";
	$sql .= " OR email like '%".$search_value."%')";

		
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY last_name desc";
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
	$sub_array = array();
		
		$sub_array[] = $row['last_name'];
		$sub_array[] = $row['user_name'];
		$sub_array[] = $row['email'];
		



		$sub_array[] = '<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-sm btnViewAppointment btn-primary">View</a>';
		$data[] = $sub_array;


		
	
	
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
