<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_shriram;
use DB;
class ShriramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shriram=tbl_shriram::get();
        return view('shopee.view_product',compact('shriram'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shopee.add_product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name=$request->get('cname');
        $contact=$request->get('contact');
        $desc=$request->get('desc');
        $iron=$request->get('iron');
        $collar_size=$request->get('collar_size');
        $pendri=$request->get('pmap');
        $odate=$request->get('odate');
        $ddate=$request->get('ddate');
        $material=$request->get('material');
        
        $total=$request->get('total');
        $advance_amt=$request->get('advance_amt');
        
        if($material=="Shirt")
        {
            $shriram=new tbl_shriram([
                'name'=>$name,
                'mobile'=>$contact,
                'desc'=>$desc,
                'estri'=>"no",
                'ring'=>"no",
                'pendri'=>"no",
                'order_date'=>$odate,
                'delivery_date'=>$ddate,
                'material'=>$material,
                'material_qty'=>$request->get('mqty'),
                'total_amt'=>$total,
                'advance_amt'=>$advance_amt,
                'coller_size'=>$collar_size,
                'bound_patti_size'=>'no'
            ]);
            $shriram->save();
            return redirect('shirt_details');
        }
        else if($material=="Paint")
        {
            $shriram=new tbl_shriram([
            'name'=>$name,
            'mobile'=>$contact,
            'desc'=>$desc,
            'estri'=>$iron,
            'ring'=>$request->get('ring'),
            'pendri'=>$pendri,
            'order_date'=>$odate,
            'delivery_date'=>$ddate,
            'material'=>$material,
            'material_qty'=>$request->get('pqty'),
            'total_amt'=>$total,
            'advance_amt'=>$advance_amt,
            'coller_size'=>'no',
            'bound_patti_size'=>'no'
            ]);
            $shriram->save();
            return redirect('paint_details');
        }
        else if($material=="Kurta" || $material=="Nehru_shirt")
        {
            $shriram=new tbl_shriram([
                'name'=>$name,
                'mobile'=>$contact,
                'desc'=>$desc,
                'estri'=>"no",
                'ring'=>"no",
                'pendri'=>"no",
                'order_date'=>$odate,
                'delivery_date'=>$ddate,
                'material'=>$material,
                'material_qty'=>$request->get('kqty'),
                'total_amt'=>$total,
                'advance_amt'=>$advance_amt,
                'coller_size'=>'no',
                'bound_patti_size'=>$request->get('bound_size')
            ]);
            $shriram->save();
            if($material=="Kurta")
            {
                return redirect('kurta_details');
            }
            else if($material=="Nehru_shirt")
            {
                return redirect('nehrushirt_details');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shri=DB::table('tbl_shrirams')
                ->where('id','=',$id)
                ->select('*')
                ->first();
        return view('shopee.edit_product',compact('shri'));
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


        $name=$request->get('cname');
        $contact=$request->get('contact');
        $desc=$request->get('desc');
        $iron=$request->get('iron');
        $collar_size=$request->get('collar_size');
        $pendri=$request->get('pmap');
        $odate=$request->get('odate');
        $ddate=$request->get('ddate');
        $material=$request->get('material');
        
        $total=$request->get('total');
        $advance_amt=$request->get('advance_amt');
        
        if($material=="Shirt")
        {
            $shriram=tbl_shriram::find($id);
            $shriram->name=$name;
            $shriram->mobile=$contact;
            $shriram->desc=$desc;
            $shriram->estri="no";
            $shriram->ring="no";
            $shriram->pendri="no";
            $shriram->order_date=$odate;
            $shriram->delivery_date=$ddate;
            $shriram->material=$material;
            $shriram->material_qty=$request->get('mqty');
            $shriram->total_amt=$total;
            $shriram->advance_amt=$advance_amt;
            $shriram->coller_size=$collar_size;
            $shriram->bound_patti_size="no";
    
            $shriram->update();
            return redirect('shirt_details');
        }
        else if($material=="Paint")
        {
            $shriram=tbl_shriram::find($id);
            $shriram->name=$name;
            $shriram->mobile=$contact;
            $shriram->desc=$desc;
            $shriram->estri=$iron;
            $shriram->ring=$request->get('ring');
            $shriram->pendri=$pendri;
            $shriram->order_date=$odate;
            $shriram->delivery_date=$ddate;
            $shriram->material=$material;
            $shriram->material_qty=$request->get('pqty');
            $shriram->total_amt=$total;
            $shriram->advance_amt=$advance_amt;
            $shriram->coller_size="no";
            $shriram->bound_patti_size="no";
             $shriram->update();
            return redirect('paint_details');
        }
        else if($material=="Kurta" || $material=="Nehru_shirt")
        {
            $shriram=tbl_shriram::find($id);
            $shriram->name=$name;
            $shriram->mobile=$contact;
            $shriram->desc=$desc;
            $shriram->estri="no";
            $shriram->ring="no";
            $shriram->pendri="no";
            $shriram->order_date=$odate;
            $shriram->delivery_date=$ddate;
            $shriram->material=$material;
            $shriram->material_qty=$request->get('kqty');
            $shriram->total_amt=$total;
            $shriram->advance_amt=$advance_amt;
            $shriram->coller_size="no";
            $shriram->bound_patti_size=$request->get('bound_size');
    
            $shriram->update();
            if($material=="Kurta")
            {
                return redirect('kurta_details');
            }
            else if($material=="Nehru_shirt")
            {
                return redirect('nehrushirt_details');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shri=tbl_shriram::find($id);
        $shri->delete();
        return redirect()->back()->withSuccess('IT WORKS!');

    }
    public function printbill($id)
    {
        $shri=DB::table('tbl_shrirams')
                ->where('id','=',$id)
                ->select('*')
                ->get();
        return view('shopee.billprint',compact('shri'));
    }
    public function paint_details()
    {
        $paint=DB::table('tbl_shrirams')
                    ->where('material','=','Paint')
                    ->select('*')
                    ->get();
        return view('shopee.paint_details',compact('paint'));
    }
    public function shirt_details()
    {
        $paint=DB::table('tbl_shrirams')
                    ->where('material','=','Shirt')
                    ->select('*')
                    ->get();
        return view('shopee.shirt_details',compact('paint'));
    }
    public function kurta_details()
    {
        $paint=DB::table('tbl_shrirams')
                    ->where('material','=','Kurta')
                    ->select('*')
                    ->get();
        return view('shopee.kurta_details',compact('paint'));
    }
    public function nehrushirt_details()
    {
        $paint=DB::table('tbl_shrirams')
                    ->where('material','=','Nehru_shirt')
                    ->select('*')
                    ->get();
        return view('shopee.nehru_shirt_details',compact('paint'));
    }
    public function remaningapi($id)
    {
        echo $id;
    }
}
