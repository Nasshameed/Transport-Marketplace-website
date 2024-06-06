<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <?php
            // Include the database configuration file
            require_once "conn.php";
            
            // Prepare the SQL query
            $sql = "SELECT * FROM `user/company` WHERE actype = 'company' AND city = '$city'";
            
            // Execute the query
            $result = $conn->query($sql);

            // Check if there are results
            if ($result->num_rows > 0) {
                // Fetch and display each row
                while ($row = $result->fetch_assoc()) {
                    $name = htmlspecialchars($row['name']);
                    $phone = htmlspecialchars($row['phone']);
                    $city = htmlspecialchars($row['city']);
                    $email = htmlspecialchars($row['email']);
                    $image = htmlspecialchars($row['image']);
                    $company_logo = htmlspecialchars($row['company_logo']);
                    $company_name = htmlspecialchars($row['company_name']);
                    $ab_company = htmlspecialchars($row['ab_company']);
                    $id = htmlspecialchars($row['id']);
                    ?>

                   <a href="requet.php?id=<?php echo $id;?>"> <div class="pro" style="background: url('<?php echo $image; ?>'); background-position: center; background-size: cover; height: 30vh;">
                       
                       <div class="container">
                        <div style="display: flex; gap: 12px; align-content: center; align-items: center; justify-content: center;">
                            <div style="flex:1"><img src="<?php echo $company_logo; ?>" style="width: 60px; height: 60px; border-radius: 50%;"></div>
                             <div style="flex:1">
                                <h3 class="text-primary text-uppercase"><?php echo $company_name; ?></h3>
                                <textarea  class="text-left" style="width:100%; height: 20vh;">
                                    
                                    <?php echo $ab_company;?>
                                </textarea>
                             </div>
                            
                        </div>
                           
                       </div>
                   </div></a>
                        

                   

                <?php
                }
            } else {
                echo "<p>No company Found for Your City</p>";
            }
            
            // Free result set
            $result->free();
            
            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>
</div>
