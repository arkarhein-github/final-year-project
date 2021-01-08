<?php

    include 'template/header_ad.php';
    include 'template/autoid.php';

    $con=mysqli_connect("localhost","root","","dbagent");
    $roomtypeid=autoID("roomtype","roomtypeid","RT_",5,"RT_00001");
    $hotelid="";
    $roomtypename="";
    $price="";
    $noofperson="";  
    
    if(isset($_REQUEST['btnsave']))
    {
        $roomtypeid=$_REQUEST['txtid'];
        $roomtypename=$_REQUEST['txtname'];
        $hotelid=$_REQUEST['txthotelid'];
        $price=$_REQUEST['txtprice'];
        $noofperson=$_REQUEST['txtnoofperson'];
        $sql="INSERT INTO roomtype
                VALUES('$roomtypeid','$roomtypename',$price,$noofperson,'$hotelid','true')";
        mysqli_query($con,$sql);

        if(isset($_SESSION['servicelist']))
        {
            $count=count($_SESSION['servicelist']);
            for($i=0;$i<$count;$i++)
            {
                $serviceid=$_SESSION['servicelist'][$i]['serviceid'];
                $sql="INSERT INTO roomtypedetail
                VALUES('$roomtypeid','$serviceid')";
                mysqli_query($con,$sql);
            }
        }
        unset($_SESSION['servicelist']);
        header(("location:roomtype.php?msg=Successfully Save"));
       
    }

    if(isset($_REQUEST['did']))
    {
        $roomtypeid=$_REQUEST['did'];
        $sql="UPDATE roomtype
                SET status='false'
                WHERE roomtypeid='$roomtypeid'";
        mysqli_query($con,$sql);
        header(("location:roomtype.php?msg=Successfully Delete"));
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
                    <a href="roomtype.php"  class="active">Room Type</a>
                    <a href="service.php">Service</a>
                </div>
                <div class="col-9 main-content">
                    <h2>Room Type</h2><hr/>
                    <p class="text-primary">
                        <?php
                            if(isset($_REQUEST['msg']))
                            {
                                echo $_REQUEST['msg'];
                            }
                        ?>
                    </p>
                    <form action="roomtype.php" method="POST">
                        <table width="100%">
                            <tr>
                                <td></td>
                                <td>
                                    <input type="text" name="txtid" class="form-control" value="<?php echo $roomtypeid; ?>" readonly hidden>
                                </td>
                            </tr>
                            <tr>
                                <td>Hotel</td>
                                <td>
                                    <select name="txthotelid" class="form-control browser-default custom-select">
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
                                <td>Name</td>
                                <td>
                                    <input type="text" name="txtname" class="form-control" value="<?php echo $roomtypename;?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>
                                    <input type="text" name="txtprice" class="form-control" value="<?php echo $price;?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>No of Person</td>
                                <td>
                                    <input type="text" name="txtnoofperson" class="form-control" value="<?php echo $noofperson;?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Available Services</td>
                                <td>
                                    <div class="row">
                                        <div class="col-4">
                                        <p id="error" class="text-danger"></p>
                                            <select name="txtservice" id="service" class="form-control" size="5">
                                        
                                            <?php
                                                $sql="SELECT * FROM service WHERE status='true'";
                                                $result=mysqli_query($con,$sql);
                                                while($data=mysqli_fetch_array($result))
                                                {
                                                    echo '<option value="'.$data['serviceid'].'&'.$data['servicename'].'">'.$data['servicename'].'</option>';
                                                }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col-8 table-responsive" id="servicelist">
                                            
                                            <?php
                                                if(isset($_SESSION['servicelist']))
                                                {
                                                    $count=count($_SESSION['servicelist']);
                                                                            $data='<table class="table">';
                                                                            $data .='<tr>';
                                                                            $data.='<th></th><th>ID</th><th>Service</th>';
                                                                            $data.='</tr>';
                                                                            for($i=0;$i<$count;$i++)
                                                                            {
                                                                                $data .='<tr>';
                                                                                $data .='<td><a href="roomtypecontrol.php?removeid='.$i.'" class="btn btn-danger">Remove</a></td>';
                                                                                $data .='<td>'.$_SESSION['servicelist'][$i]['serviceid'].'</td>';
                                                                                $data .='<td>'.$_SESSION['servicelist'][$i]['servicename'].'</td>';
                                                                                $data .='</tr>';
                                                                            }
                                                                            $data.='</table>';
                                                    echo $data;
                                                }
                                            ?>
                                        </div>
                                    </div>
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
                                <th></th>
                                
                                <th>ID</th>
                                <th>Type</th>
                                
                                <th>Price</th>
                                <th>NO of Person</th>
                                <th>Services</th>
                                <th>Hotel</th>
                            </tr>
                            <?php
                                $sql="SELECT * FROM roomtype WHERE status='true'";
                                $result=mysqli_query($con,$sql);
                                
                                while($data=mysqli_fetch_array($result))
                                {
                                    echo '<tr>';
                                    echo '<td>
                                    
                                    <a href="roomtype.php?did='.$data['roomtypeid'].'" class="btn btn-danger" style="display:block;width:100px">Delete</a>
                                    </td>';
                                   
                                    
                                        echo '<td>'.$data['roomtypeid'].'</td>';
                                        echo '<td>'.$data['roomtypename'].'</td>';
                                        
                                        echo '<td>'.$data['price'].'</td>';
                                        echo '<td>'.$data['noofperson'].'</td>';
                                        echo '<td><ol>';
                                        $qry="SELECT * FROM roomtype_view WHERE roomtypeid='".$data['roomtypeid']."'";
                                        
                                        $hotelname="";
                                        $r=mysqli_query($con,$qry);
                                        while($a=mysqli_fetch_array($r))
                                        {
                                            $hotelname=$a['hotelname'];
                                            echo '<li>'.$a['servicename'].'</li>';
                                        }
                                        echo '</ol></td>';
                                        echo '<td>'.$hotelname.'</td>';
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
        $('#service').click(function(){
           var data=$('#service').val();
           var tmp=data.split("&");
           var serviceid=tmp[0];
           var servicename=tmp[1];
           
           $.ajax({
               type:"POST",
               url:"roomtypecontrol.php",
               data:"serviceid="+serviceid+"&servicename="+servicename+"&btn=btn",
               success:function(msg)
               {
                   var a=msg.split("&");
                   $('#servicelist').html(a[0]);
                   $('#error').html(a[1]);
               }
           });
        });
    });
</script>