<?php
include 'template/header_cus.php';

if(isset($_REQUEST['type']))
{
    unset($_SESSION['customer']);
    unset($_SESSION["searchdata"]);
    unset($_SESSION['cart']);
    header("location:customerlogin.php");
}
$con=mysqli_connect("localhost","root","","dbagent");
if(isset($_REQUEST['btnlogin']))
{
    $email=$_REQUEST['txtemail'];
    $password=$_REQUEST['txtpassword'];
    $sql="SELECT * FROM customer
            WHERE email='$email' AND password='$password'";
           
    $result=mysqli_query($con,$sql);
    $row=mysqli_num_rows($result);
    if($row>0)
    {
        $data=mysqli_fetch_array($result);
        $_SESSION['customer']=$data['customerid'];
        if(isset($_SESSION['cart']))
        {
            header("location:checkout.php");
        }
        else{
            header("location:hoteldisplay.php");
        }
       
    }else{
       header("location:customerlogin.php?msg=Invalid username and password");
    }
}
?>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-4 offset-4" style="background:#17a2b8;border-radius:15px;padding: 20px;color:white;margin-top:50px">
                <h2 align="center" style="color:white;">Login</h2><hr/>
                <p class="text-danger">
                <?php
                    if(isset($_REQUEST['msg']))
                    {
                        echo $_REQUEST['msg'];
                    }
                ?>
                </p>
                
                <form action="customerlogin.php" method="POST">
                <table width=100% >
                    <tr>
                        <td>
                            <input type="text" name="txtemail" placeholder="Email" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" name="txtpassword" placeholder="password" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="btn btn-warning col-12" name="btnlogin">Login</button>
                        </td>
                    </tr>
                    
                </table>
                If you have no account, Please <a href="customer.php" class="text-warning">Register</a>
                </form>
                
            </div>
        </div>
    </div>
</section>
        <?php
include 'template/footer.php';
?>