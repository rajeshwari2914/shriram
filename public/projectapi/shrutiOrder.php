<?php

    $url = "https://shrutiapi.shruticreation.com/api/shruti_creation/set_orders";
    $info['Name']="Santoshkumar Swami";
    $info['MobileNo']="9823026939";
    $info['Address']="Plot No. 7, Attar nagar, Vijapur road";
    $info['Pincode']="413004";
    $info['Country']="India";
    $info['State']="Maharashtra";
    $info['City']="Solapur";
    $info['Landmark']="Opp. to Global house";
    $data['ShippingAddress']=$info;
    $order['SKU']="SC210729012338274";
    $order['ProductName']="Rama Green Butterfly Net Embroidered Anarkali Suit";
    $order['Quanity']="1";
    $arr = array();
    array_push($arr,$order);
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://shrutiapi.shruticreation.com/api/shruti_creation/set_orders',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 10,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'key_id=grh.swami@gmail.com&key_secret=shruti@123&address='.json_encode($data).'&order_amount=2483&order_items='.json_encode($arr)
    ));
    
    $res = curl_exec($curl);
    
    curl_close($curl);
    //echo $res."<br/>";
    var_dump(json_decode($res));

?>