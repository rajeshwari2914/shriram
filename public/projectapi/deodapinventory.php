<?php

if(isset($_POST['importSubmit']))
{
    ini_set('max_execution_time', 1200);
    $cfile = fopen($_FILES['file']['tmp_name'], 'r');
    //$cfile = fopen("inventory_(12-01-22).csv","r");
    //print_r(fgetcsv($file));
    //exit();
    //$con = mysqli_connect("localhost","root","","shopee");
    include('config.php');
    $cnt = 0;
    while(($row1=fgetcsv($cfile))!=FALSE){
        if($cnt==0)
    		$cnt++;
    		 
    	else
    	{
    	    //$rowdata=$row1[12];
    	    $sql = "select * from products where pcode = '$row1[1]'";
    	    /*echo $sql;
    	    exit();*/
    	    $rs = mysqli_query($con,$sql);
    	    /*echo $sql."<br/>";
    	    
    	    var_dump($rs);
    	    exit();*/
    	    if(mysqli_num_rows($rs)>0)
    	    {
    	        $rw = mysqli_fetch_row($rs);
    	        $sql = "select * from product_stocks where pid = '$rw[0]'";
    	        //echo $sql."<br/>";
    	        $rs1= mysqli_query($con,$sql);
    	        if(mysqli_num_rows($rs1)>0)
    	        {
    	            $sq = "update product_stocks set qty='$row1[11]' where pid='$rw[0]'";
    	            mysqli_query($con,$sq);
    	            echo "updated";
    	        }
    	        else{
    	            $sq = "insert into product_stocks(pid,qty) values('$rw[0]','$row1[11]')";
    	            mysqli_query($con,$sq);
    	            echo "inserted";
    	        }
    	        /*echo $rw[0]." ".$row1[11];
    	        exit();*/
    	    }
    	    
    	}
        
    }
    fclose($cfile);
}
else{
    echo "not button click to perform";
}
?>
<html>
        <form method="post" enctype="multipart/form-data">
            Please Select Inventory file for upload<input type="file" name="file" />
            <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
        </form>
</html>