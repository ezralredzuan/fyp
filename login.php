<?php
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

// Retrieve username and password from form submission
$username = $_POST['myusername'];
$password = $_POST['mypassword'];

// Sanitize user inputs to prevent SQL injection
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Hash the password for secure storage and comparison


// Query to check if the user exists in the database
$sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);



// Check if there's a result
if ($result->num_rows > 0) {
    // User exists, redirect to the homepage or some other page
    header("Location: adminmenu.php");
} else {
    // User doesn't exist or incorrect credentials, handle accordingly (e.g., display error message)
    echo "Invalid username or password";
}

// Close MySQL connection
$conn->close();
?>