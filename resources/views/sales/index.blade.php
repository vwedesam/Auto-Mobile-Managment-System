@extends('layouts.main')

@section('style')
<style type="text/css">
  
  .table tr th, .table tr td {
    border-left: solid 0px;
  }
  .table {
    border: solid 0px;
  }

</style>
@endsection

@section('content')

        <div class="row">
            <div class="span16">
                <div class="box">
                    <div class="box-header">
                        <i class="icon-book"></i>
                        <h5> New Sales  </h5>
                    </div>
                    <div class="box-content">
                        <div class="panel tabbed-panel panel-default">
                            <div class="panel panel-default">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    
                                    @include('inc.msg')
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addProductToInvoice">
                                      <strong>  Add product ++ </strong>
                                    </button> 
                                    <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#addMisToInvoice">
                                      <strong>  Add Miscellaneous ++ </strong>
                                    </button> 
                                    <br><br><br><br>   
                                    
                                    <table class="table table-hover tablesorter table-bordered">
                                        <thead>
                                            <tr style="background:#eee;"> 
                                            <th> # </th> <th> Item  </th> 
                                            <th> Description </th>
                                            <th> Quantity </th>
                                            <th> Rate </th> <th> Total </th> 
                                             <th> * </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $invoice_total = 0; ?>
                                        @if( count(Cart::instance('invioce')->content()) > 0 )
                                            <?php $i = 1; ?>

                                            @foreach( Cart::instance('invioce')->content() as $cartItem )
                                            <tr>
                                                <td> <?php echo $i++; ?></td>
                                               @if( $cartItem->name == 'product_name' ) 
                                                <td> {{ $cartItem->model->product_name->name }} </td>
                                                <td>  {{ $cartItem->model->make->name }} , 
                                                      {{ $cartItem->model->model->name }}
                                                </td>
                                               
                                                <td> {{ $cartItem->qty }} </td>
                                                <td> &#8358; 
                                                    {{ number_format($cartItem->options->cost_per_product) }} 
                                                </td>
                                                <td> &#8358; 
                                                    {{ number_format($cartItem->options->product_total) }}

                                                    <?php $invoice_total += $cartItem->options->product_total; ?>
                                                </td> 
                                                <td>
                                                    {!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;', 'route' => ['sales.destroy', $cartItem->rowId ]] ) !!}
                                                    <button type="submit" onclick=" return confirm(' Are you Sure you want to Romove this Product/Item')"  class="btn btn-small btn-danger">
                                                    <i class="btn-icon-only icon-remove"></i></button>
                                                    {!! Form::close() !!}
                                                </td>
                                                @else
                                                <td> {{ $cartItem->model->name }} </td>
                                                <td> 
                                                      {{ $cartItem->model->make }}
                                                      {{ $cartItem->model->description }}
                                                </td>
                                               
                                                <td> {{ $cartItem->qty }} </td>
                                                <td> &#8358; 
                                                    {{ number_format($cartItem->options->cost_per_product) }} 
                                                </td>
                                                <td> &#8358; 
                                                    {{ number_format($cartItem->options->product_total) }}

                                                    <?php $invoice_total += $cartItem->options->product_total; ?>
                                                </td> 
                                                <td>
                                                    {!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;', 'route' => ['sales.destroy', $cartItem->rowId ]] ) !!}
                                                    <button type="submit" onclick=" return confirm(' Are you Sure you want to Romove this Product/Item')"  class="btn btn-small btn-danger">
                                                    <i class="btn-icon-only icon-remove"></i></button>
                                                    {!! Form::close() !!}
                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach

                                        @else
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong> Add New Sales !! </strong>
                                            </div>
                                        @endif
                                        </tbody>
                                    </table>
                                        
                                    <div style="margin:0 auto;width:400px;padding-left:60%;" >
                                       <h4> Total: &#8358; {{ number_format($invoice_total) }} </h4>
                                    </div>  
                                </div>
                                <!-- /.panel-body -->

                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <br>
                        @if( count(Cart::instance('invioce')->content()) > 0 )
                        <form method="post" target="_blank" action="{{ route('invoice.store') }}" style="display:inline;">
                          @csrf
                          <input name="invoice_total" type="hidden" value="{{ $invoice_total }}">
                          <div class="input-prepend">
                            <span class="add-on"> <i class="icon-envel"> Customer &nbsp; </i></span>
                            {!! Form::select('customer_id', App\Customer::pluck('name', 'id'), '', ['placeholder' => 'All Customer', 'id' => 'customerId', 'required' => 'true' ]) !!}
                          </div>
                          @if( Auth::user()->hasRole('employee') )
                          <div >
                            Payment Mode: 
                            <select name="invoice_status" required>
                              <option value=""> -- -- </option>
                              <option value="Paid(Cash)"> Cash </option>
                              <option value="Paid(Cheque)"> Cheque </option>
                              <option value="Paid(POS)"> POS </option>
                              <option value="Paid(ACC)"> Account/Transfer </option>
                            </select>
                          </div>
                          @else
                          <div >
                            Payment Mode: 
                            <select name="invoice_status" required>
                              <option value=""> -- -- </option>
                              <option value="Credit"> Credit </option>
                              <option value="Paid(Cash)"> Cash </option>
                              <option value="Paid(Cheque)"> Cheque </option>
                              <option value="Paid(POS)"> POS </option>
                              <option value="Paid(ACC)"> Account/Transfer </option>
                            </select>
                          </div>
                          @endif
                          <div>
                          <!-- Button trigger modal -->
                            <a href="#"  data-toggle="modal" data-target="#addNewCustomer">
                                Add New Customer
                            </a> 
                          </div>
                          <button type="submit" class="btn btn-success">
                            <i class="icon-print"></i>
                            Check Out And Print Invoice
                          </button>
                        </form>
                        
                        <form method="post" action="{{ route('sales.empty') }}" style="display:inline;">
                          @csrf
                           <button type="submit" class="btn btn-danger pull-right" onclick="return confirm(' Are you Sure you want to Romove All Product')" >
                            <i class="icon-exit"></i>
                            Romove All Product from Invoice!
                           </button>
                        </form>
                        @endif
                    </div>
                </div> <!-- box end -->
            </div> <!-- span end -->
            
        </div> <!-- row end -->

        <!-- Modal for Products -->
          @include('inc/products_modal')
        <!-- /.modal -->

       <!-- Modal For New Customer -->
        @include('inc/customer_modal')
        <!-- Modal --> 

      <!-- Modal For Miscellaneous -->
        @include('inc/miscellaneous_modal')
      <!-- /.modal -->
     

@endsection

@section('script')

    <script src="{{ asset('js/easyhttp3.js') }}" type="text/javascript" ></script>
    <script src="{{ asset('js/fetch_for_invoice.js') }}" type="text/javascript" ></script>
    <script src="{{ asset('js/fetch_for_invoice2.js') }}" type="text/javascript" ></script>
    <script src="{{ asset('js/fetch.js') }}" type="text/javascript" ></script>

<script type="text/javascript">

        const data = {
            '_token': "{!! csrf_token() !!}",
            'url': '/sales/add'
        };

        const userRole = "{{ Request()->user()->roles()->first()->name }}";


        // Miscellaneous
        const searchMisc = document.querySelector('#searchMisc');

        searchMisc.addEventListener('keyup', function(e){

        data.search = e.target.value;

        fetchMiscellaneous(data, userRole);

        })

        fetchMiscellaneous(data, userRole);

        // fetch Product, Make And Model for Product Filtering

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



</script>
 
@endsection


