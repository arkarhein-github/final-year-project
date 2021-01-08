<?php
    include 'template/header_ad.php';
    include 'template/autoid.php';

    $con=mysqli_connect("localhost","root","","dbagent");
    $hotelid=autoID("hotel","hotelid","H_",5,"H_00001");
    $hotelname="";
    $hoteladdress="";
    $cityid="";
    $fontimage="";
    $backimage="";
    $fullimage="";
    $status="";

    if(isset($_REQUEST['btnsave']))
    {
        $hotelid=$_REQUEST['txtid'];
        $hotelname=$_REQUEST['txthotelname'];
        $hoteladdress=$_REQUEST['txthoteladdress'];
        $cityid=$_REQUEST['txtcityid'];
        $status="available";
        if($_FILES["txtfontimage"]["name"]!="")
		{
			$img=$_FILES["txtfontimage"]["name"];
			$fontimage="image/upload/".$img;
			copy($_FILES["txtfontimage"]["tmp_name"],$fontimage);
        }

        if($_FILES["txtbackimage"]["name"]!="")
		{
			$img=$_FILES["txtbackimage"]["name"];
			$backimage="image/upload/".$img;
			copy($_FILES["txtbackimage"]["tmp_name"],$backimage);
        }

        if($_FILES["txtfullimage"]["name"]!="")
		{
			$img=$_FILES["txtfullimage"]["name"];
			$fullimage="image/upload/".$img;
			copy($_FILES["txtfullimage"]["tmp_name"],$fullimage);
        }

        $sql="INSERT INTO hotel
                VALUES ('$hotelid','$hotelname','$hoteladdress','$cityid','$fontimage','$backimage','$fullimage','$status')";
        mysqli_query($con,$sql);
        header("location:hotel.php?msg=Successfully Save");
        
    }

    if(isset($_REQUEST['did']))
    {
        $hotelid=$_REQUEST['did'];
        $sql="UPDATE hotel 
                SET status='close'
                WHERE hotelid='$hotelid'";
        mysqli_query($con,$sql);
        header("location:hotel.php?msg=Successfully Close");
    }

    if(isset($_REQUEST['aid']))
    {
        $hotelid=$_REQUEST['aid'];
        $sql="UPDATE hotel 
                SET status='available'
                WHERE hotelid='$hotelid'";
        mysqli_query($con,$sql);
        header("location:hotel.php?msg=Successfully Change");
    }

    if(isset($_REQUEST['eid']))
    {
        $hotelid=$_REQUEST['eid'];
        $sql="SELECT * FROM hotel WHERE hotelid='$hotelid'";
        $result=mysqli_query($con,$sql);
        while($data=mysqli_fetch_array($result))
        {
            $hotelname=$data['hotelname'];
            $hoteladdress=$data['hoteladdress'];
            $cityid=$data['cityid'];
            $fullimage=$data['fullimage'];
            $backimage=$data['backimage'];
            $fontimage=$data['fontimage'];
        }
    }
    if(isset($_REQUEST['btnupdate']))
    {
        $hotelid=$_REQUEST['txtid'];
        $sql="SELECT * FROM hotel WHERE hotelid='$hotelid'";
        $result=mysqli_query($con,$sql);
        while($data=mysqli_fetch_array($result))
        {
            
            $fullimage=$data['fullimage'];
            $backimage=$data['backimage'];
            $fontimage=$data['fontimage'];
        }
        $hotelname=$_REQUEST['txthotelname'];
        $hoteladdress=$_REQUEST['txthoteladdress'];
        $cityid=$_REQUEST['txtcityid'];
        $status="available";
        if($_FILES["txtfontimage"]["name"]!="")
		{
			$img=$_FILES["txtfontimage"]["name"];
			$fontimage="image/upload/".$img;
			copy($_FILES["txtfontimage"]["tmp_name"],$fontimage);
        }

        if($_FILES["txtbackimage"]["name"]!="")
		{
			$img=$_FILES["txtbackimage"]["name"];
			$backimage="image/upload/".$img;
			copy($_FILES["txtbackimage"]["tmp_name"],$backimage);
        }

        if($_FILES["txtfullimage"]["name"]!="")
		{
			$img=$_FILES["txtfullimage"]["name"];
			$fullimage="image/upload/".$img;
			copy($_FILES["txtfullimage"]["tmp_name"],$fullimage);
        }

        $sql="UPDATE hotel 
                SET hotelname='$hotelname',hoteladdress='$hoteladdress',cityid='$cityid',fullimage='$fontimage',backimage='$backimage',fullimage='$fullimage',status='$status'
                WHERE hotelid='$hotelid'";
        mysqli_query($con,$sql);
        header("location:hotel.php?msg=Successfully Update");

    }
