<?php 

include '../connect.php';

$output= array();
$sql = "SELECT * FROM `item_tbl` JOIN item_category_tbl ON item_tbl.item_categoryidfk = item_category_tbl.item_category_id JOIN branch_tbl on item_category_tbl.item_category_branch = branch_tbl.branch_id";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'item_id',
	1 => 'item_name',
	2 => 'item_buying_price',
	3 => 'item_selling_price',
	4 => 'item_stock',
	5 => 'item_status',
	6 => 'item_expiration',
	7 => 'item_dor',
	8 => 'item_category_name',
	9 => 'branch_name',
	10 => 'item_code',
	
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE  item_code like '%".$search_value."%'";
	$sql .= " OR item_name like '%".$search_value."%'";
	$sql .= " OR item_stock like '%".$search_value."%'";
	$sql .= " OR item_expiration like '%".$search_value."%'";
	$sql .= " OR item_status like '%".$search_value."%'";
	$sql .= " OR item_category_name like '%".$search_value."%'";
	$sql .= " OR branch_name like '%".$search_value."%'";






		
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY item_id asc";
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
		$Idd = $row['item_id'];
		$sub_array[] = $row['item_code'];
		$sub_array[] = $row['item_name'];
		$sub_array[] = $row['item_category_name'];
		$sub_array[] = $row['branch_name'];
		$sub_array[] = $row['item_buying_price'];

		$sub_array[] = $row['item_selling_price'];

		
		$sub_array[] = $row['item_stock'];
		
		

		if ($row['item_stock'] > '0' &&  $row['item_stock'] <= '10' ) {
			 $sql1 = "UPDATE `item_tbl` SET `item_status`='Critical Level' WHERE  item_id ='$Idd '";
         	$query1= mysqli_query($con,$sql1);

         	$sub_array[] = '<a href="javascript:void();"   class="" style="font-weight:bold;text-decoration: none;color: yellow ;border: none;">'.$row['item_status'].'</a>';
		}
		else if ($row['item_stock'] == '0') {
			 $sql2 = "UPDATE `item_tbl` SET `item_status`='Out of Stock' WHERE  item_id ='$Idd '";
         	$query2= mysqli_query($con,$sql2);

         	$sub_array[] = '<a href="javascript:void();"   class="" style="font-weight:bold;text-decoration: none;color: red ;border: none;">'.$row['item_status'].'</a>';
		}
		else if ($row['item_stock'] >= '11') {
			 $sql3 = "UPDATE `item_tbl` SET `item_status`='High Stock' WHERE  item_id ='$Idd '";
         	$query3= mysqli_query($con,$sql3);
         	$sub_array[] = '<a href="javascript:void();"   class="" style="font-weight:bold;text-decoration: none;color: green ;border: none;">'.$row['item_status'].'</a>';
		}

	

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
