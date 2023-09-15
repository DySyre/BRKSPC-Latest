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

// Define the backup file name (change this to the name of your backup file)
$backupFileName = 'C:\xampp\htdocs\Main\barkspace\restore_mysql\restore_database.sql';

// Import data from the backup file
$command = "mysql -u$username -p$password -h$servername $dbname < $backupFileName";
exec($command);

// Close the database connection
$conn->close();

if($backupFileName){
    echo "<script>alert('Database restored successfully');</script>";
    header("location:../admin.php");
    }else{
        echo"<script>alert('Error while restoring Database')</script>" ;

}


?>



