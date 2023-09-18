<?php
// Include necessary files and create a database connection (similar to notification.php)

// Fetch the latest notifications (similar to the code in notification.php)

// Output the notifications as HTML
foreach ($select_status as $se_noti) {
    echo '<div class="dropdown-item">';
    echo '<h6>' . htmlspecialchars($se_noti['n_sub']) . '</h6>';
    echo '<span>' . htmlspecialchars($se_noti['n_msg']) . '</span>';
    echo '<hr class="mt-1 mb-1">';
    echo '</div>';
}

// Close the database connection (if necessary)

?>
