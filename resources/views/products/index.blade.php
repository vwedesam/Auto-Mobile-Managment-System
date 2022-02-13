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
                                <?php $products = 'class="active"';
                                      $miscellaneous = '';
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
                                                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addNewProduct">
                                                        Add New product ++
                                                    </button>
                                                @endif
                                                </div>
                                                <br>
                                                <div style="text-align: center;">
                                                    <div class="input-prepend">
                                                        <span class="add-on"> <i class="icon-envel"> Product </i></span>
                                                        {!! Form::select('product_id', App\ProductName::pluck('name', 'id'), Request::get('product_name') ? Request::get('product_name') : null , ['placeholder' => 'Select Product', 'id' => 'productId' ]) !!}
                                                        <span class="add-on"> <i class="icon-envel"> Make </i></span>
                                                        <select name="make" id="makeId" >
                                                          <option value=""> Select Make ... </option>
                                                        </select>
                                                        <span class="add-on"> <i class="icon-envel"> Model </i></span>
                                                        <select name="model" id="modelId" >
                                                          <option value=""> Select Model ... </option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <br>
                                            <table class="table table-hover tablesorter table-bordered">
                                                <thead>
                                                    <tr style="background:#eee;"> 
                                                    <th> # </th> <th> Product Category  </th> 
                                                    <th> Make/Manufacturer <br> </th>
                                                    <th> Model </th> <th> Available Qty/Stock </th>
                                                    <th> Price </th> <th>actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="productTable">
                                                    
                                                
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

        @include('products.add_product')

@endsection

@section('script')

        <script src="{{ asset('js/easyhttp3.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('js/fetchProduct.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('js/fetch.js') }}" type="text/javascript" ></script>

        <script type="text/javascript">


    // (function() {

        const data = {
            '_token': "{!! csrf_token() !!}"
        };

        // fetch Product, Make And Model for Product Filtering

        const userRole = "{{ Request()->user()->roles()->first()->name }}";

        const xhr = new EasyHttp();

        getProductMake(xhr, 'productId', 'makeId', function(data, userRole){

            fetchProduct(data, userRole);
        });
        
        getProductModel(xhr, 'makeId', 'modelId', function(data, userRole){

            fetchProduct(data, userRole);
        });

        const modelId = document.querySelector('#modelId');

        modelId.addEventListener('change', function(e){

        const modelId = e.target.value;

        data.model = modelId;

        fetchProduct(data, userRole);

        })
        
        // fetch product on Page Load
        fetchProduct(data, userRole);

        // fetch Product, Make And Model for Adding Product form

        getProductMake(xhr, 'addProductId', 'addMakeId', function(data, userRole){});
        
        getProductModel(xhr, 'addMakeId', 'addModelId', function(data, userRole){});

        
        
            
        
        // const makeId = document.querySelector('#makeId');
        // const modelId = document.querySelector('#modelId');

        // let currentUrl  = document.URL;
        // let queryStr = null;

        // productId.addEventListener('change', function(){
        //     $regex1 = /(make|model)/;

        //     if( /product_name/.test(currentUrl) ) { // check if query string contains product_name
    
        //         // SEARCH for product_name followed by a '=' followed by a digit
        //         queryStr = /product_name?=\=?\d/.exec(currentUrl);
        //                                        //old val,   //new val
        //         currentUrl = currentUrl.replace(queryStr, `product_name=${this.value}`);

        //         location.href = currentUrl;
                
        //     }else if( $regex1.test(currentUrl) ){ // check if a query String contains 'Make' or \Model'
        //         location.href = ` ${currentUrl}&product_name=${this.value} `;
        //     }else{
        //         location.href = ` ${currentUrl}?product_name=${this.value} `;
        //     }
        // });

        //  makeId.addEventListener('change', function(){
        //     $regex2 = /(product_name|model)/;

        //     if( /make/.test(currentUrl) ) { // check if query string contains make
    
        //         // SEARCH for make followed by a '=' followed by a digit
        //         queryStr = /make?=\=?\d/.exec(currentUrl);
        //                                        //old val,   //new val
        //         currentUrl = currentUrl.replace(queryStr, `make=${this.value}`);

        //         location.href = currentUrl;
                
        //     }else if( $regex2.test(currentUrl) ){
        //         location.href = ` ${currentUrl}&make=${this.value} `;
        //     }else{
        //         location.href = ` ${currentUrl}?make=${this.value} `;
        //     }
        // });

        //   modelId.addEventListener('change', function(){
        //     $regex3 = /(product_name|make)/;
            
        //     if( /model/.test(currentUrl) ) { // check if query string contains model
    
        //         // SEARCH for model followed by a '=' followed by a digit
        //         queryStr = /model?=\=?\d/.exec(currentUrl);
        //                                        //old val,   //new val
        //         currentUrl = currentUrl.replace(queryStr, `model=${this.value}`);

        //         location.href = currentUrl;
                
        //     }else if( $regex3.test(currentUrl) ){
        //         location.href = ` ${currentUrl}&model=${this.value} `;
        //     }else{
        //         location.href = ` ${currentUrl}?model=${this.value} `;
        //     }
        // });

        // })();

       </script>

@endsection


