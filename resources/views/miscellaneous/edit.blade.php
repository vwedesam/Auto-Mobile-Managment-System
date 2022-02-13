@extends('layouts.main')

@section('style')

@endsection

@section('content')

        <div class="row">
            <div class="span9">
                <div class="box">
                    <div class="box-header">
                        <i class="icon-book"></i>
                        <h5> Edit Product </h5>
                    </div>
                    <div class="box-content">
                        <br>
                    	{!! Form::model($miscellaneous, [ 
                            'method' => 'PUT', 
                            'route' => ['miscellaneous.update', $miscellaneous->id ] 
                        ]) !!}

                        <div class="form-group"> 
                           <p> <strong> Product Name: </strong> </p>
                           <input type="text" name="name" value="{{ $miscellaneous->name }}" required placeholder="Name ..."  class="span8" >
                        </div>
                        <div class="form-group">
                           <p> <strong> Make: </strong> </p>
                           <input type="text" name="make" value="{{ $miscellaneous->make }}" required placeholder="Make ..."  class="span8" >
                        </div>
                         <div class="form-group">
                           <p> <strong> Model/Description: </strong> </p>
                           <input type="text" name="description" value="{{ $miscellaneous->description }}" required placeholder="Model / Description ..." class="span8"  >
                        </div>
                        <div class="form-group">
                           <p> <strong> Price: </strong> </p>
                           <input type="number" min="1" name="price" value="{{ $miscellaneous->price }}" required placeholder=" Price .. "  class="span8">
                        </div>
                        <div class="form-group">
                           <p> <strong> Quantity/Stock </strong> </p>
                           <input type="number" min="1" name="quantity" value="{{ $miscellaneous->quantity }}" required placeholder=" Quantity .. " class="span8" /> 
                        </div>
                        
                    </div>
                        

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">
                        <i class="icon-ok"></i> Update
                        </button> 
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            
        </div>

@endsection



