<?php

    ini_set('max_execution_time', 1200);

    $cfile = fopen("balkrishna 31.1.21 cashfree.csv","r");
    include('config.php');
    $cnt = 0;
    while(($row1=fgetcsv($cfile))!=FALSE){
    
        if($cnt == 0){
            $cnt++;
            
        }
        else{
            
            $pcode = sprintf('%04d',$row1[4]);
            $pr = $row1[30];
            $sql = "update products set price_sale='$pr' where pcode='$pcode'";
            /*echo $sql;
            exit();*/
            if(!mysqli_query($con,$sql)){
                echo mysqli_error($con)."<br/>";
            }
        }
        
    }



?>