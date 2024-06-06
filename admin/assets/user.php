
<section class="py-5 px-5">
    <div class="col-sm-12 col-xl-12 py-5">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4 text-uppercase">Users Information</h6>
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
$sql = "SELECT * FROM `user/company`";
$result = $conn->query($sql);
?>

                                    <thead>
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Mobile Number</th>
                                            <th scope="col">City</th>
                                            <th scope="col">Company Name</th>
                                            <th scope="col" colspan="3">Action</th>
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
            <td class="text-uppercase"><?php echo htmlspecialchars($row["email"]); ?></td>
            <td class="text-uppercase"><?php echo htmlspecialchars($row["phone"]); ?></td>
            <td class="text-uppercase"><?php echo htmlspecialchars($row["city"]); ?></td>
            <td class="text-uppercase"><?php echo htmlspecialchars($row["company_name"]); ?></td>
            <td class="text-uppercase">
                <a href="view-user-information.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-info small" title="View User Information">
                    <i class="fa fa-eye"></i>
                </a>
            </td>
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