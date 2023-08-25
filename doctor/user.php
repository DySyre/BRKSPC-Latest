

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Barkspace</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    </head>

    <body>
        
        <div class="container my-5">
            <h2>Users</h2>
            <a class="btn btn-primary" href="create.php" role="button">Add Doctor</a>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Destination</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "login_db";

                    // CREATE CONNECTION
                    $connection = new mysqli($servername, $username, $password, $database);

                    // CHECK CONNECTION
                    if($connection->connect_error){
                        die("Connection Failed: " . $connection->connect_error);
                    }

                    // READ ALL ROW FROM DATABASE TABLE
                    $sql = "SELECT * FROM clients";
                    $result = $connection->query($sql);

                    if(!$result){
                        die("Invalid query: " . $connection->error);
                        
                    }

                    // READ DATA OF EACH ROW
                    while($row = $result->fetch_assoc()){
                        echo "
                        <tr>
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td>$row[phone]</td>
                        <td>$row[address]</td>
                        <td>$row[created_at]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='edit.php?id=$row[id]'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='delete.php?id=$row[id]'>Delete</a>
                        </td>
                        </tr>
                        ";
                    }
                    ?>
                    <!-- <tr>
                        <td>10</td>
                        <td>Bill Gates</td>
                        <td>bill.gate@gmail.com</td>
                        <td>+6302982192</td>
                        <td>Marilao Branch</td>
                        <td>05/20/2023</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="doctor/edit.php">Edit</a>
                            <a class="btn btn-danger btn-sm" href="doctor/delete.php">Delete</a>
                        </td>
                    </tr> -->
                </tbody>
            </table>
            <a class="btn btn-primary" style=" position: relative; text-align: center; align-items: center; justify-content: center; font-family: 'Asap', sans-serif; text-decoration: none; text-transform: capitalize; width: 100px; border-radius:10px; transition: background-color 300ms; color: #fff;" href="/index.php" >Back</a><br><br>
        </div>
        




    </body>
</html>