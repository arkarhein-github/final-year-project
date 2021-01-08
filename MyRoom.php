<?php
    include 'template/header_cus.php';
   
?>
<section class="content">
    <div class="container">
        <!-- hotel name -->
        <div class="row">
            <div class="col-12">
           
      
                <h2>My Selected Room</h2><hr/>
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