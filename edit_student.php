<?php
// Include database connection
include_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $studID = $_POST["stud_id"]; // Ensure correct name attribute
    $fullname = $_POST["full_name"];
    $email = $_POST["email"];
    $phoneno = $_POST["phone_no"];
    $experience = $_POST["experience"];
    $achievement = $_POST["achievement"];
    $belt = $_POST["belt"];
    // Update data in the database
    $sql = "UPDATE register 
            SET full_name='$fullname', email='$email', phone_no='$phoneno', experience='$experience', achievement='$achievement', belt='$belt'
            WHERE stud_id='$studID'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the page where you want to show the list of orders after editing
        header("Location: viewUsers.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
