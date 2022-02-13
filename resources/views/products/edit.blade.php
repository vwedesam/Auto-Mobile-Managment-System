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
                    <div class="box-content" >
                    	{!! Form::model($product, [ 
                            'method' => 'PUT', 
                            'route' => ['product.update', $product->id ] 
                        ]) !!}
                        <div class="form-class">
                            <label for="product_name_id">  Product category </label>
                            <input type="text" value="{{ $product->product_name->name }}" name="quantity" class="span8" disabled="true" >
                        </div>
                        <div class="form-class">
                            <label for="make_id">  Make </label>
                            <input type="text" value="{{ $product->make->name }}" name="quantity" class="span8" disabled="true" >
                        </div>
                        <div class="form-class">
                            <label for="model_id">  Model </label>
                            <input type="text" value="{{ $product->model->name }}" name="quantity" class="span8" disabled="true" >
                        </div>
                        @if( Auth::User()->hasRole('admin') )
                        <div class="form-class">
                            <label for="quantity">  Available Quantity/Stock </label>
                            <input type="number" min="1" value="{{ $product->quantity }}" name="quantity" class="span8" placeholder="Enter Available Quantity" required >
                        </div>
                        @else
                        <div class="form-class">
                            <label for="quantity">  Available Quantity/Stock </label>
                            <input type="number" value="{{ $product->quantity }}" disabled="true" class="span8"  >
                            <input type="hidden" min="1" value="{{ $product->quantity }}" name="quantity"  >
                        </div>
                        @endif
                        <div class="form-class">
                            <label for="cost">  cost </label>
                            <input type="number" min="1" value="{{ $product->cost }}" name="cost" class="span8" placeholder="Enter Product Cost ..." required >
                        </div>
                        <div class="form-class">
                            <label for="grn">  GRN </label>
                            <input type="text" value="{{ $product->grn }}" name="grn" class="span8" placeholder="Enter GRN ...">
                        </div>
                        <div class="input-prepend">
                            <input type="hidden" value="{{ $product->additional_info }}" name="additional_info" class="span4" placeholder="Enter Additional Information ...">
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





