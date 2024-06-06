<?php
require_once "./assets/conn.php";

$me = "";
$id = $image = $company_logo = "";
$name = $email = $phone = $cname = $city = $a_type = $password = $cpassword = "";
echo $city;
// Generate a random ID
for ($i = 0; $i < 3; $i++) {
    $id .= rand(0, 9);
}

if (isset($_POST['rate'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $cname = $_POST['cname'];
    $city = $_POST['city'];
    $a_type = $_POST['a_type'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    
    // Validate input fields
    if (empty($name)) {
        $me = "<p class='text-light' style='color:#f1f1f1 !important;'>Please Enter User Full Name.</p>";
    } elseif (empty($email)) {
        $me = "<p class='text-light' style='color:#f1f1f1 !important;'>Please Enter User E-mail Address.</p>";
    } elseif (empty($phone)) {
        $me = "<p class='text-light' style='color:#f1f1f1 !important;'>Please Enter User Mobile Number.</p>";
    } elseif (empty($cname) && $a_type == "company") {
        $me = "<p class='text-light' style='color:#f1f1f1 !important;'>Please Enter User Company Name.</p>";
    } elseif (empty($password)) {
        $me = "<p class='text-light' style='color:#f1f1f1 !important;'>Please Enter User Password.</p>";
    } elseif (empty($cpassword)) {
        $me = "<p class='text-light' style='color:#f1f1f1 !important;'>Please Enter User Confirm Password.</p>";
    } elseif ($cpassword !== $password) {
        $me = "<p class='text-light' style='color:#f1f1f1 !important;'>Passwords do not Match.</p>";
    } else {
        // Check if email, phone, or company name already exists
        $sql = "SELECT * FROM `user/company` WHERE email = ? OR phone = ? OR (company_name = ? AND company_name != '')";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $email, $phone, $cname);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                $me = "<p class='text-light' style='color:#f1f1f1 !important;'>Email, Phone, or Company Name already exists.</p>";
            } else {
                // Insert data into the database
                $sql = "INSERT INTO `user/company` (name, email, phone, city, actype, password, image, company_name, company_logo, id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("ssssssssss", $name, $email, $phone, $city, $a_type, $password, $image, $cname, $company_logo, $id);
                    if ($stmt->execute()) {
                        $me = "<p class='text-info'>User was added successfully.</p>";
                    } else {
                        $me = "<p class='text-danger' style='color:#f1f1f1 !important;'>Oops! Something went wrong. Please try again later.</p>";
                    }
                } else {
                    $me = "<p class='text-danger' style='color:#f1f1f1 !important;'>Error preparing statement: " . $conn->error . "</p>";
                }
            }
            $stmt->close();
        } else {
            $me = "<p class='text-danger' style='color:#f1f1f1 !important;'>Error preparing statement: " . $conn->error . "</p>";
        }
    }
//    $conn->close();
}
?>
<style>
	label{
		color:#f1f1f1;
	}
</style>

  <div class="container-fluid pt-4 px-4 bg-light">
	  <div class="container shadow p-5 rounded">
		   <div class="row g-4">
					<form method="post" action="">
						<div class="row">
							<div class="col-md-12 text-center py-3"><h3><i class="fa fa-users text-info"></i> Add Users</h3></div>
							<?php echo $me;?>
							<div class="col-md-6">
								<div class="form-group text-danger py-3"><label>Full Name</label></div>
								<div class="form-group">
									<input type="text" name="name" placeholder="Enter User Full Name Here." class="form-control" value="<?php echo $name?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group text-danger py-3"><label>E-mail Address</label></div>
								<div class="form-group">
									<input type="email" name="email" placeholder="Enter User E-mail Address Here." class="form-control" value="<?php echo $email?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group text-danger py-3"><label>Mobile Number</label></div>
								<div class="form-group">
									<input type="text" name="phone" placeholder="Enter User Mobile Number Here." class="form-control" value="<?php echo $phone?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group text-danger py-3"><label>Company Name</label></div>
								<div class="form-group">
									<input type="text" name="cname" placeholder="Enter User Company Name Here." class="form-control" value="<?php echo $cname?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group text-danger py-3"><label>City</label></div>
								<div class="form-group">
									<select name="city" class="form-control bg-dark" required>
										<option value="" disabled selected>Select Your City</option>
										<?php 
                             require_once "./assets/conn.php";
// SQL query to select all records from the "bank" table
$sql = "SELECT * FROM city";

// Execute the query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
      
        echo '<option value="'.$row['name'].'" class="text-capitalize">'.$row['name'].'</option>';
    
        
       
    }
} else {
    echo "<h1 class='text-danger'>No Account Details Added Yet</h1>";
}

// Close connection
$conn->close();

                             ?>
<!--
										<option value="">City</option>
										<option value="">City</option>
-->
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group text-danger py-3"><label>User/Company</label></div>
								<div class="form-group">
									<select name="a_type" class="form-control bg-dark" required>
										<option value="" disabled selected>Select Account Type</option>
										<option value="user">User</option>
										<option value="company">Company</option>
									</select>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group text-danger py-3"><label>Password</label></div>
								<div class="form-group">
									<input type="password" name="password" placeholder="Enter User Password Here." class="form-control" value="">
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group text-danger py-3"><label>confirm Password</label></div>
								<div class="form-group">
									<input type="password" name="cpassword" placeholder="Enter User confirm Password Here." class="form-control" value="">
								</div>
							</div>
							<div class="col-md-6">
<!--								<div class="form-group text-danger py-3"><label>Full Name</label></div>-->
								<div class="form-group py-4">
									<button name="rate" class="btn btn-danger">Save <i class="fa fa-database"></i></button>
								</div>
							</div>
							
						</div>
					
					</form>
					

	  </div>
	  </div>
               
	  </div>