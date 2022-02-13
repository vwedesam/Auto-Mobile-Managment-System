@extends('layouts.main')

@section('style')
<style type="text/css">

  .table tr td {
    text-align: center;
    font-weight: bold;
  }

</style>
@endsection

@section('content')

        <div class="row">
            <div class="span16">
                <div class="box">
                    <div class="box-header">
                        <i class="icon-book"></i>
                        <?php
                          if( $start_date == $end_date ){
                            $to = "For {$start_date} ";
                          }else{
                            $to = "From {$start_date} To {$end_date}";
                          }
                        ?>
                        <h5> Invoice Summary {{$to}}  </h5>
                        <div style="float:right;margin-top:-5px;">
                          From: <input type="date" value="{{ $start_date }}" name="fromDate" id="fromInvoiceDate" >
                          To: <input type="date" value="{{ $end_date }}" name="toDate" id="toInvoiceDate" >
                        </div>
                    </div>
                    <div class="box-content">
                        <div class="panel tabbed-panel panel-default">
                            <div class="panel panel-default">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    
                                    @include('inc.msg')
                                    <br>

                                    @if( $summaries->count() > 0 )
                                    <table class="table table-bordered">
                                        <tbody >
                                            <tr> 
                                              <td rowspan="2"> Date </td> 
                                              <td rowspan="2"> Invoice <br> No </td> 
                                              <td rowspan="2"> Customer </td>
                                              <td rowspan="2"> Status </td>
                                              <td colspan="{{ count($products) + 1 }}"> Items </td>
                                              <td rowspan="2"> Total </td>
                                              <!-- col without Product = 5 -->  
                                            </tr>
                                            <tr> 
                                            <!-- All Available Product --> 
                                            @foreach( $products as $product )
                                              <td> {{ $product->name }} </td>
                                            @endforeach
                                              <td> Miscellaneous </td>
                                            </tr>
                                          <?php $invoice_total = 0; ?>
                                          @foreach( $summaries as $summary )
                                            <tr> 
                                              <td> {{ $summary->new_date_format }} </td>
                                              <td> {{ $summary->invoice_ID }} </td>
                                              <td> {{ $summary->customer->name }} </td>
                                              <td> {{ ucfirst($summary->status) }} </td>
                                              <!-- All Available Product --> 
                                              @foreach( $products as $product )
                                              <td> {{ App\Helpers\HelperClass::check_product_qty($summary->id, $product->id ) }} </td>
                                              @endforeach
                                               <td> {{ App\Helpers\HelperClass::check_miscellaneous_qty($summary->id) }}  </td>
                                              <td style="text-align:left;"> &#8358; {{ number_format($summary->invoice_total) }} 
                                                   <?php $invoice_total += $summary->invoice_total; ?>
                                              </td>
                                            </tr>
                                          @endforeach
                                            <tr> 
                                              <td colspan="4"> Total  </td>
                                              <td colspan="{{ count($products) + 1 }}">  </td>
                                              <td style="text-align:left;"> &#8358; {{ number_format($invoice_total) }} </td>
                                            </tr>
                                        
                                        </tbody>
                                    </table> 
                                    @endif 
                                </div>
                                <!-- /.panel-body -->

                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                          <a href="{{ route('summary.print', [$start_date, $end_date]) }}" target="_blank" class="btn btn-warning">
                            <i class="icon-print"></i>
                            Print Sales Summary
                          </a>
                    </div>
                </div> <!-- box end -->
            </div> <!-- span end -->
            
        </div> <!-- row end -->

        
@endsection

@section('script')

<script type="text/javascript">

        const fromInvoiceDate = document.querySelector('#fromInvoiceDate');
        const toInvoiceDate = document.querySelector('#toInvoiceDate');

        let currentUrl  = document.URL;
        let queryStr = null;

        fromInvoiceDate.addEventListener('change', function(){

          //$regex1 = //;

          if( /fromDate/.test(currentUrl) ) { // check if query string contains date
            
            // SEARCH for date followed by a '=' followed(?=.) by a digit with Hyphen with max=10
            queryStr = /fromDate?=\=?[0-9\-]*/.exec(currentUrl);
                                                //old val,   //new val
            currentUrl = currentUrl.replace(queryStr, `fromDate=${this.value}`);
     
            location.href = currentUrl; 

          }else {
            location.href = `${currentUrl}/?fromDate=${this.value}`
          }      
        });

        toInvoiceDate.addEventListener('change', function(){

          if( /fromDate/.test(currentUrl) == false ) {

          }
          else if( /toDate/.test(currentUrl) ) { // check if query string contains date
            
            // SEARCH for date followed by a '=' followed(?=.) by a digit with Hyphen with max=10
            queryStr = /toDate?=\=?[0-9\-]*/.exec(currentUrl);
                                                //old val,   //new val
            currentUrl = currentUrl.replace(queryStr, `toDate=${this.value}`);
     
            location.href = `${currentUrl}`

          }else {
     
            location.href = `${currentUrl}&toDate=${this.value}`

          }
      
        });
 
</script>
 
@endsection


