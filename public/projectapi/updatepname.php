<?php

    include('config.php');
    $sql = "select * from products where brands = 'SL'";
    $rs = mysqli_query($con,$sql);
    echo mysqli_error($con);
    while($rw = mysqli_fetch_row($rs))
    {
        $strpnm = str_replace($rw[18],"",$rw[1]);
        //echo $rw[19];
        $sql = "update products set pname = '$strpnm' where id=".$rw[0];
        /*echo $sql;
        exit();*/
        mysqli_query($con,$sql);
        echo mysqli_error($con);
    }

?>