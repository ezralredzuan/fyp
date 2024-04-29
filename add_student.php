<?php
include_once "./connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Fetch form data
    $id = $_POST["studID"];
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $nophone = $_POST["phone_no"];
    $experience = $_POST["experience"];
    $achievement = $_POST["achievement"];
    $belt = $_POST["belt"];

    // Prepare and execute SQL statement to insert data into the database
    $sql = "INSERT INTO register (stud_id, full_name, email, phone_no, experience, achievement, belt)
            VALUES ('$id', '$full_name', '$email', '$nophone', '$experience', '$achievement', '$belt')";

    if ($conn->query($sql) === TRUE) {
        // Data inserted successfully
        echo "<script>alert('New record created successfully');</script>";
        echo "<script>window.location.href = 'viewUsers.php';</script>";
    } else {
        // Error occurred while inserting data
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
