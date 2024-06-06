<?php
require_once "conn.php";

$id_exists = false;

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    // Prepare and execute the SQL statement to get user/company info
    $sql = "SELECT * FROM `user/company` WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("s", $id);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            
            // Check if a record was found
            if ($result->num_rows == 1) {
                // Fetch the user data
                $row = $result->fetch_assoc();
                $email1 = $row["email"];
                $name1 = $row["name"];
                $phone1 = $row["phone"];
                $city1 = $row["city"];
                $actype1 = $row["actype"];
                $image1 = $row["image"];
                $company_name1 = $row["company_name"];
                $company_logo1 = $row["company_logo"];
                $id1 = $row["id"];
                $password1 = $row["password"];
                $userimage1 = $row["userimage"];
                $ab_company1 = $row["ab_company"];
                $id_exists = true;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error executing query: " . $stmt->error;
        }
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }
}

$date = date("Y-m-d");
$status = "pending";

// Check if the form is submitted and if $id exists
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"]) && $id_exists) {
    $message = trim($_POST["message"]);

    // Prepare and execute the SQL statement to insert the request
    $sql = "INSERT INTO `request` (name, company_name, user_id, company_id, date, status, message) VALUES (?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {

        // Bind parameters
        $stmt->bind_param("ssiiiss", $name1, $company_name1, $id33, $id1, $date, $status, $message); // assuming user_id is $id and company_id is $id1

        // Execute the statement
        if ($stmt->execute()) {
            echo "Request sent successfully.";
        } else {
            echo "Error sending request: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }

    // Close the connection
    // $conn->close();
}
?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <?php
            if ($id_exists) {
                // Prepare and execute the SQL statement to get existing request for this user
                $sql = "SELECT * FROM `request` WHERE user_id = ? AND company_name = ? AND company_id = ?";
                if ($stmt = $conn->prepare($sql)) {
                    // Bind parameters
                    $stmt->bind_param("ssi", $id33, $company_name1, $id1);

                    // Execute the statement
                    if ($stmt->execute()) {
                        // Get the result
                        $result = $stmt->get_result();

                        // Check if a record was found
                        if ($result->num_rows == 1) {
                            // Fetch the request data
                            $row = $result->fetch_assoc();
                            $name2 = $row["name"];
                            $message2 = $row["message"];
                            $status2 = $row["status"];
                            $company_name2 = $row["company_name"];
                            $company_id2 = $row["company_id"];
                            $uid2 = $row['user_id'];
                            echo "
                            <h1> Request to $company_name2</h1>
                            <p>message sent: $message2 </p>";
                            if ($status2 == "approved") {
                                // code...
                                 echo "
                                 <p>Status : <span class='text-success'>$status2</span></p>
                                   contact : $phone1
                                   <audio  autoplay>
    <source src='TLTSRXB-alert.mp3' type='audio/mp3'>
    <source src='TLTSRXB-alert.ogg' type='audio/ogg'>
</audio>
                                 ";
                            }elseif($status2 == "reject"){
                                echo " <p>Status : <span class='text-danger'>$status2</span></p>
                                 <audio  autoplay>
    <source src='TLTSRXB-alert.mp3' type='audio/mp3'>
    <source src='TLTSRXB-alert.ogg' type='audio/ogg'>
</audio>";


                            }else{
                                echo " <p>Status : <span class='text-warning'>$status2</span></p>
                                 <audio  autoplay>
    <source src='TLTSRXB-alert.mp3' type='audio/mp3'>
    <source src='TLTSRXB-alert.ogg' type='audio/ogg'>
</audio>";

                            }
                           
                        } else {
                            echo '<form method="post" action="">
                                    <h2 class="text-capitalize">Your request will be forwarded to "' . $company_name1 . '" Company</h2>
                                    <div class="form-group">Type Your Request</div>
                                    <div class="form-group py-3">
                                        <textarea name="message" class="form-control rounded shadow" style="height:20vh;">
                                            I am ' . $name1 . ', a ' . $actype1 . ' of "Transport Market Place". I am writing to request the opportunity to be your logistics driver for shipping goods to other cities. I am from ' . $city1 . ' city.
                                        </textarea>
                                    </div>
                                    <div class="form-group py-2">
                                        <button class="btn btn-primary" name="send">Send</button>
                                    </div>
                                  </form>';
                        }

                        // Close the statement
                        $stmt->close();
                    } else {
                        echo "Error executing query: " . $stmt->error;
                    }
                } else {
                    echo "Error preparing the statement: " . $conn->error;
                }
            } else {
                echo "<p>User/Company not found.</p>";
            }
            ?>
        </div>
    </div>
</div>
