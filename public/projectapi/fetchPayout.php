<?php

    $con = mysqli_connect("localhost","shriarambhv_sl",'kDj+ZrzgG$y8',"shriarambhv_shopee");
    $ref = $_GET['ref'];
    $arr = array();
    
    /*$expay = [
            ["upi"=>"balkrishnayemul.by@oksbi"],
            ["upi"=>"balkrishnayemul.by@oksbi"],
            ["upi"=>"balkrishnayemul.by@oksbi"],
            ["upi"=>"balkrishnayemul.by@oksbi"]
        ];*/
    $expay = array();
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
    //var_dump($expay);
    //exit();
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
    $arr[0]['amt'] = "50.00";
    $arr[1]['amt'] = "10.00";
    $arr[2]['amt'] = "11.00";
    $arr[3]['amt'] = "12.00";
    $arr[4]['amt'] = "13.00";
    $arr[5]['amt'] = "14.00";
    $arr[6]['amt'] = "40.00";
    //echo sizeof($arr);
    echo json_encode($arr);
    

?>