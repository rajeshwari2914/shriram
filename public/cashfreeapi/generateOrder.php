<?php
    $oid = $_GET['oid'];
    $amt = $_GET['amt'];
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.cashfree.com/api/v2/cftoken/order',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 100,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "orderId": "'.$oid.'",
            "orderAmount":'.$amt.',
            "orderCurrency": "INR"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'x-client-id: 164339ea5fc3e3fd7d4979dc6b933461',
            'x-client-secret: 81dc6727b02f32240f260c10339ddbcd75addb4c'
        ),
    ));
    
    $res = curl_exec($curl);
    curl_close($curl);
    echo $res;

?>