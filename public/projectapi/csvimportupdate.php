<?php
ini_set('max_execution_time', 1200);

$cfile = fopen("MASTER UPLOAD 10.1.21.csv","r");
//print_r(fgetcsv($file));
//exit();
//$con = mysqli_connect("localhost","root","","shopee");
include('config.php');
$cnt = 0;
while(($row1=fgetcsv($cfile))!=FALSE){
    
    $pc = sprintf('%04d', $row1[0]);
    $sql = "select * from products where pname like '%$pc%'";
    $rs = mysqli_query($con,$sql);
    if(mysqli_num_rows($rs)<=0)
    {
        $rpnm = str_replace("'","",$row1[1]);
        $sql = "update products set price_sale='$row1[15]', discount='$row1[16]', category = '$row1[2]',pname='$rpnm',pcode='$pc',status='active' where pname like '%$pc%'";
        
        if(!mysqli_query($con,$sql))
        		    {
        		     echo mysqli_error($con);
        			 echo '<br/>'.$sql;
        			 echo $i;
        		    }
    }
    //$sql = "update products set price_sale='$row1[15]', discount='$row1[16]', category = '$row1[2]' where pcode = '$pc'";
    	            
    	            /*echo $sql."<br/>";
    	            exit();*/
        		    /*if(!mysqli_query($con,$sql))
        		    {
        		     echo mysqli_error($con);
        			 echo '<br/>'.$sql;
        			 echo $i;
        		    }*/
        		    
        		    //$i++;
    
    
    /*if($cnt==0)
		$cnt++;
		 
	else
	{
	    //$rowdata=$row1[12];
	    $pro=$row1[1];
	    //echo $row1[3];
	    $s="SELECT count('pname') FROM `products` WHERE pname like ('%$row1[1]%') and ca";
	    $k=mysqli_query($con,$s);
	    $p=mysqli_fetch_row($k);
	    $pcount=$p[0];
	    //echo $pcount;
	    //exit();
	    $i=1;
	    if($pcount>=1)
	    {
	           // echo $row1[0];
	           // echo $row1[3];
	           // exit();
	            //$img='["'.$row1[2].'","'.$row1[3].'","'.$row1[4].'","'.$row1[5].'","'.$row1[6].'","'.$row1[7].'","'.$row1[8].'","'.$row1[9].'","'.$row1[10].'","'.$row1[11].'"]';
    	        //$r=str_replace("'",'',$row1[0]);
    	        //$des=str_replace('"','',$row1[2]);
    	        //$des=str_replace("'",'',$des);
    	        
    	            $sql = "update products set price_sale='$row1[17]' where pname like ('%$row1[1]%')";
    	            
    	            echo $sql;
    	            exit();
        		    if(!mysqli_query($con,$sql))
        		    {
        		     echo mysqli_error($con);
        			 echo '<br/>'.$sql;
        			 echo $i;
        		    }
        		    $i++;
    	        
	        
	    }*/
	  /*  else
	    {
	       
    	       $img='["'.$row1[10].'","'.$row1[11].'","'.$row1[12].'","'.$row1[13].'","'.$row1[14].'","'.$row1[15].'","'.$row1[16].'","'.$row1[17].'","'.$row1[18].'","'.$row1[19].'"]';
    	       $des=str_replace("'",'',$row1[0]);
    	        //$des=str_replace("'",'',$des);
    	       $sql2 = "insert into products (pname,price_sale,category,status,gst,img)values('$des',$row1[7],'$row1[1]','active','$row1[5]','$img')";
    		   if(!mysqli_query($con,$sql2))
    		   {
    		     echo mysqli_error($con);
    			 echo '<br/>'.$sql;
    		   }
	       
	   }*/
	   // exit();
		//var_dump($test);
		//echo $test;
		//exit();
		
	   // $row1[3]=str_replace("'",'',$row1[3]);
		/*$sql = "update products set price_sale='$row1[1]',pcode='$row1[2]',price_purchase='$row1[5]',discount='$row1[7]',gst='$row1[9]' where pname='$row1[3]'";
		if(!mysqli_query($con,$sql))
		{
			echo mysqli_error($con);
			echo '<br/>'.$sql;
			exit();
		}*/
	
    
}
fclose($cfile);
?>