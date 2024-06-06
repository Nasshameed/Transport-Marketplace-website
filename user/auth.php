<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("Location: ../sign-in.php");
    exit;
}

// Include the database configuration file
require_once "conn.php";

// Securely retrieve the username from the session
$session_username = $_SESSION["username"];

// Prepare and execute the SQL statement
$sql = "SELECT * FROM `user/company` WHERE email = ?";
if ($stmt = $conn->prepare($sql)) {
    // Bind parameters
    $stmt->bind_param("s", $session_username);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Get the result
        $result = $stmt->get_result();
        
        // Check if a record was found
        if ($result->num_rows == 1) {
            // Fetch the user data
            $row = $result->fetch_assoc();
            $email = $row["email"];
            $name = $row["name"];
            $phone = $row["phone"];
            $city = $row["city"];
            $actype = $row["actype"];
            $image = $row["image"];
            $company_name = $row["company_name"];
            $company_logo = $row["company_logo"];
            $id = $row["id"];
            $id33 = $row["id"];
            $password = $row["password"];
            $userimage = $row["userimage"];
            $ab_company = $row["ab_company"];
        } else {
            // Redirect to login page if no record found
            header("Location: sign-in.php");
            exit;
        }
    } else {
        // Handle execution errors
        echo "Oops! Something went wrong. Please try again later.";
        exit;
    }
    
    // Close the statement
    $stmt->close();
} else {
    // Handle SQL preparation errors
    echo "Oops! Something went wrong. Please try again later.";
    exit;
}

// Close the connection
// $conn->close();
?>