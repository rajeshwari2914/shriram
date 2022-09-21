<?php


    $url = "https://uat.payg.in/ProcessPayment/EcomPayment/ProcessPayment";
    $tsLong = strtotime(date("h:i:sa"));
    $jsondata = "a89b2ec9f8e54dda9b0c22929b5ff396|22332|".$tsLong."|aafca90c6d7e4f9eb65ea1a0a6b855ce|3cc2fe57539041fb893f85a0788b88ca|1";
    $hashed = hash("sha256", $jsondata);
    curl_setopt_array($curl, array(
      CURLOPT_URL => ''.$url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "MerchantKeyId": "22332",
        "AuthenticationKey": "aafca90c6d7e4f9eb65ea1a0a6b855ce",
        "AuthenticationToken":"3cc2fe57539041fb893f85a0788b88ca",
        "RequestUniqueId":"'.$tsLong.'",
        "PaymentType":"Upi",
        "TransactionType":"Charge",
        "Amount":"1.00",
        "ResponseRedirectUrl":"https://shriarambhventure.com/",
        "CancelRedirectUrl":"https://shriarambhventure.com/",
        "TCPolicyUrl":"https://shriarambhventure.com/terms-conditions",
        "DisclaimerPolicyUrl":"https://shriarambhventure.com/terms-conditions",
        "PrivacyPolicyUrl":"https://shriarambhventure.com/privacy-policy",
        "CancelRefundPolicyUrl":"https://shriarambhventure.com/shipping-policy",
        "ShippingDeliveryPolicyUrl":"https://shriarambhventure.com/shipping-policy",
        "CustomerSupportPolicyUrl":"https://shriarambhventure.com/contact",
        "HashData":"'.$hashed.'",
        "RequestDateTime":"'.$tsLong.'",
        "UserName":"Sriarambh"
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: '.$hashed
      ),
    ));
    
    $res = curl_exec($curl);
    curl_close($curl);
    echo $res."<br/>";
?>