<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
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
        $this->middleware('user_permission')->except(['fetch']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$all_products = Product::paginate(1);

        return view('products.index');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {

        if( isset($request['product_id']) ){

            $all_products = Product::with('product_name')->with('make')->with('model')->where('product_name_id', $request['product_id'])->get();

               if( isset($request['make']) && $request['make'] != null ){

            $all_products = Product::with('product_name')->with('make')->with('model')->where('product_name_id', $request['product_id'] )->where('make_id', $request['make'])->get();

                    if( isset($request['model']) && $request['model'] != null ){

                 $all_products = Product::with('product_name')->with('make')->with('model')->where('product_name_id', $request['product_id'] )->where('make_id', $request['make'])->where('model_id', $request['model'])->get();

                    }
              }
        }
        else{
            $all_products = Product::with('product_name')->with('make')->with('model')->get();
        }

        return $all_products;
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
        	'product_name_id' => 'required',
        	'make_id' => 'required',
        	'model_id' => 'required',
        	'quantity' => 'required',
        	'cost' => 'required'
        ]);

        // check if similar product exist in db

        $product_check = Product::where('product_name_id', (int) $request['product_name_id'])->where('make_id', (int) $request['make_id'])->where('model_id', (int) $request['model_id'])->get();

        if( count($product_check) > 0){ // if yes

        return redirect()->back()->with('error-message', 'Product Already Exist Update Stock ! ');

        }else{

        $table = new Product();

        $table->product_name_id = $request['product_name_id'];
        $table->make_id = $request['make_id'];
        $table->model_id = $request['model_id'];
        $table->quantity = $request['quantity'];
        $table->cost = $request['cost'];
        $table->grn = $request['grn'];
        $table->additional_info = $request['additional_info'];
        $table->save();

        }

        return redirect()->back()->with('success', 'Product Added Successfully ! ');

    }

    /**

     * Display the specified product for stock Update
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_stock($id)
    {
        $product = Product::findOrFail($id);
        
        return view('products.edit_stock', compact('product'));
    }

    /**

     *  Update Product Stock
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_stock(Request $request, $id)
    {

        $this->validate($request, [
            'quantity' => 'required'
        ]);

        $stock = Product::findOrFail($id);

        $stock->quantity += (int) $request['quantity']; 
        $stock->save();
        
        return redirect()->route('product.index')->with('success', 'Product Stock Updated Successfully ! ');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
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
        $this->validate($request, [
        	'quantity' => 'required',
        	'cost' => 'required'
        ]);

        $table = Product::find($id);

        $table->quantity = $request['quantity'];
        $table->cost = $request['cost'];
        $table->grn = $request['grn'];
        $table->additional_info = $request['additional_info'];
        $table->save();

        return redirect()->route('product.index')->with('success', 'Product Updated Successfully ! ');
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
            Product::find($id)->delete();

            return redirect()->back()->with('success', 'Product deleted succesfully !!');
        }catch(\Illuminate\Database\QueryException $e){

            return redirect()->back()->with('error-message', ' Unable to Complete Transaction !!');
            
        }

    }
    
}
