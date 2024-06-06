 <?php 
                                    require_once "./assets/conn.php";
                                    if (isset($_GET['id'])) {
                                        // code...
                                        $id = $_GET['id'];
                                        $sql = "SELECT * FROM `user/company` where id = $id";
                                            $result = $conn->query($sql);
                                        $row = $result->fetch_assoc();?>
                                    
<section class="py-5 px-5">
    <div class="col-sm-12 col-xl-12 py-5">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4 text-uppercase">Users Account Details</h6>
                           
                            <img src="<?php //echo $row[image];?>" style="width:100px; height: 100px;">
                            <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <!-- <h6 class="mb-4">Responsive Table</h6> -->
                            <div class="table-responsive"> 
                                 <table id="userTable" class="table">
                                   
                                    <tbody class="text-uppercase">
                                        <tr>
                                            <td>Full Name : <?php echo $row['name'];?></td>
                                        </tr>
                                        <tr>
                                            <td>email : <?php echo $row['email'];?></td>
                                        </tr>
                                        <tr>
                                            <td>mobile number : <?php echo $row['phone'];?></td>
                                        </tr>
                                        <tr>
                                            <td>City : <?php echo $row['city'];?></td>
                                        </tr>
                                        <tr>
                                            <td>account Type : <?php echo $row['actype'];?></td>
                                        </tr>
                                        <tr>
                                            <td> <?php if ($row['actype']=="company"){
											echo "company Name :";
;										}else{
											echo "";
										}?> <?php echo $row['company_name'];?></td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <td>ID : <?php echo $row['id'];?></td>
                                        </tr>
                                        <tr>
                                       
                                        <tr>
                                            <td><a href="user.php" class="btn btn-danger small">Back &leftarrow;</td>
                                        </tr>
                                      <tr>
                                         
                                        <?php
                                        
                                             } else {
                                                 echo "<tr><td colspan='6'>No results found</td></tr>";
                                             }?>
                                                 
                                             </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                              
                        </div></div></section>
                        