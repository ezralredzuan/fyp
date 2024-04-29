<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="adminstyle.css">
</head>
<input type="checkbox" id="checkbox">
    <header class="header">
        <h2 class="u-name">TAEKWONDO<b>UPTM</b>
            <label for="checkbox">
                <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
            </label>
        </h2>
        <i class="fa fa-user" aria-hidden="true"></i>
    </header>
<body>

    <div class="body">
        <nav class="side-bar">
            <div class="user-p">
                <img src="">
                <h4>Permata Chalet</h4>
            </div>
            <ul>
                <li>
                    <a href="adminmenu.php">
                        <i class="fa fa-desktop" aria-hidden="true"></i>
                        <span>DashBoard</span>
                    </a>
                </li>
                <li>
                    <a href="viewUsers.php">
                        <i class="fa fa-desktop" aria-hidden="true"></i>
                        <span>View list</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fa fa-power-off" aria-hidden="true"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <section class="section-1">
            <!-- Welcome admin alert -->
            <div class="welcome-alert">
                <p>Welcome, Admin!</p>
            </div>
            <!-- Total registered users box -->
            <div class="registered-users-box">
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

                // Execute SQL query to count the number of registered users
                $sql = "SELECT COUNT(*) AS total_users FROM register";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    // Output the count of registered users
                    $row = $result->fetch_assoc();
                    echo "<p>Total registered users: " . $row["total_users"] . "</p>";
                } else {
                    echo "No registered users found.";
                }

                // Close MySQL connection
                $conn->close();
                ?>
            </div>
        </section>
    </div>
</body>
</html>
