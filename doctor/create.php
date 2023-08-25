<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "login_db";

// CREATE CONNECTON
$connection = new mysqli($servername, $username, $password, $database);


$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    do{
        if ( empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // ADD NEW CLIENT TO DAATABASE
        $sql = "INSERT INTO clients (name, email, phone, address) " . 
               "VALUES ('$name', '$email', '$phone', '$address')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $name = "";
        $email = "";
        $phone = "";
        $address = "";

        $successMessage = "Cliend added Successfully";
        
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
        <h2>New User</h2>
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