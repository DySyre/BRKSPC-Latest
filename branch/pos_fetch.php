<?php 

include '../connect.php';

$output= array();
$sql = "SELECT * FROM `services_tbl`";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'services_name',
	1 => 'services_price',
	2 => 'services_tconsume',
	3 => 'services_id',
);



if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY services_id asc";
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
		
		$sub_array[] = $row['services_name'];
		$sub_array[] = $row['services_tconsume'];
		$sub_array[] = $row['services_price'];
		$sub_array[] = $row['services_id'];
		


		$data[] = $sub_array;

	
	
		
	
	
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
