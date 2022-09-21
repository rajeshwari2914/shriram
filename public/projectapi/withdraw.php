<?php

    /*
    orderId=SOME_UNIQUE_ORDER_ID_FROM_MERCHANT&upiId=UPI_ID&amount=AMOUNT
&purpose=SALARY_DISBURSEMENT
    */
    $upi = $_GET['upiId'];
    $amt = $_GET['amount'];
    $pur = $_GET['purpose'];
    $send_url = "https://staging-payout.sabpaisa.in/api/PayoutTransactionRequest/";
    
    $tsLong = strtotime(date("h:i:sa"));
    $query = "orderId=$tsLong&upiId=$upi&amount=$amt&purpose=$pur";
    //$query = "orderId=$tsLong&beneficiaryName=Santoshkumar Gurubasayya Swami&beneficiaryAccount=159901505603&beneficiaryIFSC=INDB0000583&amount=2.00&purpose=Testing";
    $arr = array();
    $enc = encrypt("4ZxtWejgI4UezVYg","YeSsXFVkYYxx8zRc",$query);
    //array_push($arr,$enc);
    /*$enc .="&". encrypt("upiId","82hZQbuumHmFz9Wy","9403046045@upi");
    //array_push($arr,$enc);
    $enc .="&". encrypt("amount","82hZQbuumHmFz9Wy","1.00");
    //array_push($arr,$enc);
    $enc .="&". encrypt("purpose","82hZQbuumHmFz9Wy","Testing UPI Payout");*/
    //array_push($arr,$enc);
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://payout.sabpaisa.in/api/PayoutTransactionRequest/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 100,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "query": "'.$enc.'",
        "mode": "UPI"
        
    }',
      CURLOPT_HTTPHEADER => array(
        'auth-token: aFKdegvJajYiFy76TFVGSw==',
        'Content-Type: application/json'
      ),
    ));
    
    $res = curl_exec($curl);
    curl_close($curl);
    
    echo "<br/>".$res;


    function fixKey($key) 
    {
        $CIPHER_KEY_LEN = 16;
        if (strlen($key) < $CIPHER_KEY_LEN) {
        return str_pad("$key", $CIPHER_KEY_LEN, "0");
        }
        if (strlen($key) > $CIPHER_KEY_LEN) {
        return substr($key, 0, $CIPHER_KEY_LEN);
        }
        return $key;
    }
    
    function encrypt($key, $iv, $data) 
    {
        $OPENSSL_CIPHER_NAME = "aes-128-cbc";
        $CIPHER_KEY_LEN = 16;
        echo 'before encrypt data is :' .$data;
        $encodedEncryptedData = base64_encode(openssl_encrypt($data,
        $OPENSSL_CIPHER_NAME, fixKey($key), OPENSSL_RAW_DATA,
        $iv));
        $encodedIV = base64_encode($iv);
        //V1.2 -- 05/10/2021
        $encryptedPayload = $encodedEncryptedData;
        echo '<br/>';
        echo 'after encrypt data is :' .$encryptedPayload;
        echo '<br/>';
        return $encryptedPayload;
    }
    
    function decrypt($key,$iv, $data) {
        // $parts = explode(':', $data); //Separate
        //Encrypted data from iv.
        $encrypted = $data;
        // $iv = $parts[1];
        $decryptedData = openssl_decrypt(base64_decode($encrypted),
        AesCipher::OPENSSL_CIPHER_NAME, AesCipher::fixKey($key), OPENSSL_RAW_DATA,
        base64_decode($iv));
        return $decryptedData;
    }

?>