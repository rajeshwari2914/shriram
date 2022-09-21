<?php
    include('config.php');
    $uid = $_GET['nm'];
    $sql = "SELECT * FROM `orders` as o JOIN products as p ON o.pid = p.id JOIN bills as b ON o.bid = b.id JOIN billdetails as bd ON b.cid = bd.id WHERE bd.full_name='$uid'";
    $rs = mysqli_query($con,$sql);
    $response = array();
    while($rw = mysqli_fetch_row($rs))
    {
        $data['id'] = $rw[0];
        $data['bill_id'] = $rw[31];
        $data['pname'] = $rw[10];
        $data['pid'] = $rw[9];
        $data['img'] = $rw[12];
        $data['amt'] = $rw[3];
        $data['disc'] = $rw[4];
        $data['odate'] = $rw[7];
        $data['status'] = $rw[37];
        array_push($response,$data);
    }
    echo json_encode($response);
?>