<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesInvoice;
use App\ProductSalesInvoice;
use App\Product;
use App\ProductName;
use App\DealerInformation;
use App\Miscellaneous;
use App\Miscellaneous_sales;


class SummaryController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

        $end_date = date('Y-m-d');

        if( $request->get('fromDate') !== null ){

            $start_date = date('Y-m-d', strtotime($request->get('fromDate')));
            $end_date = $start_date;

            $summaries = SalesInvoice::with('product_sales_invoice')->where('created_at', 'like', "%".$start_date."%")->get();

            if( $request->get('toDate') !== null ){

            $start_date = date('Y-m-d', strtotime($request->get('fromDate')));

            $end_date = date('Y-m-d', strtotime($request->get('toDate')));

            $summaries = SalesInvoice::with('product_sales_invoice')->where('created_at', '>=', $start_date)->where('created_at', '<=', date('Y-m-d', strtotime($end_date.'+1 day')))->orderBy('created_at')->get();

            }


        }else{

            $start_date = date('Y-m-d'); 

            $summaries = SalesInvoice::where('created_at', 'like', '%'.$start_date.'%')->get();

        }

        $products = ProductName::all();

        return view('summary.index', compact('summaries', 'products', 'start_date', 'end_date'));
    }

    /**
     * Print Sales Invoice and Security Permit
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function print($from_date, $to_date)
    {

       if( $from_date !== null ){

            $start_date = date('Y-m-d', strtotime($from_date));

            $summaries = SalesInvoice::with('product_sales_invoice')->where('created_at', 'like', "%".$start_date."%")->get();

            if( $to_date !== null ){

            $start_date = date('Y-m-d', strtotime($from_date));

            $end_date = date('Y-m-d', strtotime($to_date));

            $summaries = SalesInvoice::with('product_sales_invoice')->where('created_at', '>=', $start_date)->where('created_at', '<=', date('Y-m-d', strtotime($end_date.'+1 day')))->orderBy('created_at')->get();

            }
        }

        $products = ProductName::all();

        $company_info = DealerInformation::get()->first();

        return view('summary.print', compact('summaries', 'products', 'start_date', 'company_info', 'end_date'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

         $summaries = SalesInvoice::where('created_at', 'like', '%'.date('y-m-d').'%')->get();

        $products = ProductName::all();

        return view('summary.index', compact('summaries', 'products'));
    }


}
