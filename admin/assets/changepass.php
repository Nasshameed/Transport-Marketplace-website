<?php
//session_start();
require_once "./assets/conn.php";

$msg = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $opassword = $_POST['opassword'];
    $npassword = $_POST['npassword'];
    $cpassword = $_POST['cpassword'];

    // Check if new password and confirm password match
    if ($npassword != $cpassword) {
        $msg = "<p class='text-center text-danger'>Error: New password and confirm password do not match.</p>";
    } else {
        // Check if old password matches the current admin password
        $old_password_query = "SELECT password FROM  admin WHERE serial = 1"; // Assuming admin's id is 1
        $result = $conn->query($old_password_query);

        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $current_password = $row["password"];

                // Verify old password
                if (!password_verify($opassword, $current_password)) {
                    $msg = "<p class='text-center text-danger'>Error: Old password is incorrect.</p>";
                } else {
                    // Hash the new password
                    $hashed_password = password_hash($npassword, PASSWORD_DEFAULT);

                    // Update admin password in the database
                    $update_query = "UPDATE  admin SET password='$hashed_password'"; // Assuming admin's id is 1
                    if ($conn->query($update_query) === TRUE) {
                        $msg = "<p class='text-center text-success'>Password Changed Successfully.</p>";
                    } else {
                        $msg = "<p class='text-center text-danger'>Error updating admin password: " . $conn->error."</p>";
                    }
                }
            } else {
                $msg = "<p class='text-center text-danger'>Error: Admin record not found.</p>";
            }
        } else {
            $msg = "<p class='text-center text-danger'>Error: " . $conn->error."</p>";
        }
    }
}

// Close connection
//$conn->close();

?>

<section class="py-5 px-5">
	<div class="col-sm-12 col-xl-12 py-5">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4 text-uppercase">Change password</h6>
                            <?php echo $msg;?>
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Old Password</label>
                                    <input type="password" name="opassword" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Old Password">
                                    <div id="emailHelp" class="form-text">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">New Password</label>
                                    <input type="password" name="npassword" class="form-control" id="exampleInputPassword1" placeholder="New Password">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Confirm New Password</label>
                                    <input type="password" name="cpassword" class="form-control" id="exampleInputPassword1" placeholder="Confirm New Password">
                                </div>
                               
                                <button type="submit" class="btn btn-primary"><i class="fa fa-database"></i> Change Password</button>
                            </form>
                        </div>
                    </div>
</section>