<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesInvoice;
use App\ProductSalesInvoice;
use App\Product;
use App\Miscellaneous;
use App\Miscellaneous_sales;
use App\DealerInformation;
use Cart;


class InvoiceController extends Controller
{
    //
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('invoice.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {
        
        if( isset($request['customer_id']) && $request['customer_id'] != null  ) {

            $invoice = SalesInvoice::with('customer', 'user', 'product_sales_invoice', 'miscellaneous_sales')->where('customer_id', $request['customer_id'])->orderBy('created_at', 'desc')->get();
        }
        else if( isset($request['from_date']) &&  $request['from_date'] != null ) {

            $invoice = SalesInvoice::with('customer', 'user', 'product_sales_invoice', 'miscellaneous_sales')->where('created_at', 'like', '%'.$request['from_date'].'%')->orderBy('created_at', 'desc')->get();

        }else{

           $invoice = SalesInvoice::with('customer', 'user', 'product_sales_invoice', 'miscellaneous_sales')->where('created_at', 'like', '%'.date('y-m-d').'%')->orderBy('created_at', 'desc')->get();  
        }

       return $invoice; 
    }

    /**
     * Print Sales Invoice and Security Permit
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $dealer = DealerInformation::get()->first();

        $product_invoice = ProductSalesInvoice::where('sales_invoice_id', $id)->get();

        $miscellaneous_invoice = Miscellaneous_sales::where('sales_invoice_id', $id)->get();

        $customer = SalesInvoice::find($id);

        return view('invoice.print', compact('dealer', 'product_invoice', 'miscellaneous_invoice', 'customer'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $product_invoice = ProductSalesInvoice::where('sales_invoice_id', $id)->get();

        $miscellaneous_invoice = Miscellaneous_sales::where('sales_invoice_id', $id)->get();
       

        $customer = SalesInvoice::find($id);

        return view('invoice.view', compact('product_invoice', 'miscellaneous_invoice', 'customer', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // add product to Sales Invoice

        $uniqid = 1001;

        $last_invoice = SalesInvoice::latest()->first();
        if( $last_invoice != null  ){
            $uniqid = $uniqid + $last_invoice->id;
        }

        $invioce_type = 'invioce';

        if( $request['invoice_status'] == 'transfer' ){
            $invioce_type = $request['invoice_status'];
        }

        $invoice = new SalesInvoice();

    	$invoice->invoice_ID = $uniqid;
    	$invoice->user_id = $request->user()->id;
    	$invoice->customer_id = $request['customer_id'];
    	$invoice->invoice_total = $request['invoice_total'];
        $invoice->status = $request['invoice_status'];
    	$invoice->save();

        foreach( Cart::instance($invioce_type)->content() as $cartItem ){

            if( $cartItem->name == 'product_name' ) 
            {
                // update Product Quantity
                $product = Product::findOrFail($cartItem->id);
                $product->quantity -= $cartItem->qty;
                $product->save();

                // add product to Product Sales Invoice
            	$product_invoice = new ProductSalesInvoice();

            	$product_invoice->sales_invoice_id = $invoice->id;
            	$product_invoice->product_id = $cartItem->id;
            	$product_invoice->rate_per_product = $cartItem->options->cost_per_product;
            	$product_invoice->qty_ordered = $cartItem->qty;
                $product_invoice->total = $cartItem->options->product_total;

            	$product_invoice->save();
            }
            else
            {
                // update Miscellaneous Quantity
                $misc = Miscellaneous::findOrFail($cartItem->id);
                $misc->quantity -= $cartItem->qty;
                $misc->save();

                // add to Miscellaneous
                $miscellaneous = new Miscellaneous_sales();

                $miscellaneous->sales_invoice_id = $invoice->id;
                $miscellaneous->misc_id = $cartItem->id;
                $miscellaneous->rate = $cartItem->options->cost_per_product;
                $miscellaneous->qty_ordered = $cartItem->qty;
                $miscellaneous->total = $cartItem->options->product_total;

                $miscellaneous->save();
            }

        }

        Cart::instance($invioce_type)->destroy();

        return redirect()->route('invoice.print', $invoice->id);
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
        //
    }

}
