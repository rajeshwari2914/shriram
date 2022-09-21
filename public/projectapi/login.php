<?php

    include('config.php');
    $mob = $_POST['mob'];
    $pass = $_POST['pass'];
    $sql = "select  * from registers where mobile = '$mob' and password='$pass' and status='active'";
    //echo $sql;
    //exit();
    $resp = array();
    $rs = mysqli_query($con,$sql);
    if(mysqli_num_rows($rs)){
        $rw = mysqli_fetch_row($rs);
        $data['msg'] = "success";
        $data["id"]=$rw[0];
        $data["nm"]=$rw[1];
        $data["add"]=$rw[3];
        $data["land"]=$rw[4];
        $data["ct"]=$rw[5];
        $data["st"]=$rw[6];
        $data["teh"]=$rw[7];
        $data["pin"]=$rw[8];
        $data["mob"]=$rw[9];
        $data["pan"]=$rw[10];
        $data["upi"]=$rw[11];
        $data["ref"]=$rw[12];
        $data["pass"]=$rw[13];
        $data["under"]=$rw[15];
        $data['payout'] = $rw[19];
        $data['ptype'] = "cashfree";
        $data['pstatus'] = $rw[16];
        
        $sql = "select sum(amt) from tbl_payout where uid='$rw[12]'";
        $rs1 = mysqli_query($con,$sql);
        $rw1 = mysqli_fetch_row($rs1);
        
        $data['pcnt'] = '0';
        $pcntsql = "select sum(*) from tbl_payment where uid = '$rw[0]'";
        /*$pcntrs = mysqli_query($con,$pcntsql);
        if(mysqli_num_rows($pcntrs)>0){
            $pcntrw = mysqli_fetch_row($pcntrs);
            $pcnt = $pcntrw[0] % 7;
            $data['pcnt'] = $pcnt;
        }*/
        $data['amt'] = '0';
        if($rw1[0]!=NULL)
            $data['amt'] = $rw1[0];
        array_push($resp,$data);
        echo json_encode($resp);
        //echo "success";
    }
    else{
        //echo mysqli_error($con);=
        echo "Invalid Credentials";
    }

?>