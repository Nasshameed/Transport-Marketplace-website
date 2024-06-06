  <?php
// Database connection parameters
require_once "conn.php";

// SQL query to count the number of records in a table
$sql = "SELECT COUNT(*) AS count FROM request where company_id = $id";

// Execute the query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the result
    $row = $result->fetch_assoc();
    $who = number_format($row['count'],2);
} else {
    echo "0 results";
}


// SQL query to count the number of records in a table
$sql = "SELECT COUNT(*) AS count FROM request where company_id = $id AND status = 'approved'";

// Execute the query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the result
    $row = $result->fetch_assoc();
    $app = number_format($row['count'],2);
} else {
    echo "0 results";
}

// SQL query to count the number of records in a table
$sql = "SELECT COUNT(*) AS count FROM request where company_id = $id AND status = 'pending'";

// Execute the query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the result
    $row = $result->fetch_assoc();
    $pen = number_format($row['count'],2);
} else {
    echo "0 results";
}

// SQL query to count the number of records in a table
$sql = "SELECT COUNT(*) AS count FROM request where company_id = $id AND status = 'reject'";

// Execute the query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the result
    $row = $result->fetch_assoc();
    $re = number_format($row['count'],2);
} else {
    echo "0 results";
}

// Close the connection
$conn->close();
?>


  <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Request</p>
                                <h6 class="mb-0"><?php echo $who;?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Approved Request</p>
                                <h6 class="mb-0"><?php echo $app;?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Pending Request</p>
                                <h6 class="mb-0"><?php echo $pen;?></h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-th fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Rejected Request</p>
                                <h6 class="mb-0"><?php echo $re;?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->