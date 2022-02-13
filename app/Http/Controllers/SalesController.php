<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Product;
use App\Customer;

class SalesController extends Controller
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
    }
    
    /**
     * add item to cart
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        //dd($request);

        $product_total = (int) $request->product_cost * (int)$request->quantity ;

        $options = [ 
            'cost_per_product' => $request->product_cost,
            'status' => "",
            'product_total' => $product_total,
            ];

        if( isset($request->type) ){

            //check if item exist in Cart
            $product_in_cart = Cart::instance('invioce')->search( function($cartItem, $rowId) use ($request) {
                return $cartItem->id == $request->product_id && $cartItem->name == "Miscellaneous" ;
            });

            if( $product_in_cart->isNotEmpty() ) {

                return redirect()->route('sales.index')->with('error-message', 'Miscellaneous allready Added to Invoice. <br> Romove to Update Quantity !');
            }

            $cart = Cart::instance('invioce')->add($request->product_id, 'Miscellaneous', $request->quantity, 0.0, $options)
                       ->associate('App\Miscellaneous');
        }
        else {

            //check if item exist in Cart
            $product_in_cart = Cart::instance('invioce')->search( function($cartItem, $rowId) use ($request) {
                return $cartItem->id == $request->product_id && $cartItem->name == "product_name" ;
            });

            if( $product_in_cart->isNotEmpty() ) {

                return redirect()->route('sales.index')->with('error-message', 'Product allready Added to Invoice. <br> Romove to Update Quantity !');
            }

            $cart = Cart::instance('invioce')->add($request->product_id, 'product_name', $request->quantity, 0.0, $options)
                       ->associate('App\Product');

        }

        return redirect()->route('sales.index');
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function empty()
    {
        Cart::instance('invioce')->destroy();

        return redirect()->route('sales.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display All Cart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $customer = Customer::find(session('customer_id'));

        return view('sales.index', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Cart::instance('invioce')->remove($id);

        return redirect()->back();
    }

    /** Old Cart Script
    /**
     * add item to cart
     *
     * @return \Illuminate\Http\Response
     */
/*    public function add(Request $request)
    {

        $product_total = (int) $request->product_cost * (int)$request->quantity ;

        $options = [ 
            'cost_per_product' => $request->product_cost,
            'additional_info' => $request->additional_info,
            'customer_id' => $request->customer_id,
            'product_total' => $product_total,
            ];

            if( session()->has('customer_id') ) {

            }else{
                session(['customer_id' => $request->customer_id]);
            }
        
        if( count(Cart::content()) > 0 ) {
            //check if Customer exist in Cart
            $customer_in_cart = Cart::search( function($cartItem, $rowId) use ($request) {
                return $cartItem->options->customer_id == $request->customer_id;
            });

            if( $customer_in_cart->isEmpty() ) {

                return redirect()->route('cart.index')->with('error-message', 'Wrong Customer Selected !');
            }  

        }    
        

        //check if item exist in Cart
        $product_in_cart = Cart::search( function($cartItem, $rowId) use ($request) {
            return $cartItem->id == $request->product_id;
        });

        if( $product_in_cart->isNotEmpty() ) {

            return redirect()->route('cart.index')->with('error-message', 'Product allready Added to Cart !');
        }

        $cart = Cart::add($request->product_id, 'product_name', $request->quantity, 0.0, $options)
                   ->associate('App\Product');

        return redirect()->route('cart.index');
    }
 */



}

