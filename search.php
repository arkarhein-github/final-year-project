<?php
    include 'template/header_ad.php';
    include 'template/autoid.php';
    unset($_SESSION['bookpaymentlist']);
    unset($_SESSION['bookdetaillist']);
    $con=mysqli_connect("localhost","root","","dbagent");
    $msg="";

    if(isset($_REQUEST['btnsearch']))
    {
        unset($_SESSION['bookpaymentlist']);
        unset($_SESSION['bookdetaillist']);
        $type=$_REQUEST['txttype'];
        $startdate=$_REQUEST['txtstartdate'];
        $enddate=$_REQUEST['txtenddate'];

        if($type=="Booking Payment")
        {
            $sql="SELECT * FROM booking_payment_view
                    WHERE paymentdate BETWEEN '$startdate' AND '$enddate'";
            $result=mysqli_query($con,$sql);
            if(0==mysqli_num_rows($result))
            {
                $msg="There is no report";
            }
            $i=0;
            while($data=mysqli_fetch_array($result))
            {
                $_SESSION['bookpaymentlist'][$i]['bookingid']=$data['bookingid'];
                $_SESSION['bookpaymentlist'][$i]['bookingdate']=$data['bookingdate'];
                $_SESSION['bookpaymentlist'][$i]['paymentdate']=$data['paymentdate'];
                $_SESSION['bookpaymentlist'][$i]['paymentamount']=$data['paymentamount'];
                $_SESSION['bookpaymentlist'][$i]['cardno']=$data['cardno'];
                $_SESSION['bookpaymentlist'][$i]['commisionamount']=$data['commisionamount'];
                $_SESSION['bookpaymentlist'][$i]['customerid']=$data['customerid'];
                $_SESSION['bookpaymentlist'][$i]['customername']=$data['customername'];
                $_SESSION['bookpaymentlist'][$i]['customerinfo']="Email=".$data['email'].",<br>Phone=".$data['phoneno'].",<br>Address=".$data['address'];
                $i++;
            }
        }
        if($type=="Booking Detail")
        {
            $sql="SELECT * FROM bookingdetail_view
                    WHERE bookingdate BETWEEN '$startdate' AND '$enddate'";
            $result=mysqli_query($con,$sql);
            if(0==mysqli_num_rows($result))
            {
                $msg="There is no report";
            }
            $i=0;
            while($data=mysqli_fetch_array($result))
            {
                $_SESSION['bookdetaillist'][$i]['bookingid']=$data['bookingid'];
                $_SESSION['bookdetaillist'][$i]['roomid']=$data['roomid'];
                $_SESSION['bookdetaillist'][$i]['roomno']=$data['roomno'];
                $_SESSION['bookdetaillist'][$i]['roomtypename']=$data['roomtypename'];
                $_SESSION['bookdetaillist'][$i]['hotelname']=$data['hotelname'];
                $_SESSION['bookdetaillist'][$i]['price']=$data['price'];
                $_SESSION['bookdetaillist'][$i]['checkindate']=$data['checkindate'];
                $_SESSION['bookdetaillist'][$i]['checkoutdate']=$data['checkoutdate'];
                $_SESSION['bookdetaillist'][$i]['customerid']=$data['customerid'];
                $_SESSION['bookdetaillist'][$i]['customername']=$data['customername'];
                $_SESSION['bookdetaillist'][$i]['customerinfo']="Email=".$data['email'].",<br>Phone=".$data['phoneno'].",<br>Address=".$data['address'];
                $i++;
            }
        }
    }
