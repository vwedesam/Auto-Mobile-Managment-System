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
                            'method' => 'POST', 
                            'route' => ['miscellaneous.stock_update', $miscellaneous->id ] 
                        ]) !!}
                       
                        <div class="form-group">
                           <label for="quantity"> Availbale  Quantity/Stock </label>
                           <input type="number" value="{{ $miscellaneous->quantity }}" required disabled="true" min="1" class="span8" /> 
                        </div>
                        <div class="form-group">
                           <label for="quantity"> Stock you Want to Add </label>
                           <input type="number" name="quantity" required placeholder="Add To Stock " min="1" class="span8" /> 
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





