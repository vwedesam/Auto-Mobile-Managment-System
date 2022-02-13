<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
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
        $this->middleware('user_permission');

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = new Customer();
        
         $editable = false;

        return view('customers.index', compact('customer', 'editable'));
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
            'email' => 'required',
            'full_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required'
        ]);

        $customer = new Customer();

        $uniqid = 1001;

        $last_customer = Customer::latest()->first();
        if( $last_customer != null ){
            $uniqid = $uniqid + $last_customer->id;
        }

        $customer->customer_ID = $uniqid;
        $customer->email = $request->email;
        $customer->name = $request->full_name;
        $customer->address = $request->address;
        $customer->phone = $request->phone_number;

        $customer->save();

        return redirect()->back()->with('success', 'New Customer has Just been Added !!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id); 

        $editable = true;

        return view('customers.index', compact('customer', 'editable'));
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
            'email' => 'required',
            'full_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required'
        ]);

        $customer = Customer::find($id);

        $customer->email = $request->email;
        $customer->name = $request->full_name;
        $customer->address = $request->address;
        $customer->phone = $request->phone_number;

        $customer->save();

        return redirect()->route('customer.index')->with('success', 'Customer Record Updated !!');
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
            Customer::find($id)->delete();

            return redirect()->back()->with('success', 'Make record deleted');
        }catch(\Illuminate\Database\QueryException $e){

            return redirect()->back()->with('error-message', 'Transaction Failed !!');

        }
    }



}
