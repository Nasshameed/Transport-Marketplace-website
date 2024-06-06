<?php 
//require_once "./header.php";
require_once "./conn.php";
$email = $me = $name = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $me = "<p class='text-danger'>Please enter your email.</p>";
    } else {
        $email = trim($_POST["email"]);
    }

    if (!empty($email)) {
        // Prepare and execute the SQL statement
        $sql = "SELECT * FROM `user/company` WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $email = $row["email"];
                    $password = $row["password"];
                    $name = $row["name"];
                } else {
                    $me = "<p class='text-danger'>No user with this email in our database.</p>";
                }
            } else {
                $me = "<p class='text-danger'>Oops! Something went wrong. Please try again later.</p>";
            }

            // Close the statement
            $stmt->close();
        } else {
            $me = "<p class='text-danger'>Oops! Something went wrong. Please try again later.</p>";
        }
    }

    // Close the database connection
    $conn->close();
}
?><!DOCTYPE html>
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
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Transport</h3>
                            </a>
                            <h6>forgotten Password</h6>
							<?php echo $me; ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                       
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Send</button>
							</form>
                        <p class="text-center mb-0">Don't have an Account? <a href="signin.php">Sign In</a></p>
						<?php 
            if (!empty($name) && !empty($email) && !empty($password)) {
                echo "<p class='text-capitalize'>Full Name: ". $name . "</p>";
                echo "<p class='text-capitalize'>E-mail: ". $email . "</p>";
                echo "<p class='text-capitalize'>Password: ". $password . "</p>";
            }
            ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
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