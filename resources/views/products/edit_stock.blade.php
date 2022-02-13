@extends('layouts.main')

@section('style')

@endsection

@section('content')

        <div class="row">
            <div class="span9">
                <div class="box">
                    <div class="box-header">
                        <i class="icon-book"></i>
                        <h5> Edit Stock </h5>
                    </div>
                    <div class="box-content">
                        <br>
                    	{!! Form::model($product, [ 
                            'method' => 'POST', 
                            'route' => ['product.stock_update', $product->id ] 
                        ]) !!}
                        
                        <div class="form-group">
                            <label for=""> Available Stock </i></label>
                            <input type="number" disabled="true" value="{{ $product->quantity }}" class="span8" >
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="quantity"> Stock you Want to Add </i></label>
                            <input type="number" value="" name="quantity" class="span8" placeholder="Add to Stock" min="1" required >
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">
                        <i class="icon-plus"></i> Update Stock
                        </button> 
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            
        </div>

@endsection





