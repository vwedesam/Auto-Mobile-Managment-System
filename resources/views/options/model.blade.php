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
                                    <?php $model = 'class="active"';
                                          $make = $name = $d_info = '';
                                    ?>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <!-- Nav tabs -->
                                        @include('inc/options_nav')
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            
                                            <div class="tab-pane fade in active" id="model">
                                                <div class="row"> <!-- row -->
                                                 <div class="span5">
                                                    <?php
                                                    if($editable) {
                                                        $method = 'PUT';
                                                        $act = 'Update';
                                                        $action = 'product_model.update';
                                                        $btn = 'Update'; 
                                                    }
                                                    else {
                                                        $method = 'POST';
                                                        $act = 'Add';
                                                        $action = 'product_model.store';
                                                        $btn = 'Submit';
                                                    }
                                                    ?>
                                                    <h4> {{ $act }}  Model </h4>
                                                    {!! Form::model($product_model, [
                                                            'method' => $method,
                                                            'route' => [$action, $product_model->id]
                                                        ]) !!} <!-- Make Form -->
                                                        
                                                    <div class="input-prepend">
                                                        <span class="add-on"> <i class="icon-envel"> Make</i></span>
                                                       {!! Form::text('name', $product_model->name, [ "class" => "span4", "placeholder" => "Enter Model ...", "required" => "true"]) !!}
                                                    </div>
                                                    <br>
                                                    <div class="input-prepend">
                                                        <span class="add-on"> <i class="icon-envel"> Make </i></span>
                                                        {!! Form::select('make_id', App\ProductMake::pluck('name', 'id'), $product_model->make_id, ['placeholder' => 'Select Make', 'required' => 'true']) !!}
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
                                                        <tr style="background:#ddd;"> <th> Make </th> 
                                                            <th> Model </th> <th> </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if( count($products_model) > 0 ) 
                                                        @foreach( $products_model as $product_model )
                                                        <tr> 
                                                            <td> {{ $product_model->make->name }} </td>
                                                            <td> {{ $product_model->name }} </td>
                                                            <td>
                                                                <a href="{{ route('product_model.edit', $product_model->id ) }}" class="btn btn-small btn-info">
                                                                <i class="btn-icon-only icon-edit"></i> </a>
                                                                {!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;', 'route' => ['product_model.destroy', $product_model->id]] ) !!}
                                                                <button type="submit" onclick=" return confirm('this Action cannot be undone Are you Sure ?')"  class="btn btn-small btn-danger">
                                                                <i class="btn-icon-only icon-remove"></i></button>
                                                                {!! Form::close() !!}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @else
                                                     <div class="alert alert-danger alert-dismissible">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                            <strong> No Product Model Found !! </strong>
                                                        </div>
                                                    @endif
                                                    </tbody>
                                                </table>
                                                {{ $products_model->links() }}
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


