<?php
session_start();

include '../connect.php';

$output= array();
$sql = "SELECT * FROM `pets` ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'pet_name',
	2 => 'pet_type',
	3 => 'pet_dob',
	4 => 'pet_age',
	5 => 'pet_breed',
	
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " Where pet_user_id like '%".$search_value."%'";
	$sql .= " OR pet_name like '%".$search_value."%'";
	$sql .= " OR pet_type like '%".$search_value."%'";
	$sql .= " OR pet_dob like '%".$search_value."%'";
	$sql .= " OR pet_age like '%".$search_value."%'";

	$sql .= " OR pet_breed like '%".$search_value."%'";


		
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY pet_name desc";
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
		

		
		$sub_array[] = $row['pet_name'];
		$sub_array[] = $row['pet_type'];
		$sub_array[] = $row['pet_breed'];
		$sub_array[] = $row['pet_dob'];

		$sub_array[] = $row['pet_age'];

		



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
