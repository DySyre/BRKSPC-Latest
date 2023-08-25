<?php 

include '../connect.php';

$output= array();
$sql = "SELECT * FROM `pos_purchase_his_tbl` JOIN item_tbl on pos_purchase_his_tbl.pos_purchase_hisitemidfk = item_tbl.item_id JOIN item_category_tbl ON item_tbl.item_categoryidfk = item_category_tbl.item_category_id join branch_tbl ON item_category_tbl.item_category_branch = branch_tbl.branch_id where isProceed = '1'";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'pos_purchase_hisordrnum',
	1 => 'pos_purchase_hisitemname',
	2 => 'pos_purchase_hisitemprice',
	3 => 'pos_purchase_hisitemtotalAmt',
	4 => 'pos_purchasehis_dor',
	5 => 'pos_purchase_his_id',
	6 => 'branch_name',
	
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " AND  (pos_purchase_hisordrnum like '%".$search_value."%'";
	$sql .= " OR pos_purchase_hisitemname like '%".$search_value."%'";
	$sql .= " OR pos_purchase_hisitemprice like '%".$search_value."%'";
	$sql .= " OR branch_name like '%".$search_value."%'";
	$sql .= " OR pos_purchase_hisitemtotalAmt like '%".$search_value."%')";
		
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY pos_purchase_his_id asc";
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
	
		$sub_array[] = $row['pos_purchase_hisordrnum'];
		$sub_array[] = $row['pos_purchase_hisitemname'];
		$sub_array[] = $row['pos_purchase_hisitemprice'];
		$sub_array[] = $row['pos_purchase_hisitemtotalAmt'];
		$sub_array[] = $row['branch_name'];
		$sub_array[] = $row['pos_purchasehis_dor'];

		$data[] = $sub_array;
}
$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
