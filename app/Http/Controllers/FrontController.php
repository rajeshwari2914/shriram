<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;
use App\Models\product;
use Session; 
use DB;

class FrontController extends Controller
{
    public function loginadmin()
    {
        return view('login');
    }
    public function checklogin(Request $request )
    {
        $email=$request->get('uname');
		$password=$request->get('psw');
		
		if(($email=='admin')&&($password=='admin123'))
			{
				$request->session()->put('user_id',$email);
				$login_id=$request->session()->get('user_id');
				return redirect('index');
			}
			else
			{
				echo "<script>alert('Invalid Credential');
				window.location.href='/';
				</script>";
			}	
		
    }
    public function sessionoff(Request $request)
    {
        $login_id=$request->session()->get('user_id');
		 if(null!==$login_id)
		 {
			 $p=$request->session()->forget('user_id');
			 echo "session unsest";
			 //exit();
			 //$f=$request->session()->get('user_id');
			 //echo $f;
			 return redirect('/');
		 }
    }
    public function backendlink()
    {
        return view('shopee.index');
    }
    public function index(Request $request)
	{
		// $username=$request->cookie('username');
		// $count_pro=DB::table('carts')
		// 			->where('uid','=',$username)
		// 			->count();
		// $username=$request->cookie('username');
		// $cate=DB::table('shopee_categories')
	    //             ->where('status','=','active')
	    //             ->get();
		// return view('front.index',compact('username','count_pro','cate'));
	}
	public function about(Request $request)
	{
		$username=$request->cookie('username');
		$count_pro=DB::table('carts')
					->where('uid','=',$username)
					->count();
		$cate=DB::table('categories')
	                ->where('status','=','active')
	                ->get();
		return view('front.about',compact('username','count_pro','cate'));
	}
	public function product(Request $request)
	{
	    echo "<script>window.location.href='/';</script>";
		$username=$request->cookie('username');
		$count_pro=DB::table('carts')
					->where('uid','=',$username)
					->count();
		$product=DB::table('products')
			->where('status','=','active')
			->select('*')
			->orderBy('price_sale','asc')
			->paginate(20);
			
		$cate=DB::table('categories')
	                ->where('status','=','active')
	                ->get();
		return view('front.product',compact('product','username','count_pro','cate'));
	}
	public function shopping_cart(Request $request)
	{
		$username=$request->cookie('username');
		$products=DB::table('carts')
					->join('products','products.id','=','carts.pid')
					->join('product_stocks','product_stocks.pid','=','carts.pid')
					->where('uid','=',$username)
					->select('*','carts.id as cid','product_stocks.qty as sqty')
					->get();
		$count_pro=DB::table('carts')
					->where('uid','=',$username)
					->count();
		$cate=DB::table('categories')
	                ->where('status','=','active')
	                ->get();
		return view('front.shopping_cart',compact('username','products','count_pro','cate'));
	}
	public function login()
	{
		$cate=DB::table('categories')
	                ->where('status','=','active')
	                ->get();
		return view('front.login',compact('cate'));
	}
	public function single_pro(Request $request,$name)
	{
	    $product=DB::table('products')
			->where('status','=','active')
			->get();
	    $str=str_replace('-',' ',$name);
		$username=$request->cookie('username');
		$cate=DB::table('categories')
	                ->where('status','=','active')
	                ->get();
		$pro=DB::table('products')
				->where('pname','=',$str)
				->select('*')
				->get();
		$pro_id=$pro[0]->id;
		$count_pro=DB::table('carts')
					->where('uid','=',$username)
					->count();
		$count_product_stock=DB::table('product_stocks')
					->where('pid','=',$pro_id)
					->select('*')
					->get();
		//var_dump($count_product_stock);
		//exit();
		$stock_qty="";
	    foreach($count_product_stock as $cop)
		{
			$stock_qty=$cop->qty;
		}
		$cpro_stock=$count_product_stock;
		//echo $cpro_stock;
		//exit();
		return view('front.single_pro_view',compact('pro','product','username','count_pro','cpro_stock','cate','stock_qty'));
	}
	public function shopping(Request $request,$id)
	{
		$username=$request->cookie('username');
		$pqty=1;
		$order_qty=DB::table('orders')
					->where('pid','=',$id)
					->count();
		$product_stock_qty=DB::table('shopee_product_stocks')
					->where('pid','=',$id)
					->count();
		if($product_stock_qty==0)
		{
			echo "<script>alert('Sorry Stock Not Available...');</script>";
			echo "<script>window.location.href='/';</script>";
		}
		else
		{
			if($order_qty==0)
			{
				if($username!="")
				{
				   
					$request->session()->put('pid',$id);
					$pro_id=$request->session()->get('pid');
					$request->session()->put('pro_qty',$pqty);
					$pro_qty=$request->session()->get('pro_qty');
					return redirect('/cart_create');
				}
				else
				{
				    
	                $host = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
					$ip = gethostbyname($host);
					$cookie =(cookie()->forever('username',$ip));
					$request->session()->put('pid',$id);
					$pro_id=$request->session()->get('pid');
					$request->session()->put('pro_qty',$pqty);
					$pro_qty=$request->session()->get('pro_qty');
					return redirect('/cart_create')->cookie($cookie);
				}
			}
			else
			{
				$order_qty_count=DB::table('orders')
					->where('pid','=',$id)
					->get();
				$product_qty_count=DB::table('shopee_product_stocks')
					->where('pid','=',$id)
					->get();
				$pqc=$product_qty_count[0]->qty;
				$order_qty_total=0;
				foreach($order_qty_count as $oqc)
				{
				
					$order_qty_total+=$oqc->qty;
				}
				if($order_qty_total!=$pqc)
				{
					if($username!="")
					{
						$request->session()->put('pid',$id);
						$pro_id=$request->session()->get('pid');
						$request->session()->put('pro_qty',$pqty);
						$pro_qty=$request->session()->get('pro_qty');
						return redirect('/cart_create');
					}
					else
					{
						$host = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
						$ip = gethostbyname($host);
						$cookie =(cookie()->forever('username',$ip));
						$request->session()->put('pid',$id);
						$pro_id=$request->session()->get('pid');
						$request->session()->put('pro_qty',$pqty);
						$pro_qty=$request->session()->get('pro_qty');
						return redirect('/cart_create')->cookie($cookie);
					}
				}
				else
					echo "<script>alert('out of stock');</script>";
					echo "<script>window.location.href='/shopping-cart';</script>";
				
			}
		}
	}
	public function data_add_cart(Request $request,$id)
	{
		$username=$request->cookie('username');
		$pro_qty=$request->get('pro_qty');
		$order_qty=DB::table('orders')
					->where('pid','=',$id)
					->count();
		$product_stock_qty=DB::table('product_stocks')
					->where('pid','=',$id)
					->count();
		if($product_stock_qty==0)
		{
			echo "<script>alert('Sorry Stock Not Available...');</script>";
			echo "<script>window.location.href='/shopping-cart';</script>";
		}
		else
		{
			if($order_qty==0)
			{
				if($username!="")
				{
					$request->session()->put('pid',$id);
					$pro_id=$request->session()->get('pid');
					$request->session()->put('pro_qty1',$pro_qty);
					$pro_quantity=$request->session()->get('pro_qty1');
					return redirect('/cart_create');
				}
				else
				{
					$host = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
					$ip = gethostbyname($host);
					$cookie =(cookie()->forever('username',$ip));
					$request->session()->put('pid',$id);
					$pro_id=$request->session()->get('pid');
					$request->session()->put('pro_qty1',$pro_qty);
					$pro_quantity=$request->session()->get('pro_qty1');
					return redirect('/cart_create')->cookie($cookie);
				}
			}
			else
			{
				$order_qty_count=DB::table('orders')
					->where('pid','=',$id)
					->get();
				$product_qty_count=DB::table('product_stocks')
					->where('pid','=',$id)
					->get();
				$pqc=$product_qty_count[0]->qty;
				
				$order_qty_total=0;
				foreach($order_qty_count as $oqc)
				{
					$order_qty_total+=$oqc->qty;
				}
				if($order_qty_total!=$pqc)
				{
					if($username!="")
					{
						$request->session()->put('pid',$id);
						$pro_id=$request->session()->get('pid');
						$request->session()->put('pro_qty1',$pro_qty);
						$pro_quantity=$request->session()->get('pro_qty1');
						return redirect('/cart_create');
					}
					else
					{
						$host = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
						$ip = gethostbyname($host);
						$cookie =(cookie()->forever('username',$ip));
						$request->session()->put('pid',$id);
						$pro_id=$request->session()->get('pid');
						$request->session()->put('pro_qty1',$pro_qty);
						$pro_quantity=$request->session()->get('pro_qty1');
						return redirect('/cart_create')->cookie($cookie);
					}
				}
				else
					echo "<script>alert('out of stock');</script>";
					echo "<script>window.location.href='/shopping-cart';</script>";
				
			}
		}
	}
	public function forget(Request $request)
	{
		$username=$request->cookie('username');
		$cartemail=cart::where('uid',$username);
		$cartemail->delete();
		$cookie = \Cookie::forget('username');
		return redirect('/')->cookie($cookie);
	}
	public function cart(Request $request)
	{
		//$reg=register::get();
		$name=$request->get('name');
		$pass=$request->get('pass');
		
		$rrq=$request->get('rrqq');
		$str = json_decode($rrq, true); 
		$login=DB::table('registers')
		        ->where('mobile','=',$name)
		        ->where('password','=',$pass)
		        ->select('*')
		        ->get();
		
			if ($login->count() == 0) 
		    {
	            echo "<script>alert('Please Enter Valid Mobile / Password')</script>";
	            echo "<script>window.location.href='/login';</script>";
	        }
	        else
	        {
				$email=$login[0]->mobile;
				$password=$login[0]->password;
				if($name==$email && $pass==$password)
				{
					$cookie =(cookie()->forever('username',$name));
					return redirect('/cookiupdate')->cookie($cookie); //cart add code
				}
				else
				{
					echo "<script>alert('First Create Your Account');</script>";
					echo "<script>window.location.href='/registration';</script>";
				}
	        }
	}
	public function Check_id(Request $request)
	{
		$username=$request->cookie('username');
		$qty=$request->get('qty1');
		$pid=$request->get('item_name');
		$rowcount=$request->get('rowcount');
		$rowtotal=$rowcount-1;
		$cart_pro=DB::table('products')
					->join('carts','carts.pid','=','products.id')
					->where('carts.uid','=',$username)
					->select('*','carts.id as cid','products.id as pid')
					->get();
		$count_pro=DB::table('carts')
					->where('uid','=',$username)
					->count();
		$reg=DB::table('registers')
					->where('mobile','=',$username)
					->select('*')
					->get();
		$cate=DB::table('categories')
	                ->where('status','=','active')
	                ->get();
		$chk=DB::table('registers')
				->where('mobile','=',$username)
				->get();
		foreach($chk as $p)
		{
			$x=$p->mobile;
			if($x!=null)
			{
			    $a1=[];
			    for($i=1; $i<=$rowtotal; $i++)
			    {
			        $pid=$request->get('item_name'.$i);
			        $pqty=$request->get('qty'.$i);
			        array_push( $a1,$pqty);
			    }
			    return view('front.check_out',compact('username','count_pro','reg','cart_pro','cate','a1'));
			}
		}
		for($i=1; $i<=$rowtotal; $i++)
		{
			        $pid=$request->get('item_name'.$i);
			        $pqty=$request->get('qty'.$i);
			        $cart_order=cart::where('pid','=',$pid)->where('uid','=',$username)->get();
			        $cart=cart::find($cart_order[0]->id);
			        $cart->pqty=$pqty;
		        	$cart->save();
		}
		$results=DB::update('update carts set uid=? where uid=?',[$username,$chk]);
		echo "<script>alert('login first');</script>";
		echo "<script>window.location.href='/login';</script>";
		
	}
	public function check_out(Request $request)
	{
		$username=$request->cookie('username');
		
		$cart_pro=DB::table('products')
					->join('carts','carts.pid','=','products.id')
					->where('carts.uid','=',$username)
					->select('*','carts.id as cid','products.id as pid')
					->get();
		$count_pro=DB::table('carts')
					->where('uid','=',$username)
					->count();
		$reg=DB::table('registers')
					->where('email','=',$username)
					->select('*')
					->get();
		$cate=DB::table('categories')
	                ->where('status','=','active')
	                ->get();
		//var_dump($reg);
		//exit();
		return view('front.check_out',compact('username','count_pro','reg','cart_pro','checkdata','cate'));
	}
	public function cookiupdate(Request $request)
	{
		$username=$request->cookie('username');
		$id=$request->session()->get('temp_username');
		DB::update('update carts set uid = ? where uid = ?',[$username,$id]);
		echo "<script>alert('Login Success');</script>";
		echo "<script>window.location.href='/';</script>";
	}
	public function cate_product(Request $request,$name)
	{
	    $str=str_replace('-',' ',$name);
		$username=$request->cookie('username');
		$cate=DB::table('shopee_categories')
	                ->where('status','=','active')
	                ->get();
		$count_pro=DB::table('carts')
					->where('uid','=',$username)
					->count();
		$cate_pro=DB::table('shopee_products')
	                 ->where([
                            ["category", "=", $str],
                            ["status", "=", "active"]
                        ])
                     ->orderBy('price_sale','asc')
	                ->paginate(16);
	    return view('front.cate_product',compact('cate_pro','username','cate','count_pro'));
	}
	public function terms_conditions(Request $request)
	{
		$username=$request->cookie('username');
		 $cate=DB::table('categories')
	                ->where('status','=','active')
	                ->get();
	   	$count_pro=DB::table('carts')
					->where('uid','=',$username)
					->count();
	    return view('front.terms-conditions',compact('username','cate','count_pro'));
	}
	public function privacy_policy(Request $request)
	{
		$username=$request->cookie('username');
		 $cate=DB::table('categories')
	                ->where('status','=','active')
	                ->get();
	   	$count_pro=DB::table('carts')
					->where('uid','=',$username)
					->count();
	    return view('front.privacy-policy',compact('username','cate','count_pro'));
	}
	public function shipping_policy(Request $request)
	{
		$username=$request->cookie('username');
		 $cate=DB::table('categories')
	                ->where('status','=','active')
	                ->get();
	   	$count_pro=DB::table('carts')
					->where('uid','=',$username)
					->count();
	    return view('front.shipping-policy',compact('username','cate','count_pro'));
	}
	public function forgetpassword(Request $request)
	{
	    $username=$request->cookie('username');
		$cate=DB::table('categories')
	                ->where('status','=','active')
	                ->get();
	    return view('front.forgetpassword',compact('username','cate'));
	}
	public function changepass(Request $request)
    {
        $email=$request->get('email');
        $cpass=$request->get('cpass');
        $npass=$request->get('npass');
        if($cpass==$npass)
        {
            $reg=register::where('email',$email)->first();
            if($reg==null)
            {
                echo "<script>alert('Please Enter Valid Email')</script>";
                echo "<script>window.location.href='/forgetpassword';</script>";
            }
            else
            {
                $reg=register::where('email',$email)->first();
                $reg->password=$cpass;
                $reg->update();
                echo "<script>alert('Your Password Has Been Changed')</script>";
                echo "<script>window.location.href='/login';</script>";
            }
        }
        else
        {
            echo "<script>alert('Please Enter Correct Confirm Password')</script>";
            echo "<script>window.location.href='/forgetpassword';</script>";
        }
    }
    public function search(Request $request,$res)
    {
        //$name=$request->get('name');
       // echo $res;
        //exit();
        $cate_pro=DB::table('categories')
                ->join('products','products.category','=','categories.cname')
                ->where('products.pname','like','%'.$res.'%')
                ->orWhere('categories.cname', 'like', '%' . $res . '%')
                ->orWhere('products.pcode','=',$res)
                ->get();
        $username=$request->cookie('username');
		$cate=DB::table('categories')
	                ->where('status','=','active')
	                ->get();
	    $count_pro=DB::table('carts')
					->where('uid','=',$username)
					->count();
	    if(sizeof($cate_pro)==0)
        {
            return view('front.searched_empty',compact('cate_pro','username','cate','count_pro'));
        }
        else
        {
            return view('front.product_search',compact('cate_pro','username','cate','count_pro'));
        }
    }
    public function formto(Request $request)
    {
        
        $start =$request->get('d1');
        $end =$request->get('d2');
       // echo $start;
       // echo $end;
       
        $get_all_user =DB::table('billdetails')
                        ->join('bills','bills.cid','=','billdetails.id')
                        ->whereDate('bills.bill_date','<=',$end)
                        ->whereDate('bills.bill_date','>=',$start)
                        ->select('*','bills.id as bid')
                        ->get();
        return view('shopee.datetolist',compact('get_all_user'));
    }
    public function subscribe_list()
    {
        $sub=subscribe::get();
        return view('shopee.view_subscribe',compact('sub'));
    }
    public function subscribe_remove(Request $request)
    {
        $id=$request->get('sub');
        $sub=subscribe::find($id);
        $sub->delete();
        return redirect('/subscribe_list');
    }
    public function myorders(Request $request)
    {
        $username=$request->cookie('username');
        $products=DB::table('billdetails')
					->join('bills','bills.cid','=','billdetails.id')
					->join('orders','orders.bid','=','bills.id')
					->join('products','products.id','=','orders.pid')
					->where('billdetails.phone','=',$username)
					->select('*','billdetails.id as bid','bills.id as billsid','orders.qty as sqty')
					->get();
		//var_dump($products);
		//exit();
		$cate=DB::table('categories')
	                ->where('status','=','active')
	                ->get();
        return view('front.myorders',compact('username','products','cate'));
        
        
    }
}