?>
 <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-3 sidebar">
                    <h4>Entry</h4>
                    <a href="staff.php">Staff</a>
                    <a href="hotel.php" class="active">Hotel</a>
                    <a href="city.php">City</a>
                    <a href="room.php">Room</a>
                    <a href="roomtype.php">Room Type</a>
                    <a href="service.php">Service</a>
                </div>
                <div class="col-9 main-content">
                    <h2>Hotel</h2><hr/>
                    <p class="text-primary">
                        <?php
                            if(isset($_REQUEST['msg']))
                            {
                                echo $_REQUEST['msg'];
                            }
                        ?>
                    </p>
                    <form action="hotel.php" method="POST" enctype="multipart/form-data">
                        <table width="100%">
                            <tr>
                                <td></td>
                                <td>
                                    <input type="text" name="txtid" class="form-control" value="<?php echo $hotelid; ?>" readonly hidden>
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>
                                    <input type="text" name="txthotelname" class="form-control" value="<?php echo $hotelname;?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>
                                    <input type="text" name="txthoteladdress" class="form-control" value="<?php echo $hoteladdress;?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>
                                    <select name="txtcityid" class="form-control browser-default custom-select">
                                        <?php
                                            $sql="SELECT * FROM city WHERE status='true'";
                                            $result=mysqli_query($con,$sql);
                                            while($data=mysqli_fetch_array($result))
                                            {
                                                if($cityid==$data['cityid'])
                                                {
                                                    echo '<option value="'.$data['cityid'].'" selected>'.$data['cityname'].'</option>';
                                                }
                                                else{
                                                echo '<option value="'.$data['cityid'].'">'.$data['cityname'].'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Font Image</td>
                                <td>
                                   
                                        <input type="file"  name="txtfontimage">
                                       
                                </td>
                            </tr>
                            <tr>
                                <td>Back Image</td>
                                <td>
                                   
                                        <input type="file" name="txtbackimage">
                                       
                                </td>
                            </tr>
                            <tr>
                                <td>Full Image</td>
                                <td>
                                    
                                        <input type="file"  name="txtfullimage">
                                        
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
                                <th>Address</th>
                                <th>City</th>
                                <th>Font Image</th>
                                <th>Back Image</th>
                                <th>Full Image</th>
                                <th>Status</th>
                            </tr>
                            <?php
                                $sql="SELECT * FROM hotel_view";
                                $result=mysqli_query($con,$sql);
                                
                                while($data=mysqli_fetch_array($result))
                                {
                                    echo '<tr>';
                                    echo '<td>';
                                    
                                    echo '<a href="hotel.php?eid='.$data['hotelid'].'" style="display:block;width:100px;margin-bottom:10px" class="btn btn-primary">Edit</a>';
                                    
                                        if($data['status']!='close')
                                        {
                                            echo '<a href="hotel.php?did='.$data['hotelid'].'" style="display:block;width:100px" class="btn btn-danger">Close</a>';
                                        }
                                        if($data['status']!='available')
                                        {
                                            echo '<a href="hotel.php?aid='.$data['hotelid'].'" style="display:block;width:100px" class="btn btn-success">Available</a>';
                                        }
                                    
                                    
                                    echo '</td>';
                                   
                                    
                                        echo '<td>'.$data['hotelid'].'</td>';
                                        echo '<td>'.$data['hotelname'].'</td>';
                                        echo '<td>'.$data['hoteladdress'].'</td>';
                                        echo '<td>'.$data['cityname'].'</td>';
                                        echo '<td><img src="'.$data['fontimage'].'" width ="100" height="100"/></td>';
                                        echo '<td><img src="'.$data['backimage'].'" width ="100" height="100"/></td>';
                                        echo '<td><img src="'.$data['fullimage'].'" width ="100" height="100"/></td>';
                                        echo '<td>'.$data['status'].'</td>';
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