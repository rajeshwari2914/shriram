//echo $id;
		$product_stock_qty_get=DB::table('product_stocks')
						->where('pid','=',$id)
						->select('*')
						->get();
		echo $product_stock_qty_get[0]->qty;
		$product_stock_count_get=DB::table('product_stocks')
						->where('pid','=',$id)
						->count();
		echo $product_stock_count_get;
		if($product_stock_count_get==0)
		{
			echo "out of stock";
		}
		else
		{
			echo "process";
		}
		exit();