<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductMake;

class MakeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user_status');
        $this->middleware('user_permission')->except('fetch');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_make = new ProductMake(); 

        $editable = false;

        return view('options.make', compact('product_make', 'editable'));
    }

    /**
     * get make with product id
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch($product_id)
    {
        $p_make = ProductMake::where('product_id', $product_id)->get();

        return $p_make;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required'
        ]);

        ProductMake::create($request->all());

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_make = ProductMake::find($id); 

        $editable = true;

        return view('options.make', compact('product_make', 'editable'));
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

        ProductMake::find($id)->update($request->all());

        return redirect()->route('product_make.index')->with('success', 'Make record updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            ProductMake::find($id)->delete();

            return redirect()->back()->with('success', 'Make record deleted');
            
        }catch(\Illuminate\Database\QueryException $e){

            return redirect()->back()->with('error-message', ' Unable to Complete Transaction !!');
        }

    }


}
