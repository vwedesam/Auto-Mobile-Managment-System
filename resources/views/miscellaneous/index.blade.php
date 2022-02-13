@extends('layouts.main')

@section('style')

@endsection

@section('content')

        <div class="row">
            <div class="span16">
                <div class="box">
                    <div class="box-header">
                        <i class="icon-book"></i>
                        <h5> All Products  </h5>
                    </div>
                    <div class="box-content">
                        <div class="panel tabbed-panel panel-default">
                            <div class="panel panel-default">
                                <?php $products = '';
                                      $miscellaneous = 'class="active"';
                                ?>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                    <li <?php echo $products; ?>  ><a href="{{ route('product.index') }}" >Products </a>
                                    </li>
                                    <li <?php echo $miscellaneous; ?>  ><a href="{{ route('miscellaneous.index') }}"> Miscellaneous </a>
                                    </li>
                                </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="product">
                                                @include('inc.msg')
                                                <div> 
                                                @if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager') )
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addNewMisc">
                                                        Add New Msicellaneous ++
                                                    </button>
                                                @endif
                                                </div>
                                                <br>
                                                <div style="text-align: center;">
                                                    <div class="input-prepend">
                                                        <span class="add-on"> <i class="icon-envel"> Search </i></span>
                                                        <input type="text" name="search_misc"
                                                        id="searchMisc" placeholder="enter search here ...">
                                                    </div>
                                                </div>
                                                <br>
                                            <table class="table table-hover tablesorter table-bordered">
                                                <thead>
                                                    <tr style="background:#eee;"> 
                                                    <th> # </th> <th> Name  </th> 
                                                    <th> Make <br> </th>
                                                    <th> Model/Description </th> <th> Available Qty </th>
                                                    <th> Price </th> <th>actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="miscTable">
                                                    
                                                
                                                </tbody>
                                            </table>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                        </div>

                    </div>
                </div> <!-- box end -->
            </div> <!-- span end -->
            
        </div> <!-- row end -->

        <!-- Modal For Miscellaneous -->
        <div class="modal fade" id="addNewMisc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel"> Miscellaneous </h4>
                    </div>
                    <div class="modal-body">
                     {!! Form::open([ 'method' => 'POST', 'route' => ['miscellaneous.store'] ]) !!}
                     <style type="text/css">
                         .mis_form input[type="text"], .mis_form input[type="number"] {
                            width: 100%;
                         }
                     </style>
                    <div class="mis_form" style="margin:0 auto;width:300px;"> 
                        <div> 
                           <p> <strong> Product Name: </strong> </p>
                           <input type="text" name="name" value="" required placeholder="Name ..."  >
                        </div>
                        <div>
                           <p> <strong> Make: </strong> </p>
                           <input type="text" name="make" value="" required placeholder="Make ..."  >
                        </div>
                         <div>
                           <p> <strong> Model/Description: </strong> </p>
                           <input type="text" name="description" value="" required placeholder="Model / Description ..."  >
                        </div>
                        <div>
                           <p> <strong> Price: </strong> </p>
                           <input type="number" min="1" name="price" value="" required placeholder=" Price .. " >
                        </div>
                        <div>
                           <p> <strong> Quantity </strong> </p>
                           <input type="number" min="1" name="quantity" value="" required placeholder=" Quantity .. " /> 
                        </div>
                        
                    </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> Submit </button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

@endsection

@section('script')

        <script src="{{ asset('js/easyhttp3.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('js/fetchMiscellaneous.js') }}" type="text/javascript" ></script>
        <script type="text/javascript">


    // (function() {

        const data = {
            '_token': "{!! csrf_token() !!}"
        };

        const userRole = "{{ Request()->user()->roles()->first()->name }}";

        const searchMisc = document.querySelector('#searchMisc');

        searchMisc.addEventListener('keyup', function(e){

        data.search = e.target.value;

        fetchMiscellaneous(data, userRole);

        })

        fetchMiscellaneous(data, userRole);

       </script>

@endsection


