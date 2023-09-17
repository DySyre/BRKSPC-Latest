<?php
include("connect.php");
error_reporting(0);

class AppointDup {
    private $DBHOST = 'localhost';
    private $DBUSER = 'root';
    private $DBPASS = '';
    private $DBNAME = 'login_db';
    public $conn;

    public function __construct() {
        try {
            $this->conn = mysqli_connect($this->DBHOST, $this->DBUSER, $this->DBPASS, $this->DBNAME);
            if (!$this->conn) {
                throw new Exception('Connection was Not Established');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    public function selectAppointmentsByPetAndDate($petname_id, $sched_date) {
        // Create and prepare the SQL statement
        $select_query = "SELECT * FROM schedule_tbl WHERE pet_name_id = ? AND schedule_date = ?";
        $stmt = mysqli_prepare($this->conn, $select_query);

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "is", $petname_id, $sched_date);

        // Execute the query
        mysqli_stmt_execute($stmt);

        // Get the query result
        $result = mysqli_stmt_get_result($stmt);

        // Check if there are any rows returned
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the rows as an associative array
            $appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Return the selected rows
            return $appointments;
        } else {
            // No rows found, return an empty array or false as needed
            return [];
        }
    }
}

// Function to check for duplicate appointments
function isDuplicateAppointment($conn, $pet_name_id, $schedule_date) {
    $select_query = "SELECT * FROM schedule_tbl WHERE pet_name_id = ? AND schedule_date = ?";
    $stmt = mysqli_prepare($conn, $select_query);
    mysqli_stmt_bind_param($stmt, "is", $pet_name_id, $schedule_date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_num_rows($result) > 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pet_name_id = $_POST['pet_name_id'];
    $schedule_date = $_POST['schedule_date'];

    // Check for duplicate appointment
    if (isDuplicateAppointment($con, $pet_name_id, $schedule_date)) {
        echo "Error: You cannot schedule another appointment for the same pet on the same day.";
    } else {
        // Perform the insert query
        $insert_query = "INSERT INTO schedule_tbl (pet_name_id, schedule_date) VALUES (?, ?)";
        $stmt = mysqli_prepare($con, $insert_query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "is", $pet_name_id, $schedule_date);
            if (mysqli_stmt_execute($stmt)) {
                // Appointment successfully inserted
                echo "Appointment successfully scheduled.";
            } else {
                // Handle other database errors
                echo "Error: " . mysqli_error($con);
            }
            mysqli_stmt_close($stmt);
        } else {
            // Handle prepare error
            echo "Error: " . mysqli_error($con);
        }
    }
}

// Close the database connection
mysqli_close($con);
?>
