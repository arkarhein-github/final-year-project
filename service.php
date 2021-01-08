<?php
    include 'template/header_ad.php';
    include 'template/autoid.php';

    $con=mysqli_connect("localhost","root","","dbagent");
    $serviceid=autoID("service","serviceid","Ser_",5,"Ser_00001");
    $servicename="";
    if(isset($_REQUEST['btnsave']))
    {
        $servicename=$_REQUEST['txtname'];
        $sql="INSERT INTO service
                VALUES ('$serviceid','$servicename','true')";
        mysqli_query($con,$sql);
        header("location:service.php?msg=Successfully Save");
    }

    if(isset($_REQUEST['eid']))
    {
        $serviceid=$_REQUEST['eid'];
        $sql="SELECT * FROM service WHERE serviceid='$serviceid'";
        $result=mysqli_query($con,$sql);
        if(0<mysqli_num_rows($result))
        {
            $data=mysqli_fetch_array($result);
            $servicename=$data['servicename'];
        }
    }

    if(isset($_REQUEST['btnupdate']))
    {
        $serviceid=$_REQUEST['txtid'];
        $servicename=$_REQUEST['txtname'];
        $sql="UPDATE service 
                SET servicename='$servicename'
                WHERE serviceid='$serviceid'";
        mysqli_query($con,$sql);
        header("location:service.php?msg=Successfully Update");
    }

    if(isset($_REQUEST['did']))
    {
        $serviceid=$_REQUEST['did'];
        $sql="UPDATE service 
                SET status='false'
                WHERE serviceid='$serviceid'";
        mysqli_query($con,$sql);
        header("location:service.php?msg=Successfully Delete");
    }



?>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-3 sidebar">
                    <h4>Entry</h4>
                    <a href="staff.php">Staff</a>
                    <a href="hotel.php">Hotel</a>
                    <a href="city.php">City</a>
                    <a href="room.php">Room</a>
                    <a href="roomtype.php">Room Type</a>
                    <a href="service.php"  class="active">Service</a>
                </div>
                <div class="col-9 main-content">
                    <h2>Service</h2><hr/>
                    <p class="text-primary">
                        <?php
                            if(isset($_REQUEST['msg']))
                            {
                                echo $_REQUEST['msg'];
                            }
                        ?>
                    </p>
                    <form action="service.php" method="POST">
                        <table width="100%">
                            <tr>
                                <td></td>
                                <td>
                                    <input type="text" name="txtid" class="form-control" value="<?php echo $serviceid; ?>" readonly hidden>
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>
                                    <input type="text" name="txtname" class="form-control" value="<?php echo $servicename;?>" required>
                                </td>
                            </tr>
                            
                            <tr>
                                <td></td>
                                <td>
                                    <button class="btn btn-warning col-2" name="btnsave">Save</button>
                                    <button class="btn btn-secondary col-2" name="btnupdate">Update</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <div class="tablelist">
                        <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th></th>
                                
                                <th>ID</th>
                                <th>Name</th>
                            </tr>
                            <?php
                                $sql="SELECT * FROM service WHERE status='true'";
                                $result=mysqli_query($con,$sql);
                                
                                while($data=mysqli_fetch_array($result))
                                {
                                    echo '<tr>';
                                    echo '<td>
                                    <a href="service.php?eid='.$data['serviceid'].'" class="btn btn-primary col-3">Edit</a>
                                    <a href="service.php?did='.$data['serviceid'].'" class="btn btn-danger col-3">Delete</a>
                                    </td>';
                                        echo '<td>'.$data['serviceid'].'</td>';
                                        echo '<td>'.$data['servicename'].'</td>';
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