<?php
session_start();
if(isset($_REQUEST['type']))
{
    unset($_SESSION['staff']);
    header("location:stafflogin.php");
}
$con=mysqli_connect("localhost","root","","dbagent");
if(isset($_REQUEST['btnlogin']))
{
    $email=$_REQUEST['txtemail'];
    $password=$_REQUEST['txtpassword'];
    $sql="SELECT * FROM staff
            WHERE email='$email' AND password='$password'";
           
    $result=mysqli_query($con,$sql);
    $row=mysqli_num_rows($result);
    if($row>0)
    {
        $data=mysqli_fetch_array($result);
        $_SESSION['staff']=$data['staffid'];
       header("location:dashboard.php");
    }else{
       header("location:stafflogin.php?msg=Invalid username and password");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <div class="container">
        <div class="row">
      
            <div class="col-4 offset-4"  style="margin-top:50x">
                <img src="image/siteimage/logo.fw.png" class="img-fluid">
            </div>
        
        </div>
        <div class="row">
                        <div class="col-4 offset-4" style="background:#17a2b8;border-radius:15px;padding: 20px;color:white;margin-top:20px">
                <h2 align="center">Login</h2><hr/>
                <p class="text-danger">
                <?php
                    if(isset($_REQUEST['msg']))
                    {
                        echo $_REQUEST['msg'];
                    }
                ?>
                </p>
                
                <form action="stafflogin.php" method="POST">
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
                    <r>
                        <td>
                            <button class="btn btn-warning col-12" name="btnlogin">Login</button>
                        </td>
                    </r>
                </table>
                </form>
                
            </div>
        </div>
    </div>
</body>
</html>