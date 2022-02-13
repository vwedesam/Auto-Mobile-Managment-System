@extends('layouts.main')

@section('style')

@endsection

@section('content')

        <div class="row">
            <div class="span16">
                <div class="box">
                    <div class="box-header">
                        <i class="icon-book"></i>
                        <h5> All Options and Settings  </h5>
                    </div>
                    <div class="box-content">
                         <div class="row"> <!-- row -->
                            <div class="span16">
                        	<div class="panel tabbed-panel panel-default">
                                <div class="panel panel-default">
                                    <?php $make = 'class="active"';
                                          $name = $model = $d_info = '';
                                    ?>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <!-- Nav tabs -->
                                        @include('inc/options_nav')
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="make">

                                                <div class="row"> <!-- row -->
                                                 <div class="span5">
                                                    
                                                     <?php
                                                    if($editable) {
                                                        $method = 'PUT';
                                                        $act = 'Update';
                                                        $action = 'product_make.update';
                                                        $btn = 'Update'; 
                                                    }
                                                    else {
                                                        $method = 'POST';
                                                        $act = 'Add';
                                                        $action = 'product_make.store';
                                                        $btn = 'Submit';
                                                    }
                                                    ?>
                                                    <h4> {{ $act }}  Make/Manufacturer </h4>
                                                    {!! Form::model($product_make, [
                                                            'method' => $method,
                                                            'route' => [$action, $product_make->id]
                                                        ]) !!} <!-- Make Form -->
                                                        
                                                    <div class="input-prepend">
                                                        <span class="add-on"> <i class="icon-envel"> Make</i></span>
                                                       {!! Form::text('name', $product_make->name, [ "class" => "span4", "placeholder" => "Enter Make ...", "required" => "true"]) !!}
                                                    </div>
                                                    <br>
                                                    <div class="input-prepend">
                                                        <span class="add-on"> <i class="icon-envel"> Product Category</i></span>
                                                        {!! Form::select('product_id', App\ProductName::pluck('name', 'id'), $product_make->product_id, ['placeholder' => 'Select Product Category', 'required' => 'true']) !!}
                                                    </div>
                                                    <br>
                                                      <button type="submit" class="btn btn-primary">
                                                      <i class="icon-ok"></i>{{ $btn }}</button>
                                                    </form>
                                                 </div>
                                                 <div class="span10">
                                                    @include('inc.msg')
                                                <table class="table table-hover tablesorter table-bordered">
                                                    <thead>
                                                        <tr style="background:#ddd;"> <th> Product </th> 
                                                            <th> Make </th> <th> </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if( count($products_make) > 0 ) 
                                                        @foreach( $products_make as $product_make )
                                                        <tr> 
                                                            <td> {{ $product_make->product->name }} </td>
                                                            <td> {{ $product_make->name }} </td>
                                                            <td>
                                                                <a href="{{ route('product_make.edit', $product_make->id ) }}" class="btn btn-small btn-info">
                                                                <i class="btn-icon-only icon-edit"></i> </a>
                                                                {!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;', 'route' => ['product_make.destroy', $product_make->id]] ) !!}
                                                                <button type="submit" onclick=" return confirm('this Action cannot be undone Are you Sure ?')"  class="btn btn-small btn-danger">
                                                                <i class="btn-icon-only icon-remove"></i></button>
                                                                {!! Form::close() !!}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @else
                                                     <div class="alert alert-danger alert-dismissible">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                            <strong> No Product Make Found !! </strong>
                                                        </div>
                                                    @endif
                                                    </tbody>
                                                </table>
                                                {{ $products_make->links() }}
                                               </div>
                                              </div><!-- row end -->
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <!-- /.panel-body -->
                            </div>
                        </div>

                            </div>
                        </div> <!-- row end -->
                    </div>
                </div> <!-- box end -->
            </div> <!-- span end -->
            
        </div> <!-- row end -->

@endsection


