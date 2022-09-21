<?php
    include('config.php');
    $url = "https://shrutiapi.shruticreation.com/api/shruti_creation/products";
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://shrutiapi.shruticreation.com/api/shruti_creation/products',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 10,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'key_id=grh.swami@gmail.com&key_secret=shruti@123&stock_type=0&increment_value=1&category=Lehenga'
    ));
    
    $res = curl_exec($curl);
    
    curl_close($curl);
    //echo $res."<br/>";
    $arr = json_decode($res);
    
    //echo sizeof($arr->data->products);
    
    foreach($arr->data->products as $a){
        //echo $a->product_name;
        $sprice = $a->standard_price+160;
        $img = '["'.$a->main_image_url.'"]';
        $sql = "INSERT INTO `products`(`pname`, `des`, `img`, `hsn`, `gst`, `features`, `safety_information`, `ingredients`, `directions`, `legal_disclaimer`, `price_sale`, `price_purchase`, `margin`, `status`, `category`, `brands`, `discount`, `pcode`, `packing`) VALUES ('$a->product_name','$a->product_description','$img','$a->hsn_code','5','no','no','no','no','no','$sprice','$a->standard_price','10','active','$a->category_name','SHR','0','$a->item_sku','$a->shipping_weight_unit_of_measure')";
        if(!mysqli_query($con,$sql))
        {
            echo "<br/>".mysqli_error($con)."<br/>";
            //exit();
        }
        else{
            echo "inserted";
            //exit();
        }
        //var_dump($a);
    }

?>