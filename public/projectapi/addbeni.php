<?php

    //$query = "orderId=$tsLong&beneficiaryName=Santoshkumar Gurubasayya Swami&beneficiaryAccount=159901505603&beneficiaryIFSC=INDB0000583&amount=1.00&purpose=Testing";
    
    
    class AesCipher {
    
        private const OPENSSL_CIPHER_NAME = "aes-128-cbc";
        private const CIPHER_KEY_LEN = 16; 
        private static function fixKey($key) {
            
            if (strlen($key) < AesCipher::CIPHER_KEY_LEN) {
               
                return str_pad("$key", AesCipher::CIPHER_KEY_LEN, "0"); 
            }
            
            if (strlen($key) > AesCipher::CIPHER_KEY_LEN) {
               
                return substr($key, 0, AesCipher::CIPHER_KEY_LEN); 
            }
            return $key;
        }
        
        static function encrypt($key, $iv, $data) {
            echo 'before encrypt data is :' .$data;
            $encodedEncryptedData = base64_encode(openssl_encrypt($data, AesCipher::OPENSSL_CIPHER_NAME, AesCipher::fixKey($key), OPENSSL_RAW_DATA, $iv));
            $encodedIV = base64_encode($iv);
            $encryptedPayload = $encodedEncryptedData;
            echo '<br/>';
            echo 'after encrypt data is :' .$encryptedPayload;
            echo '<br/>';
            return $encryptedPayload;
        }
        
        static function decrypt($key,$iv, $data) {
            // $parts = explode(':', $data);                      //Separate Encrypted data from iv.
            $encrypted = $data;
            // $iv = $parts[1];
            $decryptedData = openssl_decrypt(base64_decode($encrypted), AesCipher::OPENSSL_CIPHER_NAME, AesCipher::fixKey($key), OPENSSL_RAW_DATA, base64_decode($iv));
            return $decryptedData;
        }
        
        static function testing()
        {
            echo "Inside the Class in method testing";
        }
    }
    
    
    $query = '{"full_name":"Shruti Creations","account_number":"070618210002430","ifsc_code":"BKID0000706","upi_id":"8140096900@paytm"}';
    
    $enc = AesCipher::encrypt("4ZxtWejgI4UezVYg","YeSsXFVkYYxx8zRc",$query);
    
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://payout.sabpaisa.in/api/addBeneficiary/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 100,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "query": "'.$enc.'"
        
    }',
      CURLOPT_HTTPHEADER => array(
        'auth-token: aFKdegvJajYiFy76TFVGSw==',
        'Content-Type: application/json'
      ),
    ));
    
    $res = curl_exec($curl);
    curl_close($curl);
    
    echo "<br/>".$res;

?>