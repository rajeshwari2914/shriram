<?php
    $con = mysqli_connect("localhost","shriarambhv_sl",'kDj+ZrzgG$y8',"shriarambhv_shopee");
    $ref = $_POST['ref'];
    for($i=1;$i<=6;$i++)
    {
        $sql = "select * from registers where ref='$ref'";
        $rs = mysqli_query($con,$sql);
        $tsLong = strtotime(date("h:i:sa"));
        if(mysqli_num_rows($rs)>0){
            $rw = mysqli_fetch_row($rs);
            $ref = $rw[15];
            if($i>=1 && $i<=5)
                $amt = "10.00";
            else if($i==6)
                $amt = "30.00";
            mysqli_query($con,$sql);
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
                "transferId": "'.$tsLong.'"
                  
            }',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token,
                'Content-Type:application/json'
              ),
            ));
            
            $res = curl_exec($curl);
            curl_close($curl);
            if($i>=1 && $i<=5)
                $sql = "INSERT INTO `tbl_payout`( `uid`, `amt`, `status`) VALUES ('$rw[0]','10','$res')";
            else if($i==6)
                $sql = "INSERT INTO `tbl_payout`( `uid`, `amt`, `status`) VALUES ('$rw[0]','30','$res')";
            mysqli_query($con,$sql);
            //echo $res.'<br/>';
            
            //echo mysqli_error($con);
        }
        
    }
    
?>