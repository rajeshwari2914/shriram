<?php
    $con = mysqli_connect("localhost","shriarambhv_sl",'kDj+ZrzgG$y8',"shriarambhv_shopee");
    $sql = "select * from registers";
    $rs = mysqli_query($con,$sql);
    //$rw = mysqli_fetch_row($rs);
    /*echo "";
    exit();*/
    while($rw = mysqli_fetch_row($rs))
    {
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
          CURLOPT_URL => 'https://payout-api.cashfree.com/payout/v1/addBeneficiary',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 100,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "beneId": "'.$rw[12].'",
              "name": "'.$rw[1].'",
              "email": "sriarambh@gmail.com",
              "phone": "'.$rw[9].'",
              "vpa": "'.$rw[11].'",
              "address1": "Solapur"
              
        }',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token,
            'Content-Type:application/json'
          ),
        ));
        
        $res = curl_exec($curl);
        curl_close($curl);
        echo $res.'<br/>';
    }
    
?>