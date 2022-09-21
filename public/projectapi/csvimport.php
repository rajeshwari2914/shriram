<?php
ini_set('max_execution_time', 1200);

$cfile = fopen("PLAN-AA.csv","r");
//print_r(fgetcsv($file));
//exit();
$con = mysqli_connect("localhost","root","","shopee");
$cnt = 0;
while(($row1=fgetcsv($cfile))!=FALSE){
    if($cnt==0)
		$cnt++;
	else
	{
		
		$pnm = str_replace("'","",$row1[1]);
		$des = str_replace("'","",$row1[2]);
		$img = array();
		for($i = 11; $i<=21;$i++)
		{
			array_push($img,$row1[$i]);
		}
		$img = json_encode($img);
		// echo json_encode($img);
		// exit();
		//print_r($img);
		$hsn = $row1[9];
		$gst = $row1[10];
		$feature = 'no';
		$si = 'no';
		$ing = 'no';
		$direc = 'no';
		$lgl = 'no';
		$pr = $row1[31];
		$p = '0';
		$m = '0';
		$st = 'active';
		$ct = $row1[3];
		$brand = 'SL';
		$dis = $row1[28];
		$pcode = $row1[4];
		$pk = "";
		$sql = "INSERT INTO `products`(`pname`, `des`, `img`, `hsn`, `gst`, `features`, `safety_information`, `ingredients`, `directions`, `legal_disclaimer`, `price_sale`, `price_purchase`, `margin`, `status`, `category`, `brands`, `discount`, `pcode`, `packing`) VALUES ('$pnm','$des','$img','$hsn','$gst','$feature','$si','$ing','$direc','$lgl','$pr','$p','$m','$st','$ct','$brand','$dis','$pcode','$pk')";
		if(!mysqli_query($con,$sql)){
			echo mysqli_error($con);
			echo "<br/>";
			exit();
		}
		//echo $sql;
		//exit();
		//exit();
    
	}
    
}
//fclose($file);
fclose($cfile);
?>