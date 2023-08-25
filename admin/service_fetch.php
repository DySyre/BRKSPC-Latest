<?php 

include '../connect.php';

$output= array();
$sql = "SELECT * FROM services_tbl join category_tbl on services_tbl.category_idfk = category_tbl.category_id";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'services_id',
	1 => 'category_name',
	2 => 'services_name',
	3 => 'services_descrip',
	4 => 'services_tconsume',
	5 => 'services_price',


);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE services_id like '%".$search_value."%'";
	$sql .= " OR category_name like '%".$search_value."%'";
	$sql .= " OR services_name like '%".$search_value."%'";
	$sql .= " OR services_descrip like '%".$search_value."%'";

	$sql .= " OR services_tconsume like '%".$search_value."%'";
	$sql .= " OR services_price like '%".$search_value."%'";


		
}

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
		$sub_array[] = $row['services_id'];
		$sub_array[] = $row['category_name'];
		$sub_array[] = $row['services_name'];
		$sub_array[] = $row['services_descrip'];
		$sub_array[] = $row['services_tconsume'];
		$sub_array[] = $row['services_price'];



		$sub_array[] = '<a href="javascript:void();" data-id="'.$row['services_id'].'"  class="btn btn-sm editbtnSevices btn-light" style="background-color: transparent;border: none;"><i class="bi bi-pen-fill" style="color: #FFC107"></i></a>  <a href="javascript:void();" data-id="'.$row['services_id'].'"  class="btn btn-danger btn-sm deleteBtnServices" style="background-color: transparent;border: none;"><i class="bi bi-trash3-fill" style="color: red"></i></a>';
		$data[] = $sub_array;
	
	
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
