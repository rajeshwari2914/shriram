<?php

    include('config.php');
    $ref = $_GET['ref'];
    $response = array();
    $sql = "select * from registers where under_ref='$ref'";
    $rs = mysqli_query($con,$sql);
    while($rw = mysqli_fetch_row($rs))
    {
        $data['id'] = $rw[0];
        $data['name'] = $rw[1];
        $data['mob'] = $rw[9];
        $data['ref'] = $rw[12];
        array_push($response,$data);
    }
    echo json_encode($response);
?>