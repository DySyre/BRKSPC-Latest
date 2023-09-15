<?php session_start();
include "../connect.php";

$userid = $_POST['id'];
$SumConsume = 0;

$sql = "SELECT * FROM `notification`
        JOIN users_balagtas ON notification.user_petnotifid = users_balagtas.id
        WHERE notification.appointment_payment_id = $userid";

$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($result)) {
    // Access the data from the result row, e.g., $row['column_name']
    // Perform any necessary operations or calculations
    // You can access data like: $row['column_name']

    // Assuming you want to calculate a sum of some column (e.g., 'amount')
    $SumConsume += $row['amount'];
}

// Now, $SumConsume contains the sum of the 'amount' column for the selected rows
// You can use it as needed

// Don't forget to close the database connection when done
mysqli_close($con);
?>