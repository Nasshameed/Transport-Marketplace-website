<!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Transport</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="<?php echo  $userimage;?>" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-capitalize"><?php echo $name; ?></h6>
                        <span>
                            <?php if ($actype == "user") {
                                // code...
                                $u = "User";
                                echo "$u";
                            }else{
                                echo "Company Owner";
                            }?>
                        </span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

                    <?php if ($actype == "company") {
                        // code...
                        echo' <a href="product.php" class="nav-item nav-link"><i class="fa fa-laptop me-2"></i>User Request</a>';
                    }elseif ($actype == "user") {
                        // code...
                        echo' <a href="product.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Request</a>';
                    }else{
                        header("Location: ../sign-in.php");
                    }?>
                    
                    <!-- <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a> -->

                   
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->