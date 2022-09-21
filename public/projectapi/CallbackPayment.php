<?php
    include('config.php');
    if(isset($_POST['uid']) && isset($_POST['pid']) && isset($_POST['txt']))
    {
        $uid = $_POST['uid'];
        $pid = $_POST['pid'];
        $txt = $_POST['txt'];
        $sql = "INSERT INTO `tbl_payment`(`uid`, `payid`, `txt`) VALUES ('$uid','$pid','$txt')";
        /*echo $sql;
        exit();*/
        if(mysqli_query($con,$sql)){
            echo "success";
        }
        else{
            echo "failed";
        }
    }
    else{
        echo "failed";
    }

?>