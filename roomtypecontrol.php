<?php
session_start();
$error="";
$con=mysqli_connect("localhost","root","","dbagent");
if(isset($_REQUEST['removeid']))
{
    $row=$_REQUEST['removeid'];
    unset($_SESSION['servicelist'][$row]);
    $_SESSION['servicelist']=array_values($_SESSION['servicelist']);
    header("Location:roomtype.php");
}
if(isset($_REQUEST['removeroomtypeid']))
{
    $row=$_REQUEST['removeroomtypeid'];
    unset($_SESSION['roomtypelist'][$row]);
    $_SESSION['roomtypelist']=array_values($_SESSION['roomtypelist']);
    header("Location:promotion.php");
}
if(isset($_REQUEST['btn']))
{
    $serviceid=$_REQUEST['serviceid'];
    $servicename=$_REQUEST['servicename'];

    if(!isset($_SESSION['servicelist']))
    {
        $_SESSION['servicelist'][0]['serviceid']=$serviceid;
        $_SESSION['servicelist'][0]['servicename']=$servicename;
    }
    else{
        $count=count($_SESSION['servicelist']);
        $status=true;
        for($i=0;$i<$count;$i++)
        {
            if($serviceid==$_SESSION['servicelist'][$i]['serviceid'])
            {
                $error="Already Exit";
                $status=false;
            }
        }
        if($status==true)
        {
            $_SESSION['servicelist'][$count]['serviceid']=$serviceid;
            $_SESSION['servicelist'][$count]['servicename']=$servicename;
        }
    }
    
}

if(isset($_SESSION['servicelist']))
{
    $count=count($_SESSION['servicelist']);
    $data='<table class="table">';
    $data .='<tr>';
    $data.='<th></th><th>ID</th><th>Service</th>';
    $data.='</tr>';
    for($i=0;$i<$count;$i++)
    {
        $data .='<tr>';
        $data .='<td><a href="roomtypecontrol.php?removeid='.$i.'" class="btn btn-danger">Remove</a></td>';
        $data .='<td>'.$_SESSION['servicelist'][$i]['serviceid'].'</td>';
        $data .='<td>'.$_SESSION['servicelist'][$i]['servicename'].'</td>';
        $data .='</tr>';
    }
    $data.='</table>';
    echo $data.'&'.$error;
}

if(isset($_REQUEST['btnroomtype']))
{
    $hotelid=$_REQUEST['hotelid'];
    $sql="SELECT * FROM roomtype WHERE status='true' AND hotelid='$hotelid'";
    $result=mysqli_query($con,$sql);
    echo '<select name="txtroomtypeid" class="form-control browser-default custom-select">';
     while($data=mysqli_fetch_array($result))
     {
        echo '<option value="'.$data['roomtypeid'].'">'.$data['roomtypename'].'</option>';
     }
     echo '</select>';
    
}

if(isset($_REQUEST['btntype']))
{
    $hotelid=$_REQUEST['hotelid'];
    $sql="SELECT * FROM roomtype WHERE status='true' AND hotelid='$hotelid'";
    $result=mysqli_query($con,$sql);
    
     while($data=mysqli_fetch_array($result))
     {
        echo '<option value="'.$data['roomtypeid'].'&'.$data['roomtypename'].'">'.$data['roomtypename'].'</option>';
     }
    
    
}

if(isset($_REQUEST['action']))
{
    $roomtypeid=$_REQUEST['roomtypeid'];
    $roomtypename=$_REQUEST['roomtypename'];
    
    $percent=$_REQUEST['percent'];
   
    if(!isset($_SESSION['roomtypelist']))
    {
        $_SESSION['roomtypelist'][0]['roomtypeid']=$roomtypeid;
        $_SESSION['roomtypelist'][0]['roomtypename']=$roomtypename;
        $_SESSION['roomtypelist'][0]['percent']=$percent;
    }
    else{
        $count=count($_SESSION['roomtypelist']);
        $status=true;
        for($i=0;$i<$count;$i++)
        {
            if($roomtypeid==$_SESSION['roomtypelist'][$i]['roomtypeid'])
            {
                $error="Already Exit";
                $status=false;
            }
        }
        if($status==true)
        {
            $_SESSION['roomtypelist'][$count]['roomtypeid']=$roomtypeid;
            $_SESSION['roomtypelist'][$count]['roomtypename']=$roomtypename;
            $_SESSION['roomtypelist'][$count]['percent']=$percent;
        }
    }
    
    
}

if(isset($_SESSION['roomtypelist']))
{
    $count=count($_SESSION['roomtypelist']);
    $data='<table class="table">';
    $data .='<tr>';
    $data.='<th>ID</th><th>Room Type</th><th>Percent</th>';
    $data.='</tr>';
    for($i=0;$i<$count;$i++)
    {
        $data .='<tr>';
        //$data .='<td><a href="roomtypecontrol.php?removeroomtypeid='.$i.'" class="btn btn-danger">Remove</a></td>';
        $data .='<td>'.$_SESSION['roomtypelist'][$i]['roomtypeid'].'</td>';
        $data .='<td>'.$_SESSION['roomtypelist'][$i]['roomtypename'].'</td>';
        $data .='<td>'.$_SESSION['roomtypelist'][$i]['percent'].'</td>';
        $data .='</tr>';
    }
    $data.='</table>';
    echo $data.'&'.$error;
}
?>