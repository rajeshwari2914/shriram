<?php
    $con = mysqli_connect("localhost","shriarambhv_sl",'kDj+ZrzgG$y8',"shriarambhv_shopee");
    $ref = $_GET['ref'];
    $uid = $_GET['uid'];
    $payout = array();
    $expay = array();
    $arr = array();
    $data['upi'] = "9373784884@ybl";
    $data['nm'] = 'Swati Swami';
    $data['mob'] = '9373784884';
    $data['amt'] = "10.00";
    array_push($expay,$data);
    
    $data['upi'] = "balkrishnayemul.by@oksbi";
    $data['nm'] = 'B Yemul';
    $data['mob'] = '9403046045';
    $data['amt'] = "10.00";
    array_push($expay,$data);
    
    $data['upi'] = "9823026939@JIO";
    $data['nm'] = 'S Swami';
    $data['mob'] = '9823026939';
    $data['amt'] = "10.00";
    array_push($expay,$data);
    
    $data['upi'] = "swatiswami81@oksbi";
    $data['nm'] = 'S Swami';
    $data['mob'] = '9373784884';
    $data['amt'] = "10.00";
    array_push($expay,$data);
    
    $data['upi'] = "9403046045981@paytm";
    $data['nm'] = 'B Y';
    $data['mob'] = '9403046045';
    $data['amt'] = "10.00";
    array_push($expay,$data);
    
    $data['upi'] = "9403046045981@paytm";
    $data['nm'] = 'B Y';
    $data['mob'] = '9403046045';
    $data['amt'] = "10.00";
    array_push($expay,$data);
    for($i=1;$i<=7;$i++)
    {
        $sql = "select * from registers where ref='$ref'";
        $rs = mysqli_query($con,$sql);
        $rw=mysqli_fetch_row($rs);
        //$i=1;
        if(mysqli_num_rows($rs)>0){
            $ref = $rw[15];
            $data['upi'] = $rw[11];
            $data['nm'] = $rw[1];
            $data['mob'] = $rw[9];
            
            if($i==1)
                $data['amt'] = "50.00";
            else if($i==2)
                $data['amt'] = "10.00";
            else if($i==3)
                $data['amt'] = "11.00";
            else if($i==4)
                $data['amt'] = "12.00";
            else if($i==5)
                $data['amt'] = "13.00";
            else if($i==6)
                $data['amt'] = "14.00";
            else if($i==7)
                $data['amt'] = "40.00";
            
            /*if($i == 1)
                $data['amt'] = "50.00";
            else if($i==7)
                $data['amt'] = "41.00";
            else
                $data['amt'] = "10.00";*/
            array_push($arr,$data);
        }
        
    }
    
    //echo 7-sizeof($arr);
    if(sizeof($arr)<7){
        $i=sizeof($arr);
        //echo $i;
        for($j=1;$j<=7-$i;$j++){
            //echo $j;
            array_push($arr,$expay[$j-1]);
        }
    }
    //echo 7-sizeof($arr);
    $arr[0]['amt'] = "10.00";
    $arr[1]['amt'] = "10.00";
    $arr[2]['amt'] = "11.00";
    $arr[3]['amt'] = "12.00";
    $arr[4]['amt'] = "13.00";
    $arr[5]['amt'] = "14.00";
    $arr[6]['amt'] = "40.00";
    //echo sizeof($arr);
    echo json_encode($arr);
    exit();
    
    //echo json_encode($payout);
    /*echo $payout[0]['ref'];
    exit();*/
    
    
    for($i=0;$i<sizeof($arr);$i++)
    {
        
        $ref = $arr[$i]['ref'];
        $amt = $arr[$i]['amt'];
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
            if($i>=1 && $i<=5)
                $sql = "INSERT INTO `tbl_payout`( `uid`, `amt`, `status`) VALUES ('$rw[0]','$amt','$res')";
            else if($i==6)
                $sql = "INSERT INTO `tbl_payout`( `uid`, `amt`, `status`) VALUES ('$rw[0]','$amt','$res')";
            mysqli_query($con,$sql);
            
       
        
    }
    echo "success";
    
?>