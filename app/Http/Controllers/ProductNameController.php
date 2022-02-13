<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductName;

class ProductNameController extends Controller
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
    	$product_name = new ProductName();

    	$editable = false;

        return view('options.index', compact('product_name', 'editable'));
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

    	$table = new ProductName();

        $table->name = $request['name'];
        $table->save();

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
        $product_name = ProductName::findOrFail($id);

        $editable = true;

        return view('options.index', compact('product_name', 'editable'));
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
        ProductName::find($id)->update($request->all());

        return redirect()->route('product_name.index')->with('success', 'record updated');

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
            ProductName::find($id)->delete();

            return redirect()->back()->with('success', 'record deleted');
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->with('error-message', ' Unable to Complete Transaction !!');
        }
    }
}
