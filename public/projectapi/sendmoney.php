<?php
    $con = mysqli_connect("localhost","shriarambhv_sl",'kDj+ZrzgG$y8',"shriarambhv_shopee");
    $ref = $_POST['ref'];
    $uid = $_POST['uid'];
    $payout = array();
    for($i=1;$i<=7;$i++)
    {
        $sql = "select * from registers where ref='$ref'";
        /*echo $sql;
        exit();*/
        $rs = mysqli_query($con,$sql);
        
        if(mysqli_num_rows($rs)>0){
            $rw = mysqli_fetch_row($rs);
            if($i==1)
                $amt = "10.00";
            else if($i==2)
                $amt = "10.00";
            else if($i==3)
                $amt = "11.00";
            else if($i==4)
                $amt = "12.00";
            else if($i==5)
                $amt = "13.00";
            else if($i==6)
                $amt = "14.00";
            else if($i==7)
                $amt = "40.00";
            /*echo $amt;
            exit();*/
            //mysqli_query($con,$sql);
            $data['ref'] = $ref;
            $data['amt'] = $amt;
            array_push($payout,$data);
            $ref = $rw[15];
            //echo $res.'<br/>';
            
            //echo mysqli_error($con);
        }
    }
    
    //echo json_encode($payout);
    /*echo $payout[0]['ref'];
    exit();*/
    
    /*var_dump($payout);
    exit();*/
    for($i=0;$i<sizeof($payout);$i++)
    {
        
        $ref = $payout[$i]['ref'];
        $amt = $payout[$i]['amt'];
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://payout-api.cashfree.com/payout/v1/authorize',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 100,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              
              CURLOPT_HTTPHEADER => array(
                'x-client-id: CF164339C7A3G79QE0NUFQ6GCK0G',
                'x-client-secret: 1f908a6197c251cd70025241e294427aa927aac3'
              ),
            ));
            
            $res = curl_exec($curl);
            curl_close($curl);
            $arr = json_decode($res);
            $token = $arr->data->token;
            $tsLong = strtotime(date("h:i:sa"));
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://payout-api.cashfree.com/payout/v1.2/requestTransfer',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 100,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
                "beneId": "'.$ref.'",
                "amount": "'.$amt.'",
                "transferId": "'.$tsLong.'",
                "transferMode":"upi"
                  
            }',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token,
                'Content-Type:application/json'
              ),
            ));
            
            $res = curl_exec($curl);
            curl_close($curl);
            //echo $res;
            //exit();
            $sql = "INSERT INTO `tbl_payment`(`uid`, `payid`, `txt`) VALUES ('$uid','$ref','$res')";
            /*if($i>=1 && $i<=5)
                $sql = "INSERT INTO `tbl_payout`( `uid`, `amt`, `status`) VALUES ('$rw[0]','$amt','$res')";
            else if($i==6)
                $sql = "INSERT INTO `tbl_payout`( `uid`, `amt`, `status`) VALUES ('$rw[0]','$amt','$res')";*/
            mysqli_query($con,$sql);
            $sql = "INSERT INTO `tbl_payout`( `uid`, `amt`, `status`) VALUES ('$ref','$amt','$res')";
            mysqli_query($con,$sql);
       
        
    }
    echo "success";
    
?>