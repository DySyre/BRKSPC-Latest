<?php 

include '../connect.php';

$output= array();
$sql = "SELECT * FROM schedule_tbl where schedule_branch = '1'";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'schedule_id',
	1 => 'schedule_date',
	2 => 'schedule_startTime',
	3 => 'schedule_endTime',
	4 => 'schedule_isavail',
	5 => 'schedule_branch',
	6 => 'schedule_dor',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " OR schedule_id like '%".$search_value."%'";
	$sql .= " OR schedule_date like '%".$search_value."%'";
	

		
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY schedule_id asc";
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
$sub_array[] = $row['schedule_id'];
		$sub_array[] = $row['schedule_date'];

	if($row['schedule_isavail'] == '1')
	{
		$sub_array[] = 'Available';

	}
	if($row['schedule_isavail'] == '0')
	{
		$sub_array[] = 'Not Available';

	}
	
		$branchId = $row['schedule_branch'];
		$query2 = "select * from branch_tbl where branch_id = '$branchId'";
		$result2 = mysqli_query($con, $query2);
		$user_data = mysqli_fetch_assoc($result2);


				
			
		
		$sub_array[] = $user_data['branch_name'];
	
	

		$sub_array[] = '<a href="javascript:void();" data-id="'.$row['schedule_id'].'"  class="btn btn-sm editbtnClassroom btn-light" style="background-color: transparent;border: none;"><i class="bi bi-pen-fill" style="color: #FFC107"></i></a> ';
		$data[] = $sub_array;
	
	
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
