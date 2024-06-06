<?php 
require_once "./assets/conn.php";
// Get serial number from the request or form
$serial = $_GET['id']; // Assuming it comes from a form or request

// SQL query to delete record based on serial number
$sql = "DELETE  FROM `user/company` WHERE id = '$serial'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    header("Location: delete_user.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

// Close connection
$conn->close();
?>