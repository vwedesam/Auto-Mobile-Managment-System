<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/customize-template.css') }}" type="text/css" media="screen, projection" rel="stylesheet" />
    <!-- Styles -->
    <link href="{{ asset('css/paginate.css') }}" rel="stylesheet">
    <title> Sales Summary </title>
    <style>
        
      .table {
        border: solid 1px;
      }
      .table tr td {
        text-align: center;
        font-weight: bold;
        border: solid 1px;
      }

      .cap {
        padding: 10px 0;
      }

    </style>
</head>
<body>
      <div>
        @if( $summaries->count() > 0 )
        <table class="table table-bordered">
            <caption style="font-weight:bold;font-size:30px;padding:20px;">
              <div class="cap"> {{ $company_info->dealer_name }} </div>
              <div class="cap"> {{ $company_info->address }} {{ $company_info->state }} {{ $company_info->country }} </div>
               <div class="cap"> {{ $company_info->email }}  </div>  
            </caption>
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

    
</body>
</html>