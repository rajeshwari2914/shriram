<?php

include('config.php');
$cid = $_GET['cid'];
$res=array();
$sql="select * from products as p LEFT JOIN product_stocks as s on p.id=s.pid where p.category='$cid' and status='active' order By cast(price_sale as unsigned) asc";

//echo $sql;
//exit();
$con->set_charset("utf8");
$rd=mysqli_query($con,$sql);
if(mysqli_num_rows($rd)>0)
{
    $msg['status']="success";
    array_push($res,$msg);
    while($rw=mysqli_fetch_row($rd))
    {
        $data['id']=$rw[0];
        $data['cid']="0";
        $data['pname']=$rw[1];
       
        $data['desc']=$rw[2];
        $data['pcs']="";
        $data['img']=$rw[3];
        $data['p_price']=$rw[11];
        $data['s_price']=$rw[11];
        $data['d_dis']="";
        $data['l_dis']="";
        $data['Brands']=$rw[16];
        $data['disc']=$rw[17];
        $data['stock'] = $rw[23];
        if($rw[16]=='SHR' || $rw[16]=='Delmy' || $rw[16]=='Anand'){
            $data['stock']='15';
        }
        $data['packing']=$rw[16];
        
        array_push($res,$data);
    }
}
else
{
    $msg['status']="failed";
    array_push($res,$msg);
}

echo json_encode($res);


?>