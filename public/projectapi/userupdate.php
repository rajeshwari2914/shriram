<?php

    include('config.php');
    $id = $_POST['id'];
    $fname=$_POST['fname'];
    $address = $_POST['address'];
    $land = $_POST['land'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $tehsil = $_POST['tehsil'];
    $pin = $_POST['pin'];
    $mob = $_POST['mob'];
    $pan = $_POST['pan'];
    $upi = $_POST['upi'];
    $ref = $_POST['ref'];
    
    $sql = "update registers set full_name='$fname',address='$address',landmark='$land',city='$city',state='$state',tehsil='$tehsil',pin='$pin',mobile='$mob',pan='$pan',upi='$upi',ref='$ref' where id=$id";
    //echo $sql;
    //exit();
    //echo $sql;
    //exit();
    if(mysqli_query($con,$sql))
    {
        echo "success";
        
    }
    else{
        echo mysqli_query($con);
    }
    
    
?>