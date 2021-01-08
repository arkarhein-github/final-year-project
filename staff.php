<?php
    include 'template/header_ad.php';
    include 'template/autoid.php';
    $con=mysqli_connect("localhost","root","","dbagent");
    $staffid=autoID("staff","staffid","S_",5,"S_00001");

    if(isset($_REQUEST['btnsave']))
    {
        $staffname=$_REQUEST['txtname'];
        $nrc=$_REQUEST['txtnrcno'];
        $gender=$_REQUEST['txtgender'];
        $position=$_REQUEST['txtposition'];
        $salary=$_REQUEST['txtsalary'];
        $dob=$_REQUEST['txtdateofbirth'];
        $phone=$_REQUEST['txtphone'];
        $address=$_REQUEST['txtaddress'];
        $email=$_REQUEST['txtemail'];
        $password=$_REQUEST['txtpassword'];

        $sql="INSERT INTO staff 
                VALUES ('$staffid','$staffname','$nrc','$gender','$position','$salary','$dob','$phone','$address','$email','$password')";

        mysqli_query($con,$sql);
        header("location:staff.php?msg=Successfully Save!");

    }
?>
                    
     <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-3 sidebar">
                    <h4>Entry</h4>
                    <a href="staff.php" class="active">Staff</a>
                    <a href="hotel.php">Hotel</a>
                    <a href="city.php">City</a>
                    <a href="room.php">Room</a>
                    <a href="roomtype.php">Room Type</a>
                    <a href="service.php">Service</a>
                </div>
                <div class="col-9 main-content">
                    <h2>Staff</h2><hr/>
                    <p class="text-primary">
                        <?php
                            if(isset($_REQUEST['msg']))
                            {
                                echo $_REQUEST['msg'];
                            }
                        ?>
                    </p>
                    <form action="staff.php" method="POST">
                        <table width="100%">
                            <tr>
                                <td></td>
                                <td>
                                    <input type="text" name="txtid" class="form-control" value="<?php echo $staffid; ?>" readonly hidden>
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>
                                    <input type="text" name="txtname" class="form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Nrc No</td>
                                <td>
                                    <input type="text" name="txtnrcno" class="form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>
                                    <input type="radio" name="txtgender" value="male"> Male
                                    <input type="radio" name="txtgender" value="female"> Female
                                </td>
                            </tr>
                            <tr>
                                <td>Position</td>
                                <td>
                                    <input type="text" name="txtposition" class="form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Salary</td>
                                <td>
                                    <input type="text" name="txtsalary" class="form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Date of Birth</td>
                                <td>
                                    <input type="date" name="txtdateofbirth" class="form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Phone No</td>
                                <td>
                                    <input type="text" name="txtphone" class="form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>
                                    <textarea name="txtaddress"  rows="3" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>
                                    <input type="email" name="txtemail" class="form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>
                                    <input type="password" name="txtpassword" class="form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button class="btn btn-warning col-2" name="btnsave">Save</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <div class="tablelist">
                        <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Nrc No</th>
                                <th>Gender</th>
                                <th>Position</th>
                                <th>Salary</th>
                                <th>Date of Birth</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Password</th>
                            </tr>
                            <?php
                                $sql="SELECT * FROM staff";
                                $result=mysqli_query($con,$sql);
                                
                                while($data=mysqli_fetch_array($result))
                                {
                                    echo '<tr>';
                                        echo '<td>'.$data['staffid'].'</td>';
                                        echo '<td>'.$data['staffname'].'</td>';
                                        echo '<td>'.$data['nrcno'].'</td>';
                                        echo '<td>'.$data['gender'].'</td>';
                                        echo '<td>'.$data['position'].'</td>';
                                        echo '<td>'.$data['salary'].'</td>';
                                        echo '<td>'.$data['dateofbirth'].'</td>';
                                        echo '<td>'.$data['phone'].'</td>';
                                        echo '<td>'.$data['address'].'</td>';
                                        echo '<td>'.$data['email'].'</td>';
                                        echo '<td>'.$data['password'].'</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </table>
                        </div>
                        
                    </div>
                    
                </div>
            </div>            
        </div>
     </section>   
     <?php
    include 'template/footer.php';
?>