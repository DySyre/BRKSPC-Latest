<?php
  include("../Connect.php");
require_once '../Config/UFunction.php';
$query = "SELECT user_petnotifid FROM notification";

$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Fetch the results as an associative array
$userPetNotifIds = array();
while ($row = mysqli_fetch_assoc($result)) {
    $userPetNotifIds[] = $row;
}

// Close the database connection
mysqli_close($con);
// Check if $_SESSION['user_petnotifid'] exists and dump its value
if (isset($_SESSION['user_petnotifid'])) {
    var_dump($_SESSION['user_petnotifid']);
} else {
    echo "Session variable 'user_petnotifid' is not set.";
}
$UDF_call = new UFunction();

// Assuming you have retrieved the user_petnotifid value from the database and assigned it to $user_petnotifid
$selectedUserId = $_SESSION['user_petnotifid']; // Retrieve the user_petnotifid value from the session
$select_status = $UDF_call->select_order_limit('notification', 'n_id', 10, $selectedUserId);
?>

    <?php if($select_status){ foreach($select_status as $se_noti){ ?>
    <div class="dropdown-item" >
        <h6><?php echo $se_noti['n_sub']; ?></h6>
        <span><?php echo $se_noti['n_msg']; ?></span>
        <hr class="mt-1 mb-1">
    </div>
    <link rel="stylesheet" href="css/notification.css" />
    <?php }} ?>

    