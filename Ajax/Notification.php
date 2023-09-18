<?php
include("../Connect.php");
require '../Config/UFunction.php';

// Validate and sanitize user input (user_petnotifid)
if (isset($_SESSION['user_petnotifid'])) {
    $selectedUserId = $_SESSION['user_petnotifid'];
    
    // Create a database connection (ensure your Connect.php file contains secure connection code)

    $UDF_call = new UFunction();
    $select_status = $UDF_call->select_order_limit('notification', 'n_id', 10, $selectedUserId);

    // Close the database connection
    // mysqli_close($con); // You may not need to close it here, depending on your connection handling

} else {
    // Handle the case when user_petnotifid is not set in the session
    $select_status = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/notification.css" /> <!-- Make sure the path is correct -->
    <title>Barkspace</title>
    <style>
        /* CSS for centering the message and changing font color */
        .center-message {
            text-align: center;
            margin-top: 50px; /* Adjust the margin as needed for vertical alignment */
            color: black; /* Change the font color to black or any other color you prefer */
        }
    </style>
</head>
<body>
    <div id="notifications">
        <?php if ($select_status): foreach ($select_status as $se_noti): ?>
            <div class="dropdown-item">
                <h6><?php echo htmlspecialchars($se_noti['n_sub']); ?></h6>
                <span><?php echo htmlspecialchars($se_noti['n_msg']); ?></span>
                <hr class="mt-1 mb-1">
            </div>
        <?php endforeach; else: ?>
            <div class="center-message">
                <p>No notifications found.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Add JavaScript for loading notifications with AJAX -->
    <script>
        // Function to load notifications using AJAX
        function loadNotifications() {
            // Create an XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Define the AJAX request
            xhr.open('GET', 'load_notifications.php', true);

            // Set up the callback function when the request completes
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Update the notifications div with the response
                    document.getElementById('notifications').innerHTML = xhr.responseText;
                }
            };

            // Send the AJAX request
            xhr.send();
        }

        // Call the loadNotifications function when the page loads
        window.onload = loadNotifications;
    </script>
</body>
</html>
