<?php 
if ($actype == "user") {
    // code...
    $cha = "col-md-12";
}else{
    $cha = "col-md-6";
}?>
 <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <form action="Profile.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 py-3">
                            <div class="form-group"><label>Full Name</label></div>
                            <div class="form-group">
                                <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" class="form-control text-capitalize">
                            </div>
                        </div>

                        <div class="col-md-6 py-3">
                            <div class="form-group"><label>Mobile Number</label></div>
                            <div class="form-group">
                                <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" class="form-control text-capitalize">
                            </div>
                        </div>

                        <div class="<?php echo $cha . " ";?> py-3">
                            <div class="form-group"><label>City</label></div>
                            <div class="form-group">
                                <input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>" class="form-control text-capitalize">
                            </div>
                        </div>

                        <div class="col-md-6 py-3" <?php if ($actype == "user") {
                            // code...
                            echo "style='display:none;'";
                        }?>>
                            <div class="form-group"><label>Company Banner Image</label></div>
                            <div class="form-group">
                                <input type="file" name="image" class="form-control text-capitalize" required>
                                <?php if (empty($image)) {
                                    echo "<span class='text-danger'>Please Choose an Image to Upload.</span>";
                                } else {
                                    echo '<img src="' . htmlspecialchars($image) . '" style="width:100px; height:100px;">';
                                } ?>
                            </div>
                        </div>

                        <div class="<?php echo $cha . " ";?>py-3">
                            <div class="form-group"><label>User Profile Image</label></div>
                            <div class="form-group">
                                <input type="file" name="uimage" class="form-control text-capitalize" required>
                                <?php if (empty($userimage)) {
                                    echo "<span class='text-danger'>Please Choose an Image to Upload.</span>";
                                } else {
                                    echo '<img src="' . htmlspecialchars($userimage) . '" style="width:100px; height:100px;">';
                                } ?>
                            </div>
                        </div>

                        <div class="col-md-6 py-3" <?php if ($actype == "user") {
                            // code...
                            echo "style='display:none;'";
                        }?>>
                            <div class="form-group"><label>Company Logo</label></div>
                            <div class="form-group">
                                <input type="file" name="clogo" class="form-control text-capitalize" required>
                                <?php if (empty($company_logo)) {
                                    echo "<span class='text-danger'>Please Choose an Image to Upload.</span>";
                                } else {
                                    echo '<img src="' . htmlspecialchars($company_logo) . '" style="width:100px; height:100px;">';
                                } ?>
                            </div>
                        </div>

                         <div class="col-md- 12 py-3" <?php if ($actype == "user") {
                             // code...
                            echo "style = 'display:none'";
                         }?>>
                            <div class="form-group"><label>Write About Your Company</label></div>
                            <div class="form-group">
                                <textarea class="rounded form-control shadow-3" style="height:20vh;" name="ab_company">
                                    <?php if (empty($ab_company)) {
                                        // code...
                                        echo "$company_name is a";
                                    }elseif (!empty($ab_company)) {
                                        // code...
                                        echo $ab_company;
                                    }?>
                                </textarea>
                            </div>
                        </div>

                        <div class="col-md-12 py-4">
                            <h5>Change Login Details</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"><label>E-mail Address</label></div>
                                    <div class="form-group">
                                        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" class="form-control text-capitalize">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group"><label>Password</label></div>
                                    <div class="form-group">
                                        <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>" class="form-control text-capitalize">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">


                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary py-2 rounded-5 shadow" name="update">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
