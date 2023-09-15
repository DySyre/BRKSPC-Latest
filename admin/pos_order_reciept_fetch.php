<?php session_start();
$ordernum = $_SESSION['ordernumSes'];

include '../connect.php';

$output= array();
$sql = "SELECT * FROM `pos_purchase_his_tbl` WHERE pos_purchase_hisordrnum = '$ordernum' AND isProceed ='1'";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'pos_purchase_his_id',
	1 => 'pos_purchase_hisitemidfk',
	2 => 'pos_purchase_hisitemname',
	3 => 'pos_purchase_hisitemprice',
	4 => 'pos_purchase_hisitemqty',
	5 => 'pos_purchase_hisitemtotalAmt',
	6 => 'pos_purchase_hisordrnum',
	7 => 'pos_hisorder_list_idfk',
	8 => 'lastid',
	9 => 'isProceed',
	10 => 'pos_purchasehis_dor',
	
);

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
	
		$sub_array[] = $row['pos_purchase_hisitemname'];
		$sub_array[] = $row['pos_purchase_hisitemprice'];
		$sub_array[] = $row['pos_purchase_hisitemqty'];
		$sub_array[] = $row['pos_purchase_hisitemtotalAmt'];

		$sql1 = "SELECT * FROM `pos_ordered_tbl` WHERE pos_ordered_numidfk = '$ordernum'";
		$totalQuery1 = mysqli_query($con,$sql1);
		$total_all_rows1 = mysqli_num_rows($totalQuery1);
		$totalAmnt = $total_all_rows1['pos_ordered_totalamnt'];
		$totaPayment = $total_all_rows1['pos_ordered_payment'];
		$totalChange = $total_all_rows1['pos_ordered_change'];


		
		$sub_array[] = $row['item_buying_price'];

		$sub_array[] = $row['item_selling_price'];	
		$sub_array[] = $row['item_stock'];

		$sub_array[] = $row['item_expiration'];
		
		$sub_array[] = $row['item_dor'];



		$data[] = $sub_array;

		
		
	
	
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
