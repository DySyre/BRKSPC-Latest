<?php 

include '../connect.php';

$output= array();
$sql = "SELECT * FROM item_category_tbl";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'item_category_id',
	1 => 'item_category_name',
	2 => 'item_category_isactive',
	3 => 'item_category_dor',
	4 => 'item_category_branch',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE  item_category_id like '%".$search_value."%'";
	$sql .= " OR item_category_name like '%".$search_value."%'";
	$sql .= " OR item_category_branch like '%".$search_value."%'";


		
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY item_category_id asc";
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
		$sub_array[] = $row['item_category_id'];
		$sub_array[] = $row['item_category_name'];


		$branchId = $row['item_category_branch'];
		$query2 = "select * from branch_tbl where branch_id = '$branchId'";
		$result2 = mysqli_query($con, $query2);
		$user_data = mysqli_fetch_assoc($result2);


				
			
		
		$sub_array[] = $user_data['branch_name'];
		$sub_array[] = $row['item_category_dor'];
		
		
		



		$sub_array[] = '<a href="javascript:void();" data-id="'.$row['item_category_id'].'"  class="btn btn-sm editbtnClassroom btn-light" style="background-color: transparent;border: none;"><i class="bi bi-pen-fill" style="color: #FFC107"></i></a>  <a href="javascript:void();" data-id="'.$row['item_category_id'].'"  class="btn btn-danger btn-sm deleteBtnClassroom" style="background-color: transparent;border: none;"><i class="bi bi-trash3-fill" style="color: red"></i></a>';
		$data[] = $sub_array;

		
		
	
	
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
