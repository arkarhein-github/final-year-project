<?php
session_start();
if(!isset($_SESSION['staff']))
{
    header("location:stafflogin.php");
}

?>
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
    <section class="logo">
        <div class="container-fluid">
        <div class="row">
            <div class="col-4 offset-5">
                <img src="image/siteimage/logo.fw.png" class="img-fluid" width="250">
            </div>
        </div>
        </div>
    </section>
    <!--menu -->
    <section class="menu">
        <nav class="navbar navbar-expand-lg">
                                
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                              <span class="navbar-toggler-icon" > <i class="fa fa-navicon"></i></span>
                            </button>

                                <div class="collapse navbar-collapse offset-4" id="navbarSupportedContent">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item">
                                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="hotel.php">Entry</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="promotion.php">Promotion</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="search.php">Report</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="stafflogin.php?type=lo">Log out</a>
                                        </li>
                                    </ul>

        </nav>
    </section>