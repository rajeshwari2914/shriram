<?php

    include('config.php');
    $fname=$_POST['fname'];
    $address = $_POST['address'];
    $land = $_POST['land'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $tehsil = $_POST['tehsil'];
    $pin = $_POST['pin'];
    $mob = $_POST['mob'];
    $pan = $_POST['pan'];
    $upi = $_POST['upi'];
    $uref = $_POST['uref'];
    $pass = $_POST['pass'];
    $ref = getReferral();
    
    $sql = "insert into registers(full_name,address,landmark,city,state,tehsil,pin,mobile,pan,upi,ref,password,under_ref,pstatus) values('$fname','$address','$land','$city','$state','$tehsil','$pin','$mob','$pan','$upi','$ref','$pass','$uref','pending')";
    //echo $sql;
    //exit();
    //echo $sql;
    //exit();
    if(mysqli_query($con,$sql))
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
              "beneId": "'.$ref.'",
              "name": "'.$fname.'",
              "email": "sriarambh@gmail.com",
              "phone": "'.$mob.'",
              "vpa": "'.$upi.'",
              "address1": "Solapur"
              
        }',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token,
            'Content-Type:application/json'
          ),
        ));
        
        $res = curl_exec($curl);
        curl_close($curl);
        echo "success";
        
    }
    else{
        //echo mysqli_query($con);
        echo "Credentials already exist";
    }
    
    function getReferral()
    {
        $con=mysqli_connect("localhost","shriarambhv_sl",'kDj+ZrzgG$y8',"shriarambhv_shopee");
        $data=array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
        $refres='SR_';
        //$data = array(1,2,3);
        for($i=0;$i<5;$i++)
        {
            $t = rand(0,count($data)-1);
            //echo "<br>$data[$t]";
            $refres.=$data[$t];
        }
        $sql = "select * from tbl_reg where ref='$refres'";
        $rs = mysqli_query($con,$sql);
        if(mysqli_num_rows($rs)>0){
            //echo "<br>";
           getReferral();
        }
        else
            return $refres;
    }
?>