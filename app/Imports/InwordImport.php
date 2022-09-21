<?php

namespace App\Imports;

use App\Models\inword_entry;
use App\Models\product_stock;
use Maatwebsite\Excel\Concerns\ToModel;
use DB;
class InwordImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {	 
		if($row[1]!="" && $row[1]!='Title')
		{
			//echo $row[1];
			$record=DB::table('products')
					->where('pname','=',$row[1])
					->get();
			foreach($record as $r)
			{
			    $pid=$r->id;
			    $f=sizeof($record);
    			if($f==0)
    			{
    				//echo "<script>alert('Some Products Are Not Added');</script>";
    				//echo "<script>window.location.href='/inword_entry';</script>";
    			}
    			else
    			{
    				//echo $row[1];
    				//echo "pname:".$record[0]->pname;
    				//exit();
    				if($row[0]!=""&&$row[0]!=null)
    				{
    					return new product_stock([
    						'pid'=>$pid,
    						'qty'=>$row[11]
    					]);
    				}
    				
    			}
			}
		  
		}
		
		
    }
}
