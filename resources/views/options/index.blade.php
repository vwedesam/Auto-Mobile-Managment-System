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
                                    <?php $name = 'class="active"';
                                          $make = $model = $d_info = '';
                                    ?>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <!-- Nav tabs -->
                                        @include('inc/options_nav')
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="product">

                                                <div class="row"> <!-- row -->
                                                 <div class="span5">
                                                    <?php
                                                    if($editable) {
                                                        $method = 'PUT';
                                                        $act = 'Update';
                                                        $action = 'product_name.update';
                                                        $btn = 'Update'; 
                                                    }
                                                    else {
                                                        $method = 'POST';
                                                        $act = 'Add';
                                                        $action = 'product_name.store';
                                                        $btn = 'Submit';
                                                    }
                                                    ?>
                                                    <h4> {{ $act }} Category </h4>
                                                    {!! Form::model($product_name, [
                                                            'method' => $method,
                                                            'route' => [$action, $product_name->id]
                                                        ]) !!} <!-- Make Form -->
                                                        
                                                    <div class="input-prepend">
                                                        <span class="add-on"> <i class="icon-envel">Product </i></span>
                                                        {!! Form::text('name', $product_name->name, [ "class" => "span4", "placeholder" => "Enter product Category ...", "required" => "true"]) !!}
                                                    </div>
                                                    <br>
                                                      <button type="submit" class="btn btn-primary">
                                                      <i class="icon-ok"></i> {{ $btn }} </button>
                                                    </form>
                                                 </div>
                                                 <div class="span10">
                                                    @include('inc.msg')
                                                <table class="table table-hover tablesorter table-bordered">
                                                    <thead>
                                                        <tr style="background:#ddd;"> <th> All Product  </th> <th> </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if( count($products_name) > 0 ) 
                                                        @foreach( $products_name as $product_name )
                                                        <tr> 
                                                            <td> {{ $product_name->name }} </td>
                                                            <td>
                                                                <a href="{{ route('product_name.edit', $product_name->id ) }}" class="btn btn-small btn-info">
                                                                <i class="btn-icon-only icon-edit"></i> </a>
                                                                {!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;', 'route' => ['product_name.destroy', $product_name->id]] ) !!}
                                                                <button type="submit" onclick=" return confirm('this Action cannot be undone Are you Sure ?')"  class="btn btn-small btn-danger">
                                                                <i class="btn-icon-only icon-remove"></i></button>
                                                                {!! Form::close() !!}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @else
                                                        <div class="alert alert-danger alert-dismissible">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                            <strong> No Product Name Found !! </strong>
                                                        </div>
                                                    @endif
                                                    </tbody>
                                                </table>
                                                {{ $products_name->links() }}
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


