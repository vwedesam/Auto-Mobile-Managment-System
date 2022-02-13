<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel;

class ModelController extends Controller
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
    
    //**
     /* Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $product_model = new ProductModel(); 

        $editable = false;

        return view('options.model', compact('product_model', 'editable'));
    }

    /**
     * get Model with make id
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch($make_id)
    {
        $p_model = ProductModel::where('make_id', $make_id)->get();

        return $p_model;
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

        ProductModel::create($request->all());

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
        $product_model = ProductModel::find($id); 

        $editable = true;

        return view('options.model', compact('product_model', 'editable'));
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

        ProductModel::find($id)->update($request->all());

        return redirect()->route('product_model.index')->with('success', 'Model record updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            ProductModel::find($id)->delete();

            return redirect()->back()->with('success', 'Model record deleted');
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->with('error-message', ' Unable to Complete Transaction !!');
        }
    }
}
