<?php
    include 'template/header_cus.php';
    include 'template/autoid.php';
    $con=mysqli_connect("localhost","root","","dbagent");
    $customerid="";
    $date=date("yy-m-d");
    if(isset($_SESSION['customer']))
    {
        $customerid=$_SESSION['customer'];
    }
    else{
        header("location:customerlogin.php?msg=Please Login First");
    }

   
   $totalamount=0;
   if(isset($_SESSION['cart']))
   {
       $count=count($_SESSION['cart']);
       for($i=0;$i<$count;$i++)
       {
           $totalamount=$totalamount+$_SESSION['cart'][$i]['amount'];
       }
   }
  
    $bookingid=autoID("booking","bookingid","bk_",7,"bk_0000001");
    
    if(isset($_REQUEST['btnsave']))
    {
        //for commision
        $commisionid=autoID("commision","commisionid","Com_",7,"Com_0000001");
        $commisionpercent=5;
        $commisionamount=($totalamount/100)*$commisionpercent;
        $comsql="INSERT INTO commision
                    VALUES ('$commisionid','$commisionpercent',$commisionamount,'$date')";
      mysqli_query($con,$comsql);

        //for payment
        $paymentid=autoID("payment","paymentid","Pay_",7,"Pay_0000001");
        $cardno=$_REQUEST['txtcardno'];
        $expiredate=$_REQUEST['txtmonth'].'/'.$_REQUEST['txtyear'];
        $staffid='-';
        $paymentstatus='pending';
        $paysql="INSERT INTO payment
                    VALUES('$paymentid',$totalamount,'$cardno','$expiredate','$date','$commisionid','$staffid','$paymentstatus')";
       mysqli_query($con,$paysql);


        //for booking
        $bookingstatus="pending";
        $booksql="INSERT INTO booking
                    VALUES('$bookingid','$customerid','$date','$paymentid',$totalamount,'$bookingstatus')";
      mysqli_query($con,$booksql);

       $index=count($_SESSION["cart"]);
      // $b=false;

       for($i=0;$i<$index;$i++)
       {
        //  if($_SESSION["cart"][$i]["typeid"]==$_REQUEST["rid"])
         // {
             $typeid=$_SESSION["cart"][$i]["typeid"];
           $checkin=$_SESSION["cart"][$i]["checkin"];
           $checkout=  $_SESSION["cart"][$i]["checkout"];
           $numberofrooms=$_SESSION["cart"][$i]["roomno"];
          $roomprice= $_SESSION["cart"][$i]["roomprice"];
          $amount= $_SESSION["cart"][$i]["amount"];
          $numberofdays=  $_SESSION["cart"][$i]["noofdays"];
          $qry="SELECT roomid,fullimage,backimage,fontimage From room_hotel_view 
          WHERE status='available' AND roomtypeid='$typeid'
          AND roomid not IN 
          (SELECT bd.roomid FROM `bookingdetail` as bd WHERE bd.checkindate<='$checkin' AND bd.checkoutdate>'$checkin' ) LIMIT 0,$numberofrooms";
         // break;
         // }
         $result=mysqli_query($con,$qry);
         while($resultdata=mysqli_fetch_array($result))
         {
             $roomid=$resultdata["roomid"];
             $save="INSERT INTO bookingdetail VALUES ('$bookingid','$roomid','$roomprice',' $checkin','$checkout','$numberofdays')";
            // echo $save;
             mysqli_query($con,$save);

         }
       }
       unset($_SESSION["cart"]);
       unset($_SESSION["searchdata"]);
       header("location:confirm.php?bid=$bookingid");
    }
    

?>
<section class="content">
    <div class="container  main-content">
    <div class="row">
        <div class="col-12">
        <h2>Check Out</h2><hr/>
            <div class="row">
                <div class="col-6">
                    <form action="checkout.php" method="POST">
                    <table width="100%">
                        <tr>
                            <td></td>
                            <td>
                                <input type="text" name="txtbookingid" class="form-control" value="<?php echo $bookingid; ?>" readonly hidden>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="text" name="txtcustomerid" class="form-control" value="<?php echo $customerid; ?>" readonly hidden>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="text" name="txtbookingdate" class="form-control" value="<?php echo date("yy-m-d"); ?>" readonly hidden>
                            </td>
                        </tr>
                        <tr>
                            <td>Total Amount</td>
                            <td>
                                <input type="text" name="txttotalamount" class="form-control" value="<?php echo $totalamount; ?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Card No</td>
                            <td>
                                <input type="text" name="txtcardno" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>Card Expired Date</td>
                            <td>
                                <div class="row">
                                    <div class="col-6">
                                    <select name="txtmonth"  class="form-control browser-default custom-select">
                                <option>Month</option>
                                <?php
                                    for($i=1;$i<13;$i++)
                                    {
                                        echo '<option>'.$i.'</option>';
                                    }
                                ?>  
                                </select>
                                    </div>
                                    <div class="col-6">
                                    <select name="txtyear"  class="form-control browser-default custom-select">
                                <option>Year</option>
                                <?php
                                    for($i=2020;$i<2031;$i++)
                                    {
                                        echo '<option>'.$i.'</option>';
                                    }
                                ?>  
                                </select>
                                    </div>
                                
                                
                                </div>
                                
                                
                            </td>
                        </tr>
                        
                        <tr>
                            <td></td>
                            <td>
                                <button class="btn btn-warning" type="submit" name="btnsave">Check Out</button>
                            </td>
                        </tr>
                    </table>
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-12 table-responsive" style="margin-top: 50px;">
        <table class="table table-striped">
                <tr><th>Room Type</th><th>Check In</th><th>Check Out</th><th>City</th><th>Hotel</th><th>Number of Room</th><th>Pice/room</th><th>No of Days</th><th>Amount</th></tr>
                <?php
                
                for($i=0;$i<count($_SESSION["cart"]);$i++)
                {
                    echo "<tr>";
        echo   "<td>".  $_SESSION["cart"][$i]["typename"]."</td>";
        echo "<td>".$_SESSION["cart"][$i]["checkin"]."</td>";
      echo  "<td>".$_SESSION["cart"][$i]["checkout"]."</td>";
      echo "<td>". $_SESSION["cart"][$i]["cityname"]."</td>";
      echo "<td>". $_SESSION["cart"][$i]["hotel"]."</td>";
      
      echo  "<td>".$_SESSION["cart"][$i]["roomno"]."</td>";
      echo  "<td>".$_SESSION["cart"][$i]["roomprice"]."</td>";
      echo  "<td>".$_SESSION["cart"][$i]["noofdays"]."</td>";
      echo  "<td>".$_SESSION["cart"][$i]["amount"]."</td>";
                   echo "<tr>";
     
                 }

                 ?>
                </table>
        </div>
    </div>
    </div>
    
</section>
<?php
include 'template/footer.php';
?>