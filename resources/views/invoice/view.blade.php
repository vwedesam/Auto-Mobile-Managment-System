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
                        <h5> Invoice Summary  </h5>
                    </div>
                    <div class="box-content">
                        <div class="panel tabbed-panel panel-default">
                            <div class="panel panel-default">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                        <br>
                                        <div style="font-size:17px;">
                                            <?php 
                                                $invoice_type = "Invoiced"; 
                                                $payment = "<p> <strong> Status: </strong>".strtoupper($customer->status)." </p> ";  
                                              if( $customer->status == "transfer" ){
                                                $invoice_type = strtoupper($customer->status);
                                                $payment = "";
                                              }
                                            ?>
                                             <h4> {{ $invoice_type }} To: </h4>
                                            <p> <strong> Name: </strong> {{ $customer->customer->name }}  </p>
                                            <p> <strong> Email: </strong> {{ $customer->customer->email }} </p>
                                            <p> <strong> Phone Number: </strong> {{ $customer->customer->phone }} </p>
                                            {!! $payment !!}
                                            
                                        </div>
                                        <br><br>
                                    <table class="table table-hover tablesorter table-bordered">
                                        <thead>
                                            <tr style="background:#eee;"> 
                                            <th> # </th> <th> Item  </th> 
                                            <th> Description </th>
                                            <th> Quantity </th>
                                            <th> Rate </th> <th> Total </th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $invoice_total = 0; ?>
                                        @if( count($product_invoice) < 0 || count($product_invoice) < 0  )

                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong> Invoice is Empty !! </strong>
                                            </div>

                                        @else

                                            <?php $i = 1; ?>
                                            @foreach( $product_invoice as $product )
                                            <tr> 
                                                <td> <?php echo $i++; ?></td>
                                                <td> {{ $product->product->product_name->name }} </td>
                                                <td>  {{ $product->product->make->name }} , 
                                                      {{ $product->product->model->name }}
                                                </td>
                                               
                                                <td> {{ $product->qty_ordered }} </td>
                                                <td> &#8358; 
                                                    {{ number_format($product->rate_per_product) }} 
                                                </td>
                                                <td> &#8358; 
                                                    {{ number_format($product->total) }}

                                                    <?php $invoice_total += $product->total; ?>
                                                </td> 
                                            </tr>
                                            @endforeach

                                            @foreach( $miscellaneous_invoice as $miscellaneous )
                                            <tr> 
                                                <td> <?php echo $i++; ?></td>
                                                <td> {{ $miscellaneous->miscellaneous->name }} </td>
                                                <td>  {{ $miscellaneous->miscellaneous->make }} , 
                                                      {{ $miscellaneous->miscellaneous->description }}
                                                </td>
                                               
                                                <td> {{ $miscellaneous->qty_ordered }} </td>
                                                <td> &#8358; 
                                                    {{ number_format($miscellaneous->rate) }} 
                                                </td>
                                                <td> &#8358; 
                                                    {{ number_format($miscellaneous->total) }}

                                                    <?php $invoice_total += $miscellaneous->total; ?>
                                                </td> 
                                            </tr>
                                            @endforeach

                                        @endif
                                        </tbody>
                                    </table>
                   
                                    <div style="margin:0 auto;width:400px;padding-left:60%;" >
                                        <br>
                                       <h4>  Total: &nbsp; &#8358; {{ number_format($invoice_total) }} </h4>

                                    </div>
                                     
                                </div>
                                <!-- /.panel-body -->

                            </div>
                        </div>

                    </div>
                    @if( Auth::user()->hasRole('employee') )
                    @else
                    <div class="box-footer">

                       <a href="{{ route('invoice.print', $id) }}" target="_blank" class="btn btn-success">
                        <i class="icon-print"></i>
                        Print Invoice
                       </a>
                    </div>
                    @endif
                </div> <!-- box end -->
            </div> <!-- span end -->
            
        </div> <!-- row end -->

     

@endsection



