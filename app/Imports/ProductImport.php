<?php

namespace App\Imports;

use App\Models\product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
		//echo $row[27];
		if($row[1]!="" && $row[1]!='Title'){
    		return new product([
                'pname'     				=> ''.$row[1],
                'des'    					=> 'no', 
                'img' 						=> '["'.$row[24].'"]',
    			'hsn' 						=> 'hsn',
    			'gst' 						=> '9',
    			'features' 					=> 'no',
    			'safety_information' 		=> 'no',
    			'ingredients' 				=> 'no',
    			'directions' 				=> 'no',
    			'legal_disclaimer' 			=> 'no',
    			'price_sale' 				=> ''.$row[19],
    			'price_purchase' 			=> '350',
    			'margin' 					=> '10',
    			'status' 					=> 'active',
    			'category' 					=> 'Home kitchen And Essential',
    			'brands' 					=> 'brands',
    			'discount' 					=> '10',
    			'packing' 					=> 'packing',
    			
            ]);
		}
		
    }
}
