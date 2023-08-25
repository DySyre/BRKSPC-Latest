<?php session_start();
include "../connect.php";


$startDate = $_POST['start_dates'];
    $end_date = $_POST['end_dates'];

    $sql = "SELECT sum(pos_purchase_hisitemtotalAmt) as TotalSales FROM `pos_purchase_his_tbl` JOIN item_tbl on pos_purchase_his_tbl.pos_purchase_hisitemidfk = item_tbl.item_id JOIN item_category_tbl ON item_tbl.item_categoryidfk = item_category_tbl.item_category_id join branch_tbl ON item_category_tbl.item_category_branch = branch_tbl.branch_id where isProceed = '1' AND (pos_purchasehis_dor BETWEEN '$startDate' AND  '$end_date')";

    $totalQuery = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($totalQuery);
    ?>
    <label style="">Total Sales:</label>
    <input style="font-weight:bold;border:none;" type="text" name="" value="₱<?php echo number_format($row['TotalSales']) ?>" readonly>
    <?php

?>