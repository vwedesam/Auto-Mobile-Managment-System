<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DealerInformation;

class DealerInfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user_status')->except('store');
        $this->middleware('user_permission')->except('store');
    }
    
     //**
     /* Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

          $dealer_info = DealerInformation::get()->first();

          

          return view('options.dealer_info', compact('dealer_info'));
          
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
            'app_name' => 'required',
            'dealer_name' => 'required',
            'address' => 'required',
            'state' => 'required',
            'country' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        $table = new DealerInformation();

        $table->app_name = $request['app_name'];
        $table->dealer_name = $request['dealer_name'];
        $table->address = $request['address'];
        $table->state = $request['state'];
        $table->country = $request['country'];
        $table->email = $request['email'];
        $table->phone = $request['phone'];
        $table->save();

        return redirect()->route('dashboard');  
       
        
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
    		'd_name' => 'required',
    		'd_address' => 'required',
    		'd_state' => 'required',
    		'd_country' => 'required',
    		'd_email' => 'required',
    		'd_phone' => 'required'
    	]);

        $table = DealerInformation::find(1);

        $table->dealer_name = $request['d_name'];
        $table->address = $request['d_address'];
        $table->state = $request['d_state'];
        $table->country = $request['d_country'];
        $table->email = $request['d_email'];
        $table->phone = $request['d_phone'];
        $table->save();

        return redirect()->route('dealer_info.index')->with('success', 'Company Info updated');
    }


}
