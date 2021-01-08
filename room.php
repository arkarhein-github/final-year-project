<?php
    include 'template/header_ad.php';
    include 'template/autoid.php';

    $con=mysqli_connect("localhost","root","","dbagent");
    $roomid=autoID("room","roomid","R_",5,"R_00001");
    $roomno="";
    $roomtypeid="";
    $hotelid="";
    $facilities="";
    $fontimage="";
    $backimage="";
    $fullimage="";
    $status="";

    if(isset($_REQUEST['btnsave']))
    {
        $roomid=$_REQUEST['txtid'];
        $roomno=$_REQUEST['txtroomno'];
        $hotelid=$_REQUEST['txthotelid'];
        $roomtypeid=$_REQUEST['txtroomtypeid'];
        $facilities=$_REQUEST['txtfacilities'];
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

        $sql="INSERT INTO room
                VALUES ('$roomid','$roomno','$roomtypeid','$hotelid','$facilities','$fontimage','$backimage','$fullimage','$status')";
        mysqli_query($con,$sql);
        header("location:room.php?msg=Successfully Save");
        
    }

    if(isset($_REQUEST['did']))
    {
        $roomid=$_REQUEST['did'];
        $sql="UPDATE room 
                SET status='close'
                WHERE roomid='$roomid'";
        mysqli_query($con,$sql);
        header("location:room.php?msg=Successfully Close");
    }

    if(isset($_REQUEST['aid']))
    {
        $roomid=$_REQUEST['aid'];
        $sql="UPDATE room 
                SET status='available'
                WHERE roomid='$roomid'";
        mysqli_query($con,$sql);
        header("location:room.php?msg=Successfully Change");
    }
    if(isset($_REQUEST['eid']))
    {
        $roomid=$_REQUEST['eid'];
        $sql="SELECT * FROM room WHERE roomid='$roomid'";
        $result=mysqli_query($con,$sql);
        while($data=mysqli_fetch_array($result))
        {
            $roomno=$data['roomno'];
            $facilities=$data['facilities'];
            $hotelid=$data['hotelid'];
            $fullimage=$data['fullimage'];
            $backimage=$data['backimage'];
            $fontimage=$data['fontimage'];
        }
    }

    if(isset($_REQUEST['btnupdate']))
    {
        $roomid=$_REQUEST['txtid'];
        $sql="SELECT * FROM room WHERE roomid='$roomid'";
        $result=mysqli_query($con,$sql);
        while($data=mysqli_fetch_array($result))
        {
            $fullimage=$data['fullimage'];
            $backimage=$data['backimage'];
            $fontimage=$data['fontimage'];
        }
        $roomno=$_REQUEST['txtroomno'];
        $hotelid=$_REQUEST['txthotelid'];
        $roomtypeid=$_REQUEST['txtroomtypeid'];
        $facilities=$_REQUEST['txtfacilities'];
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

        $sql="UPDATE room
                SET roomno='$roomno',roomtypeid='$roomtypeid',hotelid='$hotelid',facilities='$facilities',fontimage='$fontimage',backimage='$backimage',fullimage='$fullimage',status='$status'
                WHERE roomid='$roomid'";
       // echo $sql;
       mysqli_query($con,$sql);
       header("location:room.php?msg=Successfully Updated");

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
                    <a href="room.php" class="active">Room</a>
                    <a href="roomtype.php">Room Type</a>
                    <a href="service.php">Service</a>
                </div>
                <div class="col-9 main-content">
                    <h2>Room</h2><hr/>
                    <p class="text-primary">
                        <?php
                            if(isset($_REQUEST['msg']))
                            {
                                echo $_REQUEST['msg'];
                            }
                        ?>
                    </p>
                    <form action="room.php" method="POST" enctype="multipart/form-data">
                        <table width="100%">
                            <tr>
                                <td></td>
                                <td>
                                    <input type="text" name="txtid" class="form-control" value="<?php echo $roomid; ?>" readonly hidden>
                                </td>
                            </tr>
                            <tr>
                                <td>Room No</td>
                                <td>
                                    <input type="text" name="txtroomno" class="form-control" value="<?php echo $roomno;?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Hotel</td>
                                <td>
                                   
                                    <select name="txthotelid" class="form-control browser-default custom-select" id='hotel'>
                                        <?php
                                            $sql="SELECT * FROM hotel WHERE status='available'";
                                            $result=mysqli_query($con,$sql);
                                            while($data=mysqli_fetch_array($result))
                                            {
                                                if($hotelid==$data['hotelid'])
                                                {
                                                    echo '<option value="'.$data['hotelid'].'" selected>'.$data['hotelname'].'</option>';
                                                }
                                                else{
                                                    echo '<option value="'.$data['hotelid'].'">'.$data['hotelname'].'</option>';
                                                }
                                                
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Room Type</td>
                                <td id="roomtype">
                                    
                                    <select name="txtroomtypeid" class="form-control browser-default custom-select">
                                        
                                        <?php
                                        if($hotelid!="")
                                        {
                                            $sql="SELECT * FROM roomtype WHERE hotelid='$hotelid'";
                                            $result=mysqli_query($con,$sql);
                                            while($data=mysqli_fetch_array($result))
                                            {
                                                echo '<option value="'.$data['roomtypeid'].'">'.$data['roomtypename'].'</option>';
                                            }   
                                        }
                                        else{
                                            echo '<option></option>';
                                        }
                                        
                                    ?>
                                    </select>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Facilities</td>
                                <td>
                                    <textarea name="txtfacilities"  rows="5" class="form-control" required><?php echo $facilities;?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Font Image</td>
                                <td>
                                   
                                        <input type="file"  name="txtfontimage" >
                                       
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
                                <th>Room No</th>
                                <th>Room Type</th>
                                <th>Hotel</th>
                                <th>Facilities</th>
                                <th>Font Image</th>
                                <th>Back Image</th>
                                <th>Full Image</th>
                               
                                <th>Status</th>
                            </tr>
                            <?php
                                $sql="SELECT * FROM room_hotel_view";
                                $result=mysqli_query($con,$sql);
                                
                                while($data=mysqli_fetch_array($result))
                                {
                                    echo '<tr>';
                                    echo '<td>';
                                    
                                    echo '<a href="room.php?eid='.$data['roomid'].'" style="display:block;width:100px;margin-bottom:10px" class="btn btn-primary">Edit</a>';
                                    
                                        if($data['status']!='close')
                                        {
                                            echo '<a href="room.php?did='.$data['roomid'].'" style="display:block;width:100px" class="btn btn-danger">Close</a>';
                                        }
                                        if($data['status']!='available')
                                        {
                                            echo '<a href="room.php?aid='.$data['roomid'].'" style="display:block;width:100px" class="btn btn-success">Available</a>';
                                        }
                                    
                                    
                                    echo '</td>';
                                   
                                    
                                        echo '<td>'.$data['roomid'].'</td>';
                                        echo '<td>'.$data['roomno'].'</td>';
                                        echo '<td>'.$data['roomtypename'].'</td>';
                                        echo '<td>'.$data['hotelname'].'</td>';
                                        echo '<td>'.$data['facilities'].'</td>';
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
<script type="text/javascript">
    $(document).ready(function(e){
        $('#hotel').click(function(){
           var hotelid=$('#hotel').val();
           
           
           $.ajax({
               type:"POST",
               url:"roomtypecontrol.php",
               data:"hotelid="+hotelid+"&btnroomtype=btnroomtype",
               success:function(msg)
               {
                   
                   $('#roomtype').html(msg);
               }
           });
        });
    });
</script>