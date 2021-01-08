<?php
    include 'template/header_cus.php';
    $con=mysqli_connect("localhost","root","","dbagent");
    $txtcheckin="";
    $txtcheckout="";
    $txtcityname="";
    $txtcityid="";
    $hotelid="";
   
    if(isset($_REQUEST['hotelid']))
    {
        $hotelid=$_REQUEST['hotelid'];
        $hotelname="";
        $fullimage="";
        $backimage="";
        $fontimage="";
        $sql="SELECT * FROM hotel where hotelid='$hotelid'";
        $result=mysqli_query($con,$sql);
        if(0<mysqli_num_rows($result))
        {
            $data=mysqli_fetch_array($result);
            $hotelname=$data['hotelname'];
            $fullimage=$data['fullimage'];
            $fontimage=$data['fontimage'];
            $backimage=$data['backimage'];
        }

        
    }
    else{
        header("location:hoteldisplay.php");
    }
    $sqlall="SELECT *
    FROM `room_hotel_view` 
    WHERE status='available' 
    AND hotelid='$hotelid' 
    GROUP BY roomtypename";
    if(isset($_SESSION["searchdata"]))
    {
        $txtcheckin= $_SESSION["searchdata"]["txtcheckin"];
        $txtcheckout= $_SESSION["searchdata"]["txtcheckout"];
        $txtcityname=$_SESSION["searchdata"]["txtcityname"];
        $txtcityid=$_SESSION["searchdata"]["txtcity"];
           $hotelid=$_REQUEST['hotelid'];
$sqlall="SELECT * From room_hotel_view 
WHERE hotelid='$hotelid' AND status='available' 
AND roomid not IN 
(SELECT bd.roomid FROM `bookingdetail` as bd WHERE bd.checkindate<='$txtcheckin' AND bd.checkoutdate>'$txtcheckin' )
 GROUP BY roomtypeid";

 
    }
?>
<section class="content">
    <div class="container">
        <!-- hotel name -->
        <div class="row">
            <div class="col-12">
           <?php
            if(isset($_SESSION["searchdata"]))
    {
       
        echo "<h6 align=right class='mt-3 text-warning '>".$txtcheckin."-". $txtcheckout.",".$txtcityname."|<a href=hoteldisplay.php class=btn-link >Back To Hotel Search List</a></h6>";
      
    }
    else
    {
        echo '<a href=hoteldisplay.php class=btn-link >Back To Hotel Search List</a>';
    }
    
    
    ?>
                <h2><?php echo $hotelname ?> Hotel</h2><hr/>
            </div>
        </div>
        <!-- hotel image -->
        <div class="row">
            <div class="col-4">
                <img src="<?php echo $fullimage; ?>" width="100%" height="200px"/>
            </div>
            <div class="col-4">
                <img src="<?php echo $fontimage; ?>" width="100%" height="200px"/>
            </div>
            <div class="col-4">
                <img src="<?php echo $backimage; ?>" width="100%" height="200px"/>
            </div>
        </div>
        <!-- room type -->
        <div class="row">
            <?php
        
