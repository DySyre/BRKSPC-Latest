<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "login_db";

// CREATE CONNECTON
$connection = new mysqli($servername, $username, $password, $database);


$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET METHOD: SHOW THE DATA OF THE CLIENT

    if ( !isset($_GET["id"])) {
        header("location: index.php");
        exit;
    }

    $id = $_GET["id"];

    // READ THE ROW OF THE SELECTED CLIENT FORM DATABASE TABLE

    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: user.php");
        exit;
    }

    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
}
else{
    // POST METHOD: UPDTE THE DATA OF THE CLIENT

    $id = $_POST["id"];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    do{
        if ( empty($id) || empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE clients " . 
        "SET name = '$name', email = '$email', phone = '$phone', address = '$address' " .
        "WHERE id = $id";

    $result = $connection->query($sql);

    if (!$result) {
        $errorMessage = "Error updating the data" . $connection->error;
        break;
    }

    $successMessage = "Client updated correctly";

    header("location: user.php");
    exit;



    } while (false);
}



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Barkspace</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
<body>
    <div class="container my-5"></div>
        <h2>New Doctor</h2>
        <?php 
        
            if ( !empty($errorMessage)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>         
                ";
            }
        
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="font-size: 1.2rem; font-weight: bold; margin: 5px;">Name</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="font-size: 1.2rem; font-weight: bold; margin: 5px;">Email</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="font-size: 1.2rem; font-weight: bold; margin: 5px;">Phone Number</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="font-size: 1.2rem; font-weight: bold; margin: 5px;">Destination</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>

            <?php
            if ( !empty($successMessage)){
                echo "
                <div class='row-mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'> </button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-2 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-2 d-grid">
                    <a class="btn btn-outline-primary" href="user.php" role="button">Cancel</a>
                </div>
            </div>

            </div>
        </form>
</body>
</html>