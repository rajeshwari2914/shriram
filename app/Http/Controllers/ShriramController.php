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
        $ring=$request->get('ring');
        $pendri=$request->get('pendri');
        $odate=$request->get('odate');
        $ddate=$request->get('ddate');
        $shirt_qty=$request->get('shirt_qty');
        $paint_qty=$request->get('paint_qty');
        $total=$request->get('total');
        $advance_amt=$request->get('advance_amt');
        $shriram=new tbl_shriram([
            'name'=>$name,
            'mobile'=>$contact,
            'desc'=>$desc,
            'estri'=>$iron,
            'ring'=>$ring,
            'pendri'=>$pendri,
            'order_date'=>$odate,
            'delivery_date'=>$ddate,
            'shirt_qty'=>$shirt_qty,
            'paint_qty'=>$paint_qty,
            'total_amt'=>$total,
            'advance_amt'=>$advance_amt
        ]);
        $shriram->save();
        return redirect('details');
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
        $shri=tbl_shriram::find($id);
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
        $ring=$request->get('ring');
        $pendri=$request->get('pendri');
        $odate=$request->get('odate');
        $ddate=$request->get('ddate');
        $shirt_qty=$request->get('shirt_qty');
        $paint_qty=$request->get('paint_qty');
        $total=$request->get('total');
        $advance_amt=$request->get('advance_amt');
        $shriram=tbl_shriram::find($id);
        $shriram->name=$name;
        $shriram->mobile=$contact;
        $shriram->desc=$desc;
        $shriram->estri=$iron;
        $shriram->ring=$ring;
        $shriram->pendri=$pendri;
        $shriram->order_date=$odate;
        $shriram->delivery_date=$ddate;
        $shriram->shirt_qty=$shirt_qty;
        $shriram->paint_qty=$paint_qty;
        $shriram->total_amt=$total;
        $shriram->advance_amt=$advance_amt;
    
        $shriram->update();
        return redirect('details');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function printbill($id)
    {
        $shri=DB::table('tbl_shrirams')
                ->where('id','=',$id)
                ->select('*')
                ->get();
        return view('shopee.billprint',compact('shri'));
    }
}
