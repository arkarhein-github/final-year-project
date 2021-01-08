<?php
    include 'template/header_ad.php';
    include 'template/autoid.php';

    $con=mysqli_connect("localhost","root","","dbagent");
    if(isset($_REQUEST['bookingid']))
    {
        //for booking
        $bookingid=$_REQUEST['bookingid'];
        $sql="UPDATE booking 
                SET status='receive'
                WHERE bookingid='$bookingid'";
        mysqli_query($con,$sql);

        //for payment
        $paymentid=$_REQUEST['paymentid'];
        $staffid=$_SESSION['staff'];
        $date=date("yy-m-d");
        $sql="UPDATE payment 
                SET status='receive',paymentdate='$date',staffid='$staffid'
                WHERE paymentid='$paymentid'";
                //echo $sql;
        mysqli_query($con,$sql);

        //for commision
        $commisionid="";
        $sql="SELECT commisionid FROM payment WHERE paymentid='$paymentid'";
        $result=mysqli_query($con,$sql);
        if(0<mysqli_num_rows($result))
        {
            $data=mysqli_fetch_array($result);
            $commisionid=$data['commisionid'];
        }
        $sql="UPDATE commision 
                SET commisiondate='$date'
                WHERE commisionid='$commisionid'";
        mysqli_query($con,$sql);

        header("location:dashboard.php?msg=Successfully Receive");

    }
?>
                    
     <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12 main-content">
                <h2>Hotel Booking Lists</h2><hr/>
                    <p class="text-primary">
                        <?php
                            if(isset($_REQUEST['msg']))
                            {
                                echo $_REQUEST['msg'];
                            }
                        ?>
                    </p>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-light">
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Customer ID</th>
                                    <th>Booking Date</th>
                                    <th>Total Amount</th>
                                    <th></th>
                                </tr>
                            
                            <?php
                                
                                $sql="SELECT * FROM booking WHERE status='pending'";
                                $result=mysqli_query($con,$sql);
                                while($data=mysqli_fetch_array($result))
                                {
                                    echo '<tr>';
                                        echo '<td>'.$data['bookingid'].'</td>';
                                        echo '<td>'.$data['customerid'].'</td>';
                                        echo '<td>'.$data['bookingdate'].'</td>';
                                        echo '<td>'.$data['totalamount'].'</td>';
                                        echo '<td><a href="dashboard.php?bookingid='.$data['bookingid'].'&paymentid='.$data['paymentid'].'" class="btn btn-success">Accept</a></td>';
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