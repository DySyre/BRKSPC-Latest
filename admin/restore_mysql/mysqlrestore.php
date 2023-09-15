


<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="restore.css">
<head>
    <title>Database Backup and Restore</title>
</head>
<body>
    <h1>Database Backup and Restore</h1>

    <!-- Backup Button -->
    <form method="post" action="backup.php">
        <label for="">Click here</label>
        <input type="submit" name="backup" value="Backup Database">
    </form>

    <!-- Restore Button -->
    <form method="post" action="restore.php" enctype="multipart/form-data">
        <input type="file" name="restore_file" accept=".sql">
        <input type="submit" name="restore" value="Restore Database">
        
    </form>
</body>
</html>