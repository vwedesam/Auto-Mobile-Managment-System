<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesInvoice;
use App\ProductSalesInvoice;
use App\DealerInformation;
use App\ProductMake;
use App\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('app_setup');
        $this->middleware('user_status')->except('app_setup');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dealer_info = DealerInformation::all();

        if( count($dealer_info) <= 0 ) {
            return redirect()->route('app_setup');
        }

        $sales = ProductSalesInvoice::orderBy('created_at', 'desc')->paginate(5);

        $brands = ProductMake::all();
        //$sales = SalesInvoice::all();

        $customer = count(Customer::all());


        return view('dashboard', compact('sales', 'brands', 'customer'));
    }

    /**
     * Set up for This application
     *
     * @return \Illuminate\Http\Response
     */
    public function app_setup()
    {
        return view('setup.index');
    }

}