//CHECK SQL
//echo $sqlall;

                   $g=0;
                $result=mysqli_query($con,$sqlall);
                while($data=mysqli_fetch_array($result))
                {
                    $g++;
                    $date=date("yy-m-d");
                    $percent=0;
                    $roomtypeid=$data['roomtypeid'];
                    $roomtypename=$data['roomtypename'];
                    $discountprice=0;
                    $price=0;
                    $hotelfullimage="";
                    $hotelbackimage="";
                    $hotelfontimage="";
                    $roomcount=0;
                    $service="";
                    $availableroom="";



                    //AVAILABLE ROOM COUNT
                     if($txtcheckin!="")
                     {
                        $qry="SELECT count(roomid) AS count,fullimage,backimage,fontimage From room_hotel_view 
                        WHERE hotelid='$hotelid' AND status='available' AND roomtypeid='$roomtypeid'
                        AND roomid not IN 
                        (SELECT bd.roomid FROM `bookingdetail` as bd WHERE bd.checkindate<='$txtcheckin' AND bd.checkoutdate>'$txtcheckin' )
                        ";
                     }
                     else
                     {
                        $qry="SELECT count(roomid) AS count,fullimage,backimage,fontimage FROM `room_hotel_view` 
                        WHERE status='available' 
                        AND hotelid='$hotelid' 
                        AND roomtypeid='$roomtypeid'";
                     }
               
//echo "<br>$qry";
                /*    $qry="SELECT count(roomid) AS count,fullimage,backimage,fontimage FROM `room_hotel_view` 
                            WHERE status='available' 
                            AND hotelid='$hotelid' 
                            AND roomtypeid='$roomtypeid'";*/
                            
                    $r=mysqli_query($con,$qry);
                    if(0<mysqli_num_rows($r))
                    {
                        $a=mysqli_fetch_array($r);
                        $hotelfontimage=$a['fontimage'];
                        $hotelfullimage=$a['fullimage'];
                        $hotelbackimage=$a['backimage'];
                        $roomcount=$a['count'];
                    }
                    $availableroom="<select id=\"rno_$g\" name=\"room\" class=\"form-control browser-default custom-select\" style=\"width:100px\">";
                    for($i=0;$i<$roomcount;$i++)
                    {
                        $num=$i+1;
                        $availableroom.='<option>'.$num.'</option>';
                    }
                    if($roomcount==0)
                    {
                        $availableroom.='<option>0</option>';
                    }
                    $availableroom.='</select>';

                    $serviceqry="SELECT * FROM roomtype_view WHERE roomtypeid='$roomtypeid'";
                    $serviceresult=mysqli_query($con,$serviceqry);
                    $service='<ul>';
                    while($servicedata=mysqli_fetch_array($serviceresult))
                    {
                        $price=$servicedata['price'];
                        $service.='<li>'.$servicedata['servicename'].'</li>';
                        $promoqry="SELECT pd.percent FROM promotion p,promotiondetail pd
                                WHERE pd.roomtypeid='$roomtypeid'
                                AND p.promotionid=pd.promotionid
                                AND p.status='available'
                                AND p.startdate <= '$date'
                                AND p.enddate >= '$date'";
                             
                    $promoresult=mysqli_query($con,$promoqry);
                    if(mysqli_num_rows($promoresult)>0)
                    {
                        $pdata=mysqli_fetch_array($promoresult);
                        $percent=$pdata['percent'];
                        $discountprice=$price/100;
                        
                        $discountprice=$discountprice*$percent;
                        $discountprice=$price-$discountprice;
                        
                    }
                    }
                    $service.='</ul>';
                    $roombox='<div class="col-12">';
                    $roombox.='<div class="roomtypebox">';
                    $roombox.='<h4>'.$roomtypename.'</h4><hr/>';
                    $roombox.='<div class="row">';
                    $roombox.='<div class="col-4">';
                    $roombox.='<img src="'.$hotelfontimage.'" width="100%" height="200"/>';
                    $roombox.='</div>';
                    $roombox.='<div class="col-4">';
                    $roombox.='<img src="'.$hotelbackimage.'" width="100%" height="200"/>';
                    $roombox.='</div>';
                    $roombox.='<div class="col-4">';
                    $roombox.='<img src="'.$hotelfullimage.'" width="100%" height="200"/>';
                    $roombox.='</div>';
                    $roombox.='</div>';
                    $roombox.='<table width="100%">';
                    $roombox.='<tr>';
                    $roombox.='<thead><th>Services</th><th>Price</th><th>Available</th><th></th></thead>';
                    $roombox.='</tr>';
                    $roombox.='<tr>';
                    $roombox.='<tbody><td>'.$service.'</td>';
                    $roomprice=0;
                    if($discountprice==0)
                    {
                        $roombox.='<td>'.$price.' MMK</td>';
                        $roomprice=$price;
                    }
                    else{
                        $roomprice=$discountprice;
                        $roombox.='<td><del>'.$price.'</del> '.$discountprice.' MMK<p class="btn-danger col-4">'.$percent.'%</p></td>';
                    }
                    echo "<input type=hidden id=\"text_$g\" value=\"rid=$roomtypeid&cin=$txtcheckin&cout=$txtcheckout&rn=$roomtypename&cn=$txtcityname&act=add&h=$hotelname&rprice=$roomprice\" />";
                    $roombox.='<td>'.$availableroom.'</td>';
                    if( $txtcheckin!="")
                    {
                        $roombox.="<td><span id=\"$g\" class=\"btn spanbtn btn-warning\" style=\"width:150px\">Book</span></td>";
                    }
                 
                    $roombox.='</tbody>';
                    $roombox.='</tr>';
                    $roombox.='</table>';
                    
                    $roombox.='</div></div>';
                    echo $roombox;
                }
                
            ?>
        </div>
    </div>
</section>
<?php
include 'template/footer.php';
?>