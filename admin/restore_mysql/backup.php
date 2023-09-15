<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_db";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the backup file name
$backupFileName = 'C:\xampp\htdocs\Main\barkspace\restore_mysql\restore_database.sql' . date('Y-m-d_H-i-s') . '.sql';

// Export the database to the backup file
$command = "mysqldump -u$username -p$password -h$servername $dbname > $backupFileName";
exec($command);

// Close the database connection
$conn->close();

echo "Backup created successfully: $backupFileName";
?>
