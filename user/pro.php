<?php
// Include the database configuration file
require_once "conn.php";

// Ensure $id33 is defined and properly escaped
// $id33 = isset($_GET['company_id']);
// echo $id33;
// Prepare the SQL query
$sql = "SELECT * FROM `request` WHERE company_id = $id33";

// Execute the query
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>User Name</th>
                        <th>Company Name</th>
                        <th>User ID</th>
                        <th>Company ID</th>
                        <th>Date</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are results
                    if ($result->num_rows > 0) {
                        // Fetch and display each row
                        $serial = 0;
                        while ($row = $result->fetch_assoc()) {
                            $serial++;
                            $name123 = htmlspecialchars($row["name"]);
                            $company_name123 = htmlspecialchars($row["company_name"]);
                            $user_id123 = htmlspecialchars($row["user_id"]);
                            $company_id123 = htmlspecialchars($row["company_id"]);
                            $date123 = htmlspecialchars($row["date"]);
                            $message123 = htmlspecialchars($row["message"]);
                            $status123 = htmlspecialchars($row["status"]);
                            $serial0 =htmlspecialchars($row["serial"]);
                            ?>
                            <tr>
                                <td><?php echo $serial; ?></td>
                                <td><?php echo $name123; ?></td>
                                <td><?php echo $company_name123; ?></td>
                                <td><?php echo $user_id123; ?></td>
                                <td><?php echo $company_id123; ?></td>
                                <td><?php echo $date123; ?></td>
                                <td><?php echo $message123; ?></td>
                                <td class="<?php  if ($status123 == "pending") {
                                    // code...
                                    echo"text-warning";
                                }elseif ($status123 == "reject") {
                                    // code...
                                    echo"text-danger";
                                }elseif ($status123 == "approved") {
                                    // code...
                                    echo"text-success";
                                }
                            ?>"><?php echo $status123; ?></td>
                                <td><a href="appp.php?serial=<?php echo $serial0;?>" class="btn btn-primary small">Approve Reuest</a></td>
                                <td><a href="reee.php?serial=<?php echo $serial0;?>" class="btn btn-danger small">Reject Request</a></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='9'>No records found</td></tr>";
                    }
                    // Free result set
                    $result->free();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
// Close the database connection
$conn->close();
?>
