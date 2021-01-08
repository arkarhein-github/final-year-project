<?php
session_start();
/*
if(!isset($_SESSION['customer']))
{
    header("location:customerlogin.php");
}
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/navstyle.css"/>
</head>
<body>

    <!--menu -->
    <section class="menu">
        <nav class="navbar navbar-expand-lg">
                    
        <img src="image/siteimage/logo2.PNG" class="img-fluid" width="200">    
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                              <span class="navbar-toggler-icon" > <i class="fa fa-navicon"></i></span>
                            </button>

                                <div class="collapse navbar-collapse offset-4" id="navbarSupportedContent">
                                    <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                            <a class="nav-link" href="hoteldisplay.php">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="hoteldisplay.php">Hotel</a>
                                        </li>
                                        <?php
                                        if(!isset($_SESSION['customer']))
                                        {
                                           echo '<li class="nav-item">
                                           <a class="nav-link" href="customerlogin.php">Login</a>
                                       </li>
                                       <li class="nav-item">
                                            <a class="nav-link" href="customer.php">Register</a>
                                        </li>';
                                        }
                                        if(isset($_SESSION['cart'])){
                                            echo '<li class="nav-item">
                                            <a class="nav-link" href="MyRoom.php?type=lo">My Room</a>
                                        </li>';

                                        echo '<li class="nav-item">
                                            <a class="nav-link" href="checkout.php?type=lo">Check Out</a>
                                        </li>';
                                        }
                                        if(isset($_SESSION['customer'])){
                                            echo '<li class="nav-item">
                                            <a class="nav-link" href="customerlogin.php?type=lo">Logout</a>
                                        </li>';
                                        }
                                        ?>
                                        
                                        
                                    </ul>

        </nav>
    </section>
    <section class="banner">
        <div class="row no-gutters">
            <div class="col-12">
                <img src="image/siteimage/banner.png" width="100%" height="400px"/>
            </div>
        </div>
    </section>

    