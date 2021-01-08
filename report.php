<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/fw.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/navstyle.css"/>
</head>
<body>
<section class="report">
    <div class="container">
        <div class="row">
            <div class="col-4 offset-5">
                <img src="image/siteimage/logo.fw.png" class="img-fluid" width="200">
            </div>
        </div>
    <div class="row">
        
                <div class="col-12 table-responsive">
                    <?php
                    session_start();
                    if(isset($_SESSION['bookpaymentlist']))
                    {
                       echo '<h2 align="center">Booking Payment Report</h2><hr>';
                        $count=count($_SESSION['bookpaymentlist']);
            
                        $list="<table class='table table-striped'>
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

                    if(isset($_SESSION['bookdetaillist']))
                    {
                       
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
            
</section>
                
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>
</html>