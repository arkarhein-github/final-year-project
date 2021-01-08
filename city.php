<?php
    include 'template/header_ad.php';
    include 'template/autoid.php';

    $con=mysqli_connect("localhost","root","","dbagent");
    $cityid=autoID("city","cityid","CT_",5,"CT_00001");
    $cityname="";
    if(isset($_REQUEST['btnsave']))
    {
        $cityname=$_REQUEST['txtname'];
        $sql="INSERT INTO city
                VALUES ('$cityid','$cityname','true')";
        mysqli_query($con,$sql);
        header("location:city.php?msg=Successfully Save");
    }

    if(isset($_REQUEST['eid']))
    {
        $cityid=$_REQUEST['eid'];
        $sql="SELECT * FROM city WHERE cityid='$cityid'";
        $result=mysqli_query($con,$sql);
        if(0<mysqli_num_rows($result))
        {
            $data=mysqli_fetch_array($result);
            $cityname=$data['cityname'];
        }
    }

    if(isset($_REQUEST['btnupdate']))
    {
        $cityid=$_REQUEST['txtid'];
        $cityname=$_REQUEST['txtname'];
        $sql="UPDATE city 
                SET cityname='$cityname'
                WHERE cityid='$cityid'";
        mysqli_query($con,$sql);
        header("location:city.php?msg=Successfully Update");
    }

    if(isset($_REQUEST['did']))
    {
        $cityid=$_REQUEST['did'];
        $sql="UPDATE city 
                SET status='false'
                WHERE cityid='$cityid'";
        mysqli_query($con,$sql);
        header("location:city.php?msg=Successfully Delete");
    }



?>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-3 sidebar">
                    <h4>Entry</h4>
                    <a href="staff.php">Staff</a>
                    <a href="hotel.php">Hotel</a>
                    <a href="city.php" class="active">City</a>
                    <a href="room.php">Room</a>
                    <a href="roomtype.php">Room Type</a>
                    <a href="service.php">Service</a>
                </div>
                <div class="col-9 main-content">
                    <h2>City</h2><hr/>
                    <p class="text-primary">
                        <?php
                            if(isset($_REQUEST['msg']))
                            {
                                echo $_REQUEST['msg'];
                            }
                        ?>
                    </p>
                    <form action="city.php" method="POST">
                        <table width="100%">
                            <tr>
                                <td></td>
                                <td>
                                    <input type="text" name="txtid" class="form-control" value="<?php echo $cityid; ?>" readonly hidden>
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>
                                    <input type="text" name="txtname" class="form-control" value="<?php echo $cityname;?>" required>
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
                                $sql="SELECT * FROM city WHERE status='true'";
                                $result=mysqli_query($con,$sql);
                                
                                while($data=mysqli_fetch_array($result))
                                {
                                    echo '<tr>';
                                    echo '<td>
                                    <a href="city.php?eid='.$data['cityid'].'" class="btn btn-primary col-3">Edit</a>
                                    <a href="city.php?did='.$data['cityid'].'" class="btn btn-danger col-3">Delete</a>
                                    </td>';
                                        echo '<td>'.$data['cityid'].'</td>';
                                        echo '<td>'.$data['cityname'].'</td>';
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