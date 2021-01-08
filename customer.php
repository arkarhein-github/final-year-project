<?php
    include 'template/header_cus.php';
    include 'template/autoid.php';
    $con=mysqli_connect("localhost","root","","dbagent");
    $customerid=autoID("customer","customerid","C_",5,"C_00001");

    if(isset($_REQUEST['btnsave']))
    {
        $customername=$_REQUEST['txtname'];
        $nrc=$_REQUEST['txtnrcno'];
           
        $dob=$_REQUEST['txtdateofbirth'];
        $phone=$_REQUEST['txtphone'];
        $address=$_REQUEST['txtaddress'];
        $email=$_REQUEST['txtemail'];
        $password=$_REQUEST['txtpassword'];

        $sql="INSERT INTO customer 
                VALUES ('$customerid','$customername','$nrc','$address','$phone','$dob','$email','$password')";
                //echo $sql;
        $_SESSION['customer']=$customerid;
                mysqli_query($con,$sql);
       header("location:hoteldisplay.php");

    }
?>
                    
     <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <img src="image/siteimage/hotel.fw.png" class="img-fluid"/>
                </div>
                <div class="col-8 main-content">
                    <h2>Customer</h2><hr/>
                    <p class="text-primary">
                        <?php
                            if(isset($_REQUEST['msg']))
                            {
                                echo $_REQUEST['msg'];
                            }
                        ?>
                    </p>
                    <form action="customer.php" method="POST">
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
                                    <button class="btn btn-warning col-2" name="btnsave">Register</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                    
                </div>
            </div>            
        </div>
     </section>   
     <?php
    include 'template/footer.php';
?>