<?php 
session_start();
include '../connect.php';
$branchId =  $_SESSION['branch_idd'];
$output= array();
$sql = "SELECT * FROM staff_tbl join branch_tbl on staff_tbl.staff_branch = branch_tbl.branch_id where staff_type = '2'";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'staff_id',
	1 => 'staff_fname',
	2 => 'staff_lname',
	3 => 'branch_name',
	4 => 'staff_email',
	5 => 'staff_branch',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " AND (staff_id like '%".$search_value."%'";
	$sql .= " OR staff_fname like '%".$search_value."%'";
	$sql .= " OR staff_lname like '%".$search_value."%'";
	$sql .= " OR branch_name like '%".$search_value."%'";

	$sql .= " OR staff_email like '%".$search_value."%')";

		
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY staff_id asc";
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

		if($row['staff_branch'] == $branchId)
		{
			$sub_array[] = $row['staff_id'];
			$sub_array[] = $row['staff_fname'];
			$sub_array[] = $row['staff_lname'];
			$sub_array[] = $row['branch_name'];

			$sub_array[] = '<a href="javascript:void();" data-id="'.$row['staff_id'].'"  class="btn btn-sm editbtnClassroom btn-light" style="background-color: transparent;border: none;"><i class="bi bi-pen-fill" style="color: #FFC107"></i></a>  <a href="javascript:void();" data-id="'.$row['staff_id'].'"  class="btn btn-danger btn-sm deleteBtnClassroom" style="background-color: transparent;border: none;"><i class="bi bi-trash3-fill" style="color: red"></i></a>';
			$data[] = $sub_array;

		}
		
	
	
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
