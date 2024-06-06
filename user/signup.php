<?php 
require_once "./conn.php";

// Define variables and initialize with empty values
$name = $email = $phone = $uc = $city = $password = $cpassword = $me = $cname = "";
$name_err = $email_err = $phone_err = $uc_err = $password_err = $cpassword_err = $me_err = $cname_err = $city_err = "";

// Generate a random ID
$id = "";
for ($i = 0; $i < 3; $i++) {
   $id .= rand(0, 9);
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Full Name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your full name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate Email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate Account Type (User/Company)
    if (empty(trim($_POST["uc"])) || $_POST["uc"] == "Select Your Account Type") {
        $uc_err = "Please select your account type.";
    } else {
        $uc = trim($_POST["uc"]);
    }
    
    // Validate Company Name if account type is company
    if ($uc == "company" && empty(trim($_POST["cname"]))) {
        $cname_err = "Please enter your company name.";
    } else {
        $cname = trim($_POST["cname"]);
    }

    // Validate Phone Number
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter your phone number.";
    } else {
        $phone = trim($_POST["phone"]);
    }

    // Validate City
    if (empty(trim($_POST["city"])) || $_POST["city"] == "Select Your City") {
        $city_err = "Please select your city.";
    } else {
        $city = trim($_POST["city"]);
    }

    // Validate Password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate Confirm Password
    if (empty(trim($_POST["cpassword"]))) {
        $cpassword_err = "Please confirm password.";
    } else {
        $cpassword = trim($_POST["cpassword"]);
        if (empty($password_err) && ($password != $cpassword)) {
            $cpassword_err = "Password did not match.";
        }
    }

    // Check if there are any errors before inserting into database
    if (empty($name_err) && empty($email_err) && empty($phone_err) && empty($uc_err) && empty($cname_err) && empty($password_err) && empty($cpassword_err) && empty($city_err)) {
        // Check if the email, phone number, or company name are unique
        $sql = "SELECT id FROM `user/company` WHERE email = ? OR phone = ? OR (company_name = ? AND company_name != '')";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $email, $phone, $cname);

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 0) {
                    // Insert data into database
                    $sql = "INSERT INTO `user/company` (name, email, phone, city, actype, password, company_name, id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param("ssssssss", $name, $email, $phone, $city, $uc, $password, $cname, $id);

                        if ($stmt->execute()) {
                            // Registration was successful
                            $me = "<p class='text-info'>Your registration was successful.</p>";
                        } else {
                            $me = "<p class='text-danger'>Oops! Something went wrong. Please try again later.</p>";
                        }
                    } else {
                        $me = "<p class='text-danger'>Error preparing insert statement: " . $conn->error . "</p>";
                    }
                } else {
                    if (!empty($cname)) {
                        $cname_err = "This company name is already taken.";
                    }
                    $email_err = "This email is already taken.";
                    $phone_err = "This phone number is already taken.";
                }
            } else {
                $me = "<p class='text-danger'>Oops! Something went wrong. Please try again later.</p>";
            }
            $stmt->close();
        } else {
            $me = "<p class='text-danger'>Error preparing select statement: " . $conn->error . "</p>";
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Transport Market Place</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
<!--
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
-->
        <!-- Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
								
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Transport</h3>
                            </a>
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >

                            <h3>Sign Up</h3>
								<?php echo $me;?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" id="floatingText" placeholder="Please Enter Your Full Name" value="<?php echo htmlspecialchars($name); ?>">
                <span class="text-danger"><?php echo $name_err; ?></span>
                            <label for="floatingText">Full Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo htmlspecialchars($email); ?>">
                <span class="text-danger"><?php echo $email_err; ?></span>
                            <label for="floatingInput">Email address</label>
                        </div>
						<div class="form-floating mb-3">
                            <input type="text" name="phone" class="form-control" id="floatingText" placeholder="Please Enter You Phone Number" value="<?php echo htmlspecialchars($phone); ?>">
                <span class="text-danger"><?php echo $phone_err; ?></span>
                            <label for="floatingText">Mbile Nmber</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="cname" class="form-control" id="floatingInput" placeholder="Please enter Your Company name Here." value="<?php echo htmlspecialchars($cname); ?>">
                <span class="text-danger"><?php echo $cname_err; ?></span>
                            <label for="floatingInput">Company Name</label>
                        </div>
						<div class="form-floating mb-3">
							<select name="uc" class="form-control" id="floatingInput" placeholder="Please enter Your Company name Here.">>
								<option value="" selected disabled>Select Your Acount Type</option>
								<option value="user">User</option>
								<option value="companey">Company Owner</option>
								
							</select><span class="text-danger"><?php echo $uc_err; ?></span>
                           
                            <label for="floatingInput">User/Company</label>
                        </div>
						<div class="form-floating mb-3">
							<select name="city" class="form-control" id="floatingInput" placeholder="Please enter Your Company name Here.">>
								<option value="" selected disabled>Select Your City</option>
								<?php 
                             require_once "./conn.php";
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
								
							</select><span class="text-danger"><?php echo $city_err; ?></span>
                           
                            <label for="floatingInput">Select Your City</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" value="<?php echo htmlspecialchars($password); ?>">
                <span class="text-danger"><?php echo $password_err; ?></span>
                            <label for="floatingPassword">Password</label>
                        </div> 
							<div class="form-floating mb-4">
                            <input type="password" name="cpassword" class="form-control" id="floatingPassword" placeholder="Password" value="<?php echo htmlspecialchars($cpassword); ?>">
                <span class="text-danger"><?php echo $cpassword_err; ?></span>
                            <label for="floatingPassword">Confirm Password</label>
                        </div>
                       
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                        <p class="text-center mb-0">Already have an Account? <a href="signin.php">Sign In</a></p>
							</form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
