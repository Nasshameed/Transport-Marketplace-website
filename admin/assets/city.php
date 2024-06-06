<?php
require_once "./assets/conn.php";

$me = "";
//$id = $image = $company_logo = "";
$name = "";

// Generate a random ID
$date = date("Y-m-d");
if (isset($_POST['rate'])) {
    $name = $_POST['name'];
   
    
    // Validate input fields
    if (empty($name)) {
        $me = "<p class='text-light' style='color:#f1f1f1 !important;'>Please Enter City Name.</p>";
    } else {
        // Check if email, phone, or company name already exists
        $sql = "SELECT * FROM `city` WHERE name = ? ";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                $me = "<p class='text-light' style='color:#f1f1f1 !important;'>City Name already exists.</p>";
            } else {
                // Insert data into the database
                $sql = "INSERT INTO `city` (name, date) VALUES (?, ?)";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("ss", $name, $date);
                    if ($stmt->execute()) {
                        $me = "<p class='text-info'>City Name was added successfully.</p>";
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
							<div class="col-md-12 text-center py-3"><h3><i class="fa fa-users text-info"></i> Add City Name</h3></div>
							<?php echo $me;?>
							<div class="col-md-12">
								<div class="form-group text-danger py-3"><label>City Name</label></div>
								<div class="form-group">
									<input type="text" name="name" placeholder="Enter City Name Here." class="form-control" value="<?php echo $name?>">
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
		  
<section class="py-5 px-5">
    <div class="col-sm-12 col-xl-12 py-5">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4 text-uppercase">City</h6>
                            <script>
        function searchTable() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("userTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }
    </script>
                            <input type="text" class="form-control" id="searchInput" onkeyup="searchTable()" placeholder="Search for users..">
                            <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <!-- <h6 class="mb-4">Responsive Table</h6> -->
                            <div class="table-responsive"> 
                                 <table id="userTable" class="table">
                                      <?php 
									 require_once "./assets/conn.php";

// SQL query to select all users
$sql = "SELECT * FROM `city`";
$result = $conn->query($sql);
?>

                                    <thead>
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
<?php if ($result->num_rows > 0): ?>
    <?php
    // Output data of each row
    $serial = 0;
    while($row = $result->fetch_assoc()):
        $serial++;
    ?>
        <tr>
            <th scope="row"><?php echo htmlspecialchars($serial); ?></th>
            <td class="text-uppercase"><?php echo htmlspecialchars($row["name"]); ?></td>
            
        </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr>
        <td colspan="6">No results found</td>
    </tr>
<?php endif; ?>

<?php
$conn->close();
?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                              
                        </div></div></section>
	  </div>
               
	  </div>