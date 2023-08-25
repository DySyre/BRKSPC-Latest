<?php 

include '../connect.php';

$output= array();
$sql = "SELECT * FROM branch_tbl where branch_id != '3'";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'branch_id',
	1 => 'branch_name',
	2 => 'branch_isactive',
	3 => 'branch_dor',

);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];

	$sql .= " AND branch_name like '%".$search_value."%'";

		
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY branch_id asc";
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
		
		$sub_array[] = $row['branch_id'];
		$sub_array[] = $row['branch_name'];
		if($row['branch_isactive'] == '1')
		{
			$sub_array[] = 'Active';
		}
		else if($row['branch_isactive'] == '0')
		{
			$sub_array[] = 'Not Active';
		}
		
		$sub_array[] = '<a href="javascript:void();" data-id="'.$row['branch_id'].'"  class="btn btn-sm editbtnClassroom btn-light" style="background-color: transparent;border: none;"><i class="bi bi-pen-fill" style="color: #FFC107"></i></a>  <a href="javascript:void();" data-id="'.$row['branch_id'].'"  class="btn btn-danger btn-sm deleteBtnClassroom" style="background-color: transparent;border: none;"><i class="bi bi-trash3-fill" style="color: red"></i></a>';
		$data[] = $sub_array;

		
		
	
	
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
