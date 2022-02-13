<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Miscellaneous;

class MiscellaneousController extends Controller
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
        //
        return view('miscellaneous.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    	$this->validate($request, [
        	'name' => 'required',
        	'make' => 'required',
        	'description' => 'required',
        	'quantity' => 'required',
        	'price' => 'required'
        ]);

        $misc = new Miscellaneous();

        $misc->name = $request['name'];
        $misc->make = $request['make'];
        $misc->description = $request['description'];
        $misc->price = $request['price'];
        $misc->quantity = $request['quantity'];

        $misc->save();

        return redirect()->back()->with('success', 'Miscellaneous Added Successfully ! ');

    }

     /**

     * Display the specified product for stock Update
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_stock($id)
    {
        $miscellaneous = Miscellaneous::findOrFail($id);
        
        return view('miscellaneous.edit_stock', compact('miscellaneous'));
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

        $stock = Miscellaneous::findOrFail($id);

        $stock->quantity += (int) $request['quantity']; 
        $stock->save();
        
        return redirect()->route('miscellaneous.index')->with('success', 'Miscellaneous Stock Updated Successfully ! ');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {
        
        if( isset($request['search']) && $request['search'] != null  ) {

            $miscellaneous = Miscellaneous::where('name', 'like', '%'.$request['search'].'%')->orWhere('make', 'like', '%'.$request['search'].'%')->orWhere('description', 'like', '%'.$request['search'].'%')->orderBy('created_at', 'desc')->get();
        }else{

        	$miscellaneous = Miscellaneous::orderBy('created_at', 'desc')->get();
        }  

        return $miscellaneous; 
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $miscellaneous = Miscellaneous::findOrFail($id);

        return view('miscellaneous.edit', compact('miscellaneous'));
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
        $this->validate($request, [
            'name' => 'required',
            'make' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ]);

        $table = Miscellaneous::find($id);

        $table->name = $request['name'];
        $table->make = $request['make'];
        $table->description = $request['description'];
        $table->quantity = $request['quantity'];
        $table->price = $request['price'];
        $table->save();

        return redirect()->route('miscellaneous.index')->with('success', 'Miscellaneous Updated Successfully ! ');
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
        try{
            Miscellaneous::find($id)->delete();

            return redirect()->back()->with('success', 'User has been deleted');

        }catch(\Illuminate\Database\QueryException $e){
                
            return redirect()->back()->with('error-message', ' Unable to Complete Transaction !!');
        }
    }

}
