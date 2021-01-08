<?php
    include 'template/header_cus.php';

    $searchmsg="";
    $con=mysqli_connect("localhost","root","","dbagent");
    $sqlall="SELECT * FROM hotel_view WHERE status='available'";
    $txtcheckin="";  
    $txtcheckout=""; 
    $txtcity="";      
    $txtcityname="";      
   
      if(isset($_REQUEST["btn"]))
      {
        $sqlall="";
          unset( $_SESSION["searchdata"]);
        $txtcheckin=$_REQUEST['txtcheckin'];
        $txtcheckout=$_REQUEST['txtcheckout'];
        $txtcity=$_REQUEST['txtcity'];
 
        $todaydate=(new DateTime())->format('Y-m-d ');

       // echo $todaydate;
        $diff=date_diff(date_create($todaydate),date_create($txtcheckin));
       $noofdays= $diff->format("%R%a");
      //  echo "<h4>$noofdays</h4>";
        if( $noofdays==0)
        {
            $searchmsg="<p class=text-danger >Check in date should not be same with today date</p>";
        }
        else if($noofdays<0)
        {
            $searchmsg= "<p class=text-danger >Check in date should not be less than today date</p>";
        

        }
        else
        {
            $_SESSION["searchdata"]["txtcheckin"]=$txtcheckin;
            $_SESSION["searchdata"]["txtcheckout"]=$txtcheckout;
            $_SESSION["searchdata"]["txtcity"]=$txtcity;
            $_SESSION["searchdata"]["txtcityname"]="";

            $sqlall="SELECT DISTINCT hv.hotelid,hv.hotelname,hv.cityname,hv.fullimage,r.roomid,r.facilities 
            From room as r ,hotel_view as hv WHERE  hv.hotelid=r.hotelid AND hv.cityid='$txtcity' AND r.roomid not IN(SELECT bd.roomid FROM `bookingdetail` as bd
             WHERE bd.checkindate<='$txtcheckin' AND bd.checkoutdate>'$txtcheckin' ) GROUP by hv.hotelid";
            
        }

         //$sql="SELECT * FROM 'bookingdetail' WHERE checkindate<='$txtcheckin' AND checkoutdate>'$txtcheckin' ";
      }
      if(isset($_SESSION["searchdata"]))
      {
          $txtcheckin= $_SESSION["searchdata"]["txtcheckin"];
          $txtcheckout= $_SESSION["searchdata"]["txtcheckout"];
          $txtcity=$_SESSION["searchdata"]["txtcity"];
          $txtcityname=$_SESSION["searchdata"]["txtcityname"];  
          $sqlall="SELECT DISTINCT hv.hotelid,hv.hotelname,hv.cityname,hv.fullimage,r.roomid,r.facilities 
          From room as r ,hotel_view as hv WHERE  hv.hotelid=r.hotelid AND hv.cityid='$txtcity' AND r.roomid not IN(SELECT bd.roomid FROM `bookingdetail` as bd
           WHERE bd.checkindate<='$txtcheckin' AND bd.checkoutdate>'$txtcheckin' ) GROUP by hv.hotelid";
          
        
      } 
?>
<section class="content">
    <div class="container">
        <!-- search box -->
        <div class="row">
            <div class="col-10 offset-1 searchbox">
              <form action="hoteldisplay.php" method="get">
                <div class="row">
                    <div class="col-4">
                    Check in
                       <input type="Date" name="txtcheckin" class="form-control" value="<?php 
                       if($txtcheckin!="")
                       {
                           echo $txtcheckin;
                       }
                       ?>" />
          
  
                    </div>
                    <div class="col-4">
                    Check out
                       <input type="Date" name="txtcheckout" class="form-control"
                       value="<?php 
                       if($txtcheckout!="")
                       {
                           echo $txtcheckout;
                       }
                       ?>"
                       />
                       
                    </div>
                    <div class="col-4">
                        City
                        <select name="txtcity" class="form-control browser-default custom-select">
                        
                        <?php
                                            $sql="SELECT * FROM city WHERE status='true'";
                                            $result=mysqli_query($con,$sql);
                                            $sqlstatus=false;
                                            while($data=mysqli_fetch_array($result))
                                            {
                                                echo '<option ';
                                                
                                                
                                                echo ' value="'.$data['cityid'].'" ';
                                               // $txtcity=""; 
                                                if( $txtcity==$data['cityid'])
                                                {
                                                      if(isset($_SESSION["searchdata"]))
                                                      {
                                                        $_SESSION["searchdata"]["txtcityname"]=$data['cityname'];
                                                      }
                                                   
                                                    $txtcityname=$data['cityname'];
                                                    echo ' selected ';

                                                }
                                                echo ' >'.$data['cityname'].'</option>';
                                               
                                            }
                                           
                                        ?>
                        </select>
                    </div>
                    <div class="col-4 offset-4">
                        <button class="btn btn-warning col-12" type="submit" name="btn">Search</button>
                    </div>
                </div>
              </form>
              <?php echo $searchmsg; ?>  
            </div>
        </div>

        <!-- hotel -->
        <div class="row">
            <div class="col-12">
            <?php
             if($txtcheckin!="")
             {
                 echo "<h2 align=left >Search Result with hotel </h2>";
             }
             else
             {

             
            ?>
                <h2>Available Hotels</h2>
                <?php
             }
                ?>
                <hr/>
            </div>
            
            <div class="col-12">
          <?php  if(isset($_REQUEST['msg']))
                {
                    echo "<h3 class=text-success > ".$_REQUEST['msg']."</h3><br/>";
                       
                }
                ?>
                <div class="row" style="padding-left: 120px;">
                    <?php
                // echo $sqlall."dddd";
              
                if($sqlall!="")
                  {
                        $result=mysqli_query($con,$sqlall);
                        while($data=mysqli_fetch_array($result))
                        {
                            $fullimage=$data['fullimage'];
                           $hotelid=$data['hotelid'];
                            $name=$data['hotelname'];
                            $city="(".$data['cityname'].")";
                            $box='<div class="col-3  hotelbox">';

                            $box.='<a href="roomdisplay.php?hotelid='.$hotelid.'">';
                            $box.='<table width="100%">';
                            $box.='<tr>';
                            $box.='<td><img src="'.$fullimage.'" width="100%" height="150px"/></td>';
                            $box.='</tr>';
                            $box.='<tr>';
                            $box.='<td><h4>'.$name.'</h4></td>';
                            $box.='</tr>';

                            $box.='<tr>';
                           $box.='<td><p>'.$city.'</p></td>';
                            $box.='</tr>';
                            $box.='</table>';
                            $box.='</a>';
                            $box.='</div>';
                            echo $box;
                            $sqlstatus=true;
                        }
                    }
                     
                        if( $sqlstatus==false)
                        {
                            echo "<h3 class=text-danger > No available hotel at current check in/out date and city!</h3>";
                        echo "<p class=text-danger >Sorry for any inconvenienc and thank you for interesting out site.</p>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include 'template/footer.php';
?>