?>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-12 main-content">
            <h2>Report</h2><hr/>
            <div class="row">
                <div class="col-6">
                    <form action="search.php" method="POST">
                        <table width="100%">
                            <tr>
                                <td>Report Type</td>
                                <td>
                                    <select class="form-control  browser-default custom-select" name="txttype">
                                        <option>Booking Payment</option>
                                        <option>Booking Detail</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Start Date</td>
                                <td>
                                    <input type="date" name="txtstartdate" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>End Date</td>
                                <td>
                                    <input type="date" name="txtenddate" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="btnsearch" class="btn btn-warning" value="Search">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="row" style="margin-top: 50px;">
                <div class="col-12 table-responsive">
                    <?php
                    echo "<h5 class=\"text-danger\">$msg</h5>";
                    if(isset($_SESSION['bookpaymentlist']))
                    {
                        echo '<a href="report.php" class="btn btn-primary">Print</a>';
                        $count=count($_SESSION['bookpaymentlist']);
            
                        $list="<table class='table  tablelist'>
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Booking Date</th>
                                        <th>Payment Date</th>
                                        <th>Payment Amount</th>
                                        <th>Card No</th>
                                        <th>Commision Amount</th>
                                        <th>Customer ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer Info</th>
                                    </tr>";
                        for($i=0;$i<$count;$i++)
                        {
                            $bookingid=$_SESSION['bookpaymentlist'][$i]['bookingid'];
                            $bookingdate=$_SESSION['bookpaymentlist'][$i]['bookingdate'];
                            $paymentdate=$_SESSION['bookpaymentlist'][$i]['paymentdate'];
                            $paymentamount=$_SESSION['bookpaymentlist'][$i]['paymentamount'];
                            $cardno=$_SESSION['bookpaymentlist'][$i]['cardno'];
                            $commisionamount=$_SESSION['bookpaymentlist'][$i]['commisionamount'];
                            $customerid=$_SESSION['bookpaymentlist'][$i]['customerid'];
                            $customername=$_SESSION['bookpaymentlist'][$i]['customername'];
                            $customerinfo=$_SESSION['bookpaymentlist'][$i]['customerinfo'];
                            $list.="<tr>
                                        <td>$bookingid</td>
                                        <td>$bookingdate</td>
                                        <td>$paymentdate</td>
                                        <td>$paymentamount</td>
                                        <td>$cardno</td>
                                        <td>$commisionamount</td>
                                        <td>$customerid</td>
                                        <td>$customername</td>
                                        <td>$customerinfo</td>
                                    </tr>";
                        }    
                        $list.="</table>";
                        echo $list;
                    }
                        //bookingdetail
                    if(isset($_SESSION['bookdetaillist']))
                    {
                        echo '<a href="report.php" class="btn btn-primary" target="_blank" >Print</a>';
                        $count=count($_SESSION['bookdetaillist']);
            
                        $list="<table class='table  tablelist'>
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Room ID</th>
                                        <th>Room No</th>
                                        <th>Room Type</th>
                                        <th>Hotel</th>
                                        <th>Room Price</th>
                                        <th>Check In</th>
                                        <th>Check out</th>
                                        <th>Customer ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer Info</th>
                                    </tr>";
                        for($i=0;$i<$count;$i++)
                        {
                            $bookingid=$_SESSION['bookdetaillist'][$i]['bookingid'];
                            $roomid=$_SESSION['bookdetaillist'][$i]['roomid'];
                            $roomno=$_SESSION['bookdetaillist'][$i]['roomno'];
                            $roomtypename=$_SESSION['bookdetaillist'][$i]['roomtypename'];
                            $hotelname=$_SESSION['bookdetaillist'][$i]['hotelname'];
                            $price=$_SESSION['bookdetaillist'][$i]['price'];
                            $checkindate=$_SESSION['bookdetaillist'][$i]['checkindate'];
                            $checkoutdate=$_SESSION['bookdetaillist'][$i]['checkoutdate'];
                            $customerid=$_SESSION['bookdetaillist'][$i]['customerid'];
                            $customername=$_SESSION['bookdetaillist'][$i]['customername'];
                            $customerinfo=$_SESSION['bookdetaillist'][$i]['customerinfo'];
                            $list.="<tr>
                                        <td>$bookingid</td>
                                        <td>$roomid</td>
                                        <td>$roomno</td>
                                        <td>$roomtypename</td>
                                        <td>$hotelname</td>
                                        <td>$price</td>
                                        <td>$checkindate</td>
                                        <td>$checkoutdate</td>
                                        <td>$customerid</td>
                                        <td>$customername</td>
                                        <td>$customerinfo</td>
                                    </tr>";
                        }    
                        $list.="</table>";
                        echo $list;
                    }
                    ?>
                    
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
<?php
    include 'template/footer.php';
?>