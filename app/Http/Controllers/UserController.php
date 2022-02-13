<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UserController extends Controller
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
        $this->middleware('user_permission')->except('update_login');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    	$user = new User();

    	$editable = false;

        return view('users.index', compact('user', 'editable'));
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
        $this->validate($request, [
    		'first_name' => 'required',
    		'last_name' => 'required',
    		'status' => 'required',
    		'email' => 'required',
    		'phone' => 'required',
    		'password' => 'required'
    	]);

        $role = $request['role'];

        if( $role == null ){
            $role = 3;
        }

        //dd($role);

        $table = new User();

        $table->first_name = $request['first_name'];
        $table->last_name = $request['last_name'];
        $table->status = $request['status'];
        $table->password = Hash::make($request['password']);
        $table->email = $request['email'];
        $table->phone = $request['phone'];
        $table->save();


        $table->attachRole($role);

        return redirect()->route('user.index')->with('success', 'New User has Just been Created');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $editable = true;

        return view('users.index', compact('user', 'editable'));
    }

    /**
     * Update user login Details
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_login(Request $request)
    {
         $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
         //dd($request->user()->id);
       
        $table = User::find($request->user()->id);

        $table->password = Hash::make($request['password']);
        $table->email = $request['email'];
    
        $table->save();

        return redirect()->back();
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
    		'first_name' => 'required',
    		'last_name' => 'required',
    		'email' => 'required',
    		'phone' => 'required',
    	]);

        $table = User::find($id);

        $table->first_name = $request['first_name'];
        $table->last_name = $request['last_name'];
        if( $id != 1 ){
        	$table->status = $request['status'];	
        }
        if( $request['password'] != "" ) {
        	$table->password = Hash::make($request['password']);
        }
        $table->email = $request['email'];
        $table->phone = $request['phone'];
        $table->save();

        if( $id != 1 && $request['role'] != null ){
        	$table->detachRole($table['role']);
            $table->attachRole($request['role']);	
        }
        

        return redirect()->route('user.index')->with('success', 'User Record has Just been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( $id == 1  ){
        	return redirect()->back();
        }else{


             // return DB::transaction(function() use ($id) {

             //    User::find($id)->delete();

             //    return redirect()->back()->with('error-message', ' Unable to Complete Transaction !!');

             // });


            // try{

            //     User::find($id)->delete();

            //     return redirect()->back()->with('success', 'User has been deleted');

            // }catch(\Illuminate\Database\QueryException $e){

            //     return redirect()->route('dashboard')->with('error-message', ' Unable to Complete Transaction !!');
            // }

            return redirect()->back()->with('error-message', ' Unable to Complete Transaction !!');

        }
    }
}
