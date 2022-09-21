<?php
        include('config.php');
        $mob = $_POST['mob'];
        $flag = $_POST['flag'];
        $data=array(0,1,2,3,4,5,6,7,8,9);
        $res = array();
        if($flag == "register"){
            
            $sql = "select * from registers where mobile = '$mob'";
            $rs = mysqli_query($con,$sql);
            if(mysqli_num_rows($rs)<=0){
                $refres='';
                $info['status'] = "success";
                //$data = array(1,2,3);
                for($i=0;$i<4;$i++)
                {
                    $t = rand(0,count($data)-1);
                    //echo "<br>$data[$t]";
                    $refres.=$data[$t];
                }
                sendMessage($mob,$refres);
                $info['otp'] = $refres;
                array_push($res,$info);
            }
            else{
                $info['status'] = "faile";
                $info['otp']= "User already exists";
                array_push($res,$info);
            }
            
        }
        else if($flag == "login"){
            
            $sql = "select * from registers where mobile = '$mob'";
            $rs = mysqli_query($con,$sql);
            if(mysqli_num_rows($rs)>0){
                $refres='';
                $rw = mysqli_fetch_row($rs);
                $info['status'] = "success";
                //$data = array(1,2,3);
                for($i=0;$i<4;$i++)
                {
                    $t = rand(0,count($data)-1);
                    //echo "<br>$data[$t]";
                    $refres.=$data[$t];
                }
                sendMessage($mob,$refres);
                $info['otp'] = $refres;
                $info['password'] = $rw[13];
                array_push($res,$info);
            }
            else{
                $info['status'] = "faile";
                $info['otp']= "Number not exists";
                array_push($res,$info);
                //echo "";
            }
        }
        echo json_encode($res);
      function sendMessage($mob,$re)
      {
          $otp_url = "http://smsindia.techmartonline.com/api/sendhttp.php?authkey=369118AVqm7z8q617faec5P1&mobiles=91$mob&message=Your%20SL%20MART%20OTP%20verification%20code%20is%20$re.%20Please%20don%E2%80%99t%20share%20this%20OTP%20with%20anyone&sender=SLMART&route=4&country=0&DLT_TE_ID=1207163549165953389";
          /*echo $otp_url;
          exit();*/
          //$reminder_url = "http://smsindia.techmartonline.com/api/sendhttp.php?authkey=369118AVqm7z8q617faec5P1&mobiles=919404919907,918805308888,919823026939&message=Your%20next%20SL%20MART%20purchase%20due%20date%20is%20on%2003/03/2022&sender=SLMART&route=4&country=0&DLT_TE_ID=1207163549174861271";
           $curl = curl_init();
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => 1,//0x00
                CURLOPT_URL => ''.$otp_url,
                CURLOPT_USERAGENT => 'SL MART'
            ]);
            // Send the request & save response to $resp
            $resp = curl_exec($curl);
            //echo $resp;
            // Close request to clear up some resources
            curl_close($curl);
            //echo $resp;
            //return $re;
      }

?>