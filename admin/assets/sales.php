<?php
// Include config file
require_once "./assets/conn.php";

// Initialize total users variable
$total_users = 0;

// Attempt to fetch total number of users from user/company table
$sql = "SELECT COUNT(*) AS total_users FROM `user/company`";

if ($result = mysqli_query($conn, $sql)) {
    if ($row = mysqli_fetch_assoc($result)) {
        // Extract total number of users
        $total_users = $row['total_users'];
    } else {
        echo "No records found.";
    }
} else {
    echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
}

// Initialize total company variable
$total_company = 0;

// Attempt to fetch total number of users from user/company table
$sql = "SELECT COUNT(*) AS total_company FROM `user/company` where actype ='company'";

if ($result = mysqli_query($conn, $sql)) {
    if ($row = mysqli_fetch_assoc($result)) {
        // Extract total number of users
        $total_company = $row['total_company'];
    } else {
        echo "No records found.";
    }
} else {
    echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
}


// Initialize total users variable
$total_city = 0;

// Attempt to fetch total number of users from user/company table
$sql = "SELECT COUNT(*) AS total_city FROM `city` ";

if ($result = mysqli_query($conn, $sql)) {
    if ($row = mysqli_fetch_assoc($result)) {
        // Extract total number of users
        $total_city = $row['total_city'];
    } else {
        echo "No records found.";
    }
} else {
    echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
<!-- Sale & Revenue Start --> 
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-users fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Users</p>
                                <h6 class="mb-0"><?php echo number_format($total_users,2); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-map-marker fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Cities</p>
                                <h6 class="mb-0"><?php echo number_format($total_city,2); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Company</p>
                                <h6 class="mb-0"><?php echo number_format($total_company,2); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

