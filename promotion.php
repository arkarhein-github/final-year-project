<?php
    include 'template/header_ad.php';
    include 'template/autoid.php';

    $con=mysqli_connect("localhost","root","","dbagent");
    $promotionid=autoID("promotion","promotionid","P_",5,"P_00001");

    if(isset($_REQUEST['btnsave']))
    {
        $promotionid=$_REQUEST['txtid'];
        $promotionname=$_REQUEST['txtname'];
        $startdate=$_REQUEST['txtstartdate'];
        $enddate=$_REQUEST['txtenddate'];
        $staffid=$_SESSION['staff'];
        $status='available';

       $sql="INSERT INTO promotion 
              VALUES ('$promotionid','$promotionname','$startdate','$enddate','$staffid','$status')";
        mysqli_query($con,$sql);

        if(isset($_SESSION['roomtypelist']))
        {
            $count=count($_SESSION['roomtypelist']);
            for($i=0;$i<$count;$i++)
            {
                $roomtypeid=$_SESSION['roomtypelist'][$i]['roomtypeid'];
                $percent=$_SESSION['roomtypelist'][$i]['percent'];
                $qry="INSERT INTO promotiondetail
                        VALUES ('$promotionid','$roomtypeid',$percent)";
                mysqli_query($con,$qry);
            }
        }

        unset($_SESSION['roomtypelist']);
        header("location:promotion.php?msg=Successfully Save");
    }
?>
<section class="content">
        <div class="container">
            <div class="row">
                
                <div class="col-12 main-content">
                    <h2>Promotion</h2><hr/>
                    <p class="text-primary">
                        <?php
                            if(isset($_REQUEST['msg']))
                            {
                                echo $_REQUEST['msg'];
                            }
                        ?>
                    </p>
                    <div class="row">
                        <div class="col-12">
                                <form action="promotion.php" method="POST" enctype="multipart/form-data">
                                <table width="100%">
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input type="text" name="txtid" class="form-control" value="<?php echo $promotionid; ?>" readonly hidden>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td>
                                            <input type="text" name="txtname" class="form-control" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Start Date</td>
                                        <td>
                                            <input type="date" name="txtstartdate" class="form-control" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>End Date</td>
                                        <td>
                                            <input type="date" name="txtenddate" class="form-control" required>
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
                                                        echo '<option value="'.$data['hotelid'].'">'.$data['hotelname'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <td></td>
                                        <td>
                                            <button class="btn btn-warning col-2" name="btnsave">Save</button>
                                        <!-- <button class="btn btn-secondary col-2" name="btnupdate">Update</button>-->
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <hr/>
                        </div>
                        
                        <div class="col-12">
                            <div class="row">
                                <div class="col-3">
                                    <h5>Room Types</h5>
                                    <select name="txtroomtypeid" size="7" class="form-control"  id="roomtype">
                                                <option></option>
                                            </select>
                                </div>
                                <div class="col-4">
                                <p id="error"></p>  
                                <table>
                                    <tr>
                                        <td>ID</td>
                                        <td>
                                            <input type="text" id="roomtypeid" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td>
                                            <input type="text" id="roomtypename" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Percent</td>
                                        <td>
                                            <select id="percent" class="form-control browser-default custom-select">
                                                <option>10</option>
                                                <option>20</option>
                                                <option>30</option>
                                                <option>40</option>
                                                <option>50</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <button id="add" class="btn btn-primary">Add</button>
                                        </td>
                                    </tr>
                                </table>                 
                                </div>
                                <div class="col-5">
                                            <div class="table-responsive" id="roomtypelist">
                                        <?php
                                            if(isset($_SESSION['roomtypelist']))
                                            {
                                                $count=count($_SESSION['roomtypelist']);
                                                $data='<table class="table">';
                                                $data .='<tr>';
                                                $data.='<th>ID</th><th>Room Type</th><th>Percent</th>';
                                                $data.='</tr>';
                                                for($i=0;$i<$count;$i++)
                                                {
                                                    $data .='<tr>';
                                                    //$data .='<td><a href="roomtypecontrol.php?removeroomtypeid='.$i.'" class="btn btn-danger">Remove</a></td>';
                                                    $data .='<td>'.$_SESSION['roomtypelist'][$i]['roomtypeid'].'</td>';
                                                    $data .='<td>'.$_SESSION['roomtypelist'][$i]['roomtypename'].'</td>';
                                                    $data .='<td>'.$_SESSION['roomtypelist'][$i]['percent'].'</td>';
                                                    $data .='</tr>';
                                                }
                                                $data.='</table>';
                                                echo $data;
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                                                 
                        
                        </div>
                    </div>
                    
                    <!--
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
                            -->      
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
               data:"hotelid="+hotelid+"&btntype=btntype",
               success:function(msg)
               {
                   
                   $('#roomtype').html(msg);
               }
           });
        });

        $('#roomtype').click(function(){
        
        var data=$('#roomtype').val();
        
        var tmp=data.split("&");
        var roomtypeid=tmp[0];
        var roomtypename=tmp[1];

        $('#roomtypeid').val(roomtypeid);
        $('#roomtypename').val(roomtypename);
        });

        $('#add').click(function(){
        
           
           var roomtypeid=$('#roomtypeid').val();
           var roomtypename=$('#roomtypename').val();
           var percent=$('#percent').val();
           
           
           $.ajax({
               type:"POST",
               url:"roomtypecontrol.php",
               data:"roomtypeid="+roomtypeid+"&roomtypename="+roomtypename+"&percent="+percent+"&action=btn",
               success:function(msg)
               {
                   
                   
                   var a=msg.split("&");
                   $('#roomtypelist').html(a[0]);
                   $('#error').html(a[1]);
                   
               }
           });
        });
    });
</script>