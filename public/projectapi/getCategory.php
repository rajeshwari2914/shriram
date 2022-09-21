<?php
    
    include_once('config.php');
    $sql = "select * from categories where status='active'";
    //echo $sql;
    //exit();
    $rs = mysqli_query($con,$sql);
    $res = array();
    //echo mysqli_error($con);
    //echo mysqli_num_rows($rs);
    while($rw = mysqli_fetch_row($rs))
    {
        $data['id']=$rw[0];
        $data['cname']=$rw[1];
        if($rw[2]=='')
            $data['img']="front/slmartlogo/6.png";
        else
            $data['img']="images/".$rw[2];
        array_push($res,$data);
        
    }
    
    echo json_encode($res);

?>