<?php
// delete_order.php

include_once "./connection.php";

// Check if order ID is provided via GET request
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $orderId = $_GET['id'];

    // SQL query to delete the order with provided ID
    $sql = "DELETE FROM register WHERE stud_id = '$orderId'";

    if ($conn->query($sql) === TRUE) {
        // Return a success message
        echo "<script>alert('Order have been successfully deleted');</script>";
        echo "<script>window.location.href = 'viewUsers.php';</script>";
    } else {
        // Return an error message
        echo "Error deleting order: " . $conn->error;
    }
} else {
    // If no order ID is provided, return an error message
    echo "No order ID provided";
}

$conn->close();
?>