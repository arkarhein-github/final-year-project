<?php
Session_start();
if(isset($_REQUEST["act"]))
{$date1=date_create($_REQUEST["cin"]);
    $date2=date_create($_REQUEST["cout"]);
    $diff=date_diff($date1,$date2);
    $noofdays= intval($diff->format("%a"));
    if($noofdays==0)
    {
        $noofdays=1;
    }
    if(isset($_SESSION["cart"]))
    {
        
        
        $index=count($_SESSION["cart"]);
        $b=false;

        for($i=0;$i<$index;$i++)
        {
           if($_SESSION["cart"][$i]["typeid"]==$_REQUEST["rid"])
           {
            $_SESSION["cart"][$i]["checkin"]=$_REQUEST["cin"];
            $_SESSION["cart"][$i]["checkout"]=$_REQUEST["cout"];
            $_SESSION["cart"][$i]["roomno"]=$_REQUEST["roomno"];
            $_SESSION["cart"][$i]["roomprice"]=$_REQUEST["rprice"];
            $_SESSION["cart"][$i]["noofdays"]=intval($noofdays);
            $_SESSION["cart"][$i]["amount"]=($noofdays*intval($_REQUEST["rprice"]))*intval($_REQUEST["roomno"]);
            $b=true;
           break;
           }
        }
        if($b==false)
        {
           
            $_SESSION["cart"][$index]["typeid"]=$_REQUEST["rid"];
            $_SESSION["cart"][$index]["typename"]=$_REQUEST["rn"];
            $_SESSION["cart"][$index]["checkin"]=$_REQUEST["cin"];
            $_SESSION["cart"][$index]["checkout"]=$_REQUEST["cout"];
            $_SESSION["cart"][$index]["cityname"]=$_REQUEST["cn"];
            $_SESSION["cart"][$index]["roomno"]=$_REQUEST["roomno"];
            $_SESSION["cart"][$index]["hotel"]=$_REQUEST["h"];
            $_SESSION["cart"][$index]["roomprice"]=$_REQUEST["rprice"];
            $_SESSION["cart"][$index]["noofdays"]=intval($noofdays);
            $_SESSION["cart"][$index]["amount"]=($noofdays*intval($_REQUEST["rprice"]))*intval($_REQUEST["roomno"]);
        }
    }
    else
    {
       

        $_SESSION["cart"][0]["typeid"]=$_REQUEST["rid"];
        $_SESSION["cart"][0]["typename"]=$_REQUEST["rn"];
        $_SESSION["cart"][0]["checkin"]=$_REQUEST["cin"];
        $_SESSION["cart"][0]["checkout"]=$_REQUEST["cout"];
        $_SESSION["cart"][0]["cityname"]=$_REQUEST["cn"];
        $_SESSION["cart"][0]["roomno"]=$_REQUEST["roomno"];
        $_SESSION["cart"][0]["hotel"]=$_REQUEST["h"];
     
        $_SESSION["cart"][0]["roomprice"]=$_REQUEST["rprice"];
        $_SESSION["cart"][0]["noofdays"]=$noofdays;
        $_SESSION["cart"][0]["amount"]=($noofdays*intval($_REQUEST["rprice"]))*intval($_REQUEST["roomno"]);
        
    }

  /*  for($i=0;$i<count($_SESSION["cart"]);$i++)
    {
        echo  $_SESSION["cart"][$i]["typeid"].",";
        echo  $_SESSION["cart"][$i]["checkin"].",";
      echo  $_SESSION["cart"][$i]["checkin"].",";
      echo  $_SESSION["cart"][$i]["checkout"].",";
      echo  $_SESSION["cart"][$i]["roomno"];
      echo "__________________________________";
      
     
    }*/
    //header("location:hoteldisplay.php?msg=Successfully Selecting the room !");
}
?>