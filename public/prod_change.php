<?php
    $con  = mysqli_connect("localhost","shriarambhv_sl",'kDj+ZrzgG$y8',"shriarambhv_shopee");
    //$con=mysqli_connect("localhost","shriarambhv_sl","","stock_management");
    $sql = "SELECT * FROM products WHERE pname LIKE 'Way2Herbal%'";
    $rs = mysqli_query($con,$sql);
    //var_dump($rs);
    //echo mysqli_error($con);
    while($rw = mysqli_fetch_row($rs))
    {
        $nm = $rw[1];
        $nm = str_replace('Way2Herbal ','',$nm);
        //echo $nm;
        //exit();
        $sql = "update products set pname = '$nm' where id = $rw[0]";
        if(mysqli_query($con,$sql))
            echo "updated\n";
        else
            echo mysqli_error($con);
    }

?>