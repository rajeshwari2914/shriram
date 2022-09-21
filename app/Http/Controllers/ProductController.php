<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Input;
use Illuminate\Http\Request;
use App\Models\shopee_product;
use Maatwebsite\Excel\Facades\Excel;
use DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $login_id=$request->session()->get('user_id');
		 if($login_id==null)
		 {
			 return redirect('/admin');
		 }else
		 {
		    $data=DB::table('shopee_products')
		                ->join('shopee_categories','shopee_categories.cname','=','shopee_products.category')
		                ->select('*','shopee_products.id as pid')
		                ->get();
		    $demo = array();
	        return view('shopee.view_product',compact('data','demo'));
		 }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $login_id=$request->session()->get('user_id');
		 if($login_id==null)
		 {
			 return redirect('/admin');
		 }else
		 {
        $cate=DB::table('shopee_categories')
                ->where('status','=','active')
                ->get();
        return view('shopee.add_product',compact('cate'));
		 }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
		'pname'=>'required',
		'des'=>'required',
		
		'img.*'=>'image',
		'features'=>'required',
		'price_sale'=>'required',
		'price_purchase'=>'required',
		'margin'=>'required',
		'safety_information'=>'required',
		'ingredients'=>'required',
		'directions'=>'required',
		'legal_disclaimer'=>'required',
		'status'=>'required'
		]);
		$img=$request->file('img');
		$login_id=$request->session()->get('user_id');
		$pcode=$request->get('pcode');
		 if($login_id==null)
		 {
			 return redirect('/admin');
		 }else
		 {
		    if($request->hasfile('img'))
		    {
		        foreach($request->file('img') as $image)
		         {
					//$file = $request->file('img');
					$fpaht = $image->getClientOriginalName();
					$image->move('../public_html/product_images',$fpaht);
					$data[]=$fpaht;
		        }
		    $pro = new shopee_product([
		        'category'=>$request->get('cid'),
				'pname'=>$request->get('pname'),
				'des'=>$request->get('des'),
				'features'=>$request->get('features'),
				'price_sale'=>$request->get('price_sale'),
				'price_purchase'=>$request->get('price_purchase'),
				'status'=>$request->get('status'),
				'margin'=>$request->get('margin'),
				'safety_information'=>$request->get('safety_information'),
				'ingredients'=>$request->get('ingredients'),
				'directions'=>$request->get('directions'),
				'legal_disclaimer'=>$request->get('legal_disclaimer'),
				'img'=>json_encode($data),
				'hsn'=>$request->get('hsn'),
				'gst'=>$request->get('gst'),
				'brands'=>$request->get('brands'),
				'pcode'=>$request->get('pcode'),
				'discount'=>$request->get('discount'),
				'packing'=>$request->get('packing')
				
			]);
			$pro->save();
		    return redirect('products');
		} 
		}   if($img==null)
		{
		    $pro = new shopee_product([
		        'category'=>$request->get('cid'),
				'pname'=>$request->get('pname'),
				'des'=>$request->get('des'),
				'features'=>$request->get('features'),
				'price_sale'=>$request->get('price_sale'),
				'price_purchase'=>$request->get('price_purchase'),
				'status'=>$request->get('status'),
				'margin'=>$request->get('margin'),
				'safety_information'=>$request->get('safety_information'),
				'ingredients'=>$request->get('ingredients'),
				'directions'=>$request->get('directions'),
				'legal_disclaimer'=>$request->get('legal_disclaimer'),
				'img'=>'null',
				'hsn'=>$request->get('hsn'),
				'gst'=>$request->get('gst'),
				'brands'=>$request->get('brands'),
				'discount'=>$request->get('discount'),
				'pcode'=>$request->get('pcode'),
				'packing'=>$request->get('packing')
				
			]);
			$pro->save();
		    return redirect('products');
		} else if($pcode==null)
		{
		    $pro = new shopee_product([
		        'category'=>$request->get('cid'),
				'pname'=>$request->get('pname'),
				'des'=>$request->get('des'),
				'features'=>$request->get('features'),
				'price_sale'=>$request->get('price_sale'),
				'price_purchase'=>$request->get('price_purchase'),
				'status'=>$request->get('status'),
				'margin'=>$request->get('margin'),
				'safety_information'=>$request->get('safety_information'),
				'ingredients'=>$request->get('ingredients'),
				'directions'=>$request->get('directions'),
				'legal_disclaimer'=>$request->get('legal_disclaimer'),
				'img'=>'null',
				'hsn'=>$request->get('hsn'),
				'gst'=>$request->get('gst'),
				'brands'=>$request->get('brands'),
				'discount'=>$request->get('discount'),
				'pcode'=>null,
				'packing'=>$request->get('packing')
				
			]);
			$pro->save();
		    return redirect('products');
		}
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $login_id=$request->session()->get('user_id');
		 if($login_id==null)
		 {
			 return redirect('/admin');
		 }else
		 {
        $cate1=shopee_product::find($id);
        $demo = array();
		return view('shopee.show_product',compact('cate1','demo'));
		 }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $login_id=$request->session()->get('user_id');
		 if($login_id==null)
		 {
			 return redirect('/admin');
		 }else
		 {
        $cate=DB::table('shopee_categories')
                    ->where('status','=','active')
                    ->get();
        $pro=shopee_product::find($id);
		$demo = array();
        return view('shopee.edit_product',compact('pro','demo','cate'));
		 }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
		'pname'=>'required',
		'des'=>'required',
		'features'=>'required',
		'price_sale'=>'required',
		'price_purchase'=>'required',
		'margin'=>'required',
		'safety_information'=>'required',
		'ingredients'=>'required',
		'directions'=>'required',
		'legal_disclaimer'=>'required',
		'status'=>'required'
		]);
		$liveimg=$request->get('liveimg');
	    //echo $liveimg;
		//exit();
		$login_id=$request->session()->get('user_id');
		 if($login_id==null)
		 {
			 return redirect('/admin');
		 }else
		 {
		$cat = shopee_product::find($id);
		if($request->hasfile('img'))
		{
			foreach($request->file('img') as $image)
		    {
			//$file = $request->file('img');
			$fpaht = $image->getClientOriginalName();
			$image->move('../public_html/product_images',$fpaht);
			$data[]=$fpaht;
	    	}
	    	
	    	    $cat->category=$request->get('cid');
    			$cat->pname=$request->get('pname');
    			$cat->des=$request->get('des');
    			
    			$cat->price_sale=$request->get('price_sale');
    			$cat->price_purchase=$request->get('price_purchase');
    			$cat->status=$request->get('status');
    			$cat->margin=$request->get('margin');
    			$cat->features=$request->get('features');
    			$cat->safety_information=$request->get('safety_information');
    			$cat->ingredients=$request->get('ingredients');
    			$cat->directions=$request->get('directions');
    			$cat->legal_disclaimer=$request->get('legal_disclaimer');
    			
    			$cat->img=json_encode($data);
    			$cat->hsn=$request->get('hsn');
    			$cat->gst=$request->get('gst');
    			$cat->brands=$request->get('brands');
    			$cat->discount=$request->get('discount');
    			$cat->packing=$request->get('packing');
    			//$file->move(public_path('product_images'),$fpaht);
    			$cat->save();
	    	    return redirect('products');
		}else if($liveimg!="")
		{
		     $cat->category=$request->get('cid');
    			$cat->pname=$request->get('pname');
    			$cat->des=$request->get('des');
    			
    			$cat->price_sale=$request->get('price_sale');
    			$cat->price_purchase=$request->get('price_purchase');
    			$cat->status=$request->get('status');
    			$cat->margin=$request->get('margin');
    			$cat->features=$request->get('features');
    			$cat->safety_information=$request->get('safety_information');
    			$cat->ingredients=$request->get('ingredients');
    			$cat->directions=$request->get('directions');
    			$cat->legal_disclaimer=$request->get('legal_disclaimer');
    			
    			$cat->img=$liveimg;
    			$cat->hsn=$request->get('hsn');
    			$cat->gst=$request->get('gst');
    			$cat->brands=$request->get('brands');
    			$cat->discount=$request->get('discount');
    			$cat->packing=$request->get('packing');
    			//$file->move(public_path('product_images'),$fpaht);
    			$cat->save();
	    	    return redirect('products');
		}
		else
		{
			$cat->pname=$request->get('pname');
			$cat->des=$request->get('des');
			 $cat->category=$request->get('cid');
			$cat->price_sale=$request->get('price_sale');
			$cat->price_purchase=$request->get('price_purchase');
			$cat->status=$request->get('status');
			$cat->margin=$request->get('margin');
			$cat->features=$request->get('features');
			$cat->safety_information=$request->get('safety_information');
			$cat->ingredients=$request->get('ingredients');
			$cat->directions=$request->get('directions');
			$cat->legal_disclaimer=$request->get('legal_disclaimer');
			$cat->hsn=$request->get('hsn');
			$cat->gst=$request->get('gst');
			$cat->brands=$request->get('brands');
			$cat->discount=$request->get('discount');
			$cat->packing=$request->get('packing');
			
			$cat->save();
			return redirect('products');
			//return redirect('/categorydata');
		}
		$cate->update($request->all());
		
		return redirect('products');
		 }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $login_id=$request->session()->get('user_id');
		 if($login_id==null)
		 {
			 return redirect('/admin');
		 }else
		 {
        $d=shopee_product::find($id);
	   $d->delete();
	   return redirect('products');
		 }
    }
	public function import(Request $request) 
    {
        $login_id=$request->session()->get('user_id');
		 if($login_id==null)
		 {
			 return redirect('/admin');
		 }else
		 {
        Excel::import(new ProductImport,request()->file('file'));
        return redirect()->back()->with('success', 'Data saved successfully!');
		 }
    }
    public function updatesliderimg()
    {
        $pro=product::get();
        return view('shopee.updatesliderimg',compact('pro'));
    }
    public function updateproduct(Request $request)
    {
        $pro_name=$request->get('pro_name');
        $img=$request->get('sliderimg');
        $p=DB::table('products')
                ->where('pname','=',$pro_name)
                ->get();
        $id=$p[0]->id;
            $pro_edit=shopee_product::find($id);
            $pro_edit->img=$img;
            $pro_edit->update();
            return redirect('/updatesliderimg');
		
        
    }
}
