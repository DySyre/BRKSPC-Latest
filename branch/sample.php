<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

<?php 
include('../connect.php'); 

if (isset($_POST['petname'])) {
  $petNames = $_POST['petname'];
$petServices = $_POST['petservices'];

// Assuming you have a database connection established

// Insert data into the database
for ($i = 0; $i < count($petNames); $i++) {
    $petName = mysqli_real_escape_string($con, $petNames[$i]);
    $petService = mysqli_real_escape_string($con, $petServices[$i]);
    
    $sql = "INSERT INTO `your_table_name` (`petname`, `services`) VALUES ('$petName', '$petService')";
    
    if (mysqli_query($con, $sql)) {
        echo "Data inserted successfully for petname: $petName, service: $petService<br>";
    } else {
        echo "Error inserting data for petname: $petName, service: $petService - " . mysqli_error($con) . "<br>";
    }
}

}

// Close the database connection
mysqli_close($con);
?>
<form>
	

<input type="text" name="petname">
<input type="text" name="petservices" >
<input type="text" name="petservices" >
<input type="text" name="petservices" >

<input type="text" name="petname">
<input type="text" name="petservices" >
<input type="text" name="petservices" >

<button type=""> submit</button>
</form>
</body>
</html>