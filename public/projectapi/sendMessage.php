<?php
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    $mob = "919404919907";
    $otp = "123456";
    $url='http://smsindia.techmartonline.com/api/sendhttp.php?authkey=369118AVqm7z8q617faec5P1&mobiles='.$mob.'&message=Your SL MART OTP verification code is '.$otp.'. Please don’t share this OTP with anyone&DLT_TE_ID=1207163549165953389&sender=SLMART&route=4';
    //echo $url;
    //exit();
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL =>$url ,
        CURLOPT_USERAGENT => 'Uniting Bharat'
    ]);
    // Send the request & save response to $resp
    $resp = curl_exec($curl);
    echo $resp;
    // Close request to clear up some resources
    curl_close($curl);

?>