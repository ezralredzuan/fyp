<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish connection to MySQL
    $servername = "localhost";
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $database = "taekwondo"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve data from POST request
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $phoneNO = $_POST['phoneno'];
    $experience = $_POST['experience'];
    $achievement = $_POST['achievement'];
    $belt = $_POST['belt']; // Added to retrieve number of adults

    // Function to generate random ID with format "O01"
    function generateRandomID() {
        $randomNumber = rand(1, 99);
        $formattedID = sprintf("O%02d", $randomNumber);
        return $formattedID;
    }

    // Generate random ID
    $id = generateRandomID();

    // Prepare and execute SQL statement to insert data into the customer_booking table
    $sql = "INSERT INTO register (stud_id, full_name, email, phone_no, experience, achievement, belt) 
            VALUES ('$id', '$name', '$email', '$phoneNO', '$experience', '$achievement', '$belt')";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close MySQL connection
    $conn->close();
}
?>
