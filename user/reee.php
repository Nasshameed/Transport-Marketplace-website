<?php
// Include the database configuration file
require_once "conn.php";

// Check if 'serial' is set in the request and handle it safely
if (isset($_REQUEST['serial'])) {
    // Get the serial from the request and escape it to prevent SQL injection
    $serial = intval($_REQUEST['serial']);
    $a = "reject";

    // Check if the form was submitted
   
        $sql = "UPDATE request SET status=? WHERE serial=?";

        // Initialize and prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("si", $a, $serial);

            // Execute the statement
            if ($stmt->execute()) {
                // Update successful, redirect or notify user
                echo "Record updated successfully.";
                header("Location: product.php"); // Change 'profile.php' to the actual profile page
                exit;
            } else {
                echo "Error updating record: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing the statement: " . $conn->error;
        }}
     
                ?>