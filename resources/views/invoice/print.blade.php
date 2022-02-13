<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>invoice</title>
    <style>
        body{
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
        table{
            border-collapse: collapse;
            outline: none;
            /*border: none;*/
            padding: 10px;
        }
        .container{
            width: 800px;
            margin: auto;
            margin-top: 40px;
            margin-bottom: 60px;
            border: 1px solid black;
        }
       .first {
            text-align: center;
        }
        #invoice {
            text-decoration: underline;
            padding: 40px 0px 40px 0px;
            text-align: center;
        }
        .tablebody{
            border: 1px solid black;
            text-align: center;
        }
        .cust {
            font-weight: bold;
            padding-left: 5px;
            font-size: 17px;
        }
        .spc {
            padding-left: 10px;
        }
        
    </style>
</head>
<body>
        <table class="table container ">
            <thead>
                <tr>
                    <th colspan="6" class="first"> <h3> {{ strtoupper($dealer->dealer_name) }} </h3> </th>
                </tr>
                <tr>
                    <th colspan="6" class="first"> {{ strtoupper($dealer->address) }} - {{ strtoupper($dealer->state) }}, {{ strtoupper($dealer->country) }} </th>
                </tr>
                <tr>
                    <th colspan="6" class="first">{{ strtoupper($dealer->email) }}, {{ strtoupper($dealer->phone) }}</th>
                </tr>
                <tr>
                    <?php 
                        $invoice_type = "SALES"; 
                        $payment = "<br> STATUS : ".strtoupper($customer->status) ;  
                      if( $customer->status == "transfer" ){
                        $invoice_type = strtoupper($customer->status);
                        $payment = "";
                      }
                    ?>
                    <th colspan="6" id="invoice" ><b> {{ $invoice_type }} INVOICE<b></th>
                </tr>
                <tr>
                    <td colspan="6" class="cust">  CUSTOMER : 
                   {{ strtoupper($customer->customer->name) }} 
                    <br>
                   DATE: {{ date('d M, Y', strtotime($customer->created_at)) }} 
                   <br>  
                   INVOICE NO: {{ $customer->invoice_ID }} 
                   {!! $payment !!} </td>
                </tr>
                <tr>
                    <td colspan="5"> <br> </td>
                </tr>
            </thead>
            <tbody >
                <tr>
                    <td class="tablebody">S/N</td>
                    <td class="tablebody">ITEMS</td>
                    <td class="tablebody">DESCRIPTION</td>
                    <td class="tablebody">QUANTITY</td>
                    <td class="tablebody">RATE</td>
                    <td class="tablebody">AMOUNT</td>
                </tr>
            <?php $invoice_total = 0; ?>
            @if( count($product_invoice) < 0 || count($product_invoice) < 0 )

            @else

                <?php $i = 1; ?>
                @foreach( $product_invoice as $product )
                <tr>
                    <td class="tablebody"><?php echo $i++; ?></td>
                    <td class="tablebody">{{ $product->product->product_name->name }}</td>
                    <td class="tablebody">{{ $product->product->make->name }} , 
                                          {{ $product->product->model->name }}
                    </td>
                    <td class="tablebody">{{ $product->qty_ordered }}</td>
                    <td class="tablebody">&#8358; {{ number_format($product->rate_per_product) }} </td>
                    <td class="tablebody">&#8358; {{ number_format($product->total) }}
                       <?php $invoice_total += $product->total; ?>
                    </td>
                </tr>

                @endforeach

                @foreach( $miscellaneous_invoice as $miscellaneous )
                <tr> 
                    <td class="tablebody"><?php echo $i++; ?></td>
                    <td class="tablebody">{{ $miscellaneous->miscellaneous->name }} </td>
                    <td class="tablebody">{{ $miscellaneous->miscellaneous->make }} , 
                          {{ $miscellaneous->miscellaneous->description }}
                    </td>
                    <td class="tablebody">{{ $miscellaneous->qty_ordered }}</td>
                    <td class="tablebody">&#8358; 
                        {{ number_format($miscellaneous->rate) }}  </td>
                    <td class="tablebody">&#8358; 
                        {{ number_format($miscellaneous->total) }}

                        <?php $invoice_total += $miscellaneous->total; ?>
                    </td>
                </tr>
                @endforeach

            @endif
                <tr>
                    <td class="tablebody"></td >
                    <td class="tablebody"></td >
                    <td class="tablebody"></td>
                    <td class="tablebody"></td>
                    <td class="tablebody"></td>
                    <td class="tablebody"> <b>  &#8358;{{ number_format($invoice_total) }} </b> </td>
                </tr>
                <tr>
                    <td colspan="5" class="spc"> 
                        <h3>  {{ ucfirst(Terbilang::make($invoice_total)) }} Naira. </h3>
                        <h3> Invoice Issued by : {{ $customer->user->first_name }} </h3>
                    </td>
                    <td  class="spc" style="text-align:center;"> 
                        <h3>  _____________________________ <br> Authorized By </h3>
                    </td>
                </tr>
            </tbody>
            </table>




                <table class="table container ">
                    <thead>
                        <tr>
                            <th colspan="5" id="invoice" ><b>SECURITY/EXIT PERMIT<b></th>
                        </tr>
                        <tr>
                            <td colspan="5" class="cust">  CUSTOMER : 
                           {{ strtoupper($customer->customer->name) }} 
                            <br>
                           DATE: {{ date('d M, Y', strtotime($customer->created_at)) }} 
                           <br>  
                           INVOICE NO: {{ $customer->invoice_ID }} 
                           {!! $payment !!} </td>
                        </tr>
                        <tr>
                            <td colspan="5"> <br> </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tablebody">S/N</td>
                            <td class="tablebody" >ITEMS</td>
                            <td class="tablebody" colspan="2">DESCRIPTION</td>
                            <td class="tablebody" >QUANTITY</td> 
                        </tr>
                    <?php $total_qty = 0; ?>
                    @if( count($product_invoice) < 0 || count($product_invoice) < 0 )

                    @else
                        <?php $i = 1; ?>
                        @foreach( $product_invoice as $product )
                        <tr>
                            <td class="tablebody"><?php echo $i++; ?></td>
                            <td class="tablebody">{{ $product->product->product_name->name }}</td>
                            <td class="tablebody" colspan="2">{{ $product->product->make->name }} , 
                                                  {{ $product->product->model->name }}
                            </td>
                            <td class="tablebody">{{ $product->qty_ordered }} 
                            
                               <?php $total_qty += $product->qty_ordered; ?>
                            </td>
                        </tr>
                        @endforeach

                        @foreach( $miscellaneous_invoice as $miscellaneous )
                        <tr> 
                            <td class="tablebody"><?php echo $i++; ?></td>
                            <td class="tablebody">{{ $miscellaneous->miscellaneous->name }} </td>
                            <td class="tablebody" colspan="2">
                                {{ $miscellaneous->miscellaneous->make }} , 
                                  {{ $miscellaneous->miscellaneous->description }}
                            </td>
                            <td class="tablebody">{{ $miscellaneous->qty_ordered }} 
                            
                               <?php $total_qty += $miscellaneous->qty_ordered; ?>
                            </td>
                        </tr>
                        @endforeach

                    @endif
                        <tr>
                            <td class="tablebody" colspan="4"> <b>Total items permitted</b> </td>
                            <td class="tablebody" colspan="2"> <b> {{ $total_qty }} </b> </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="spc">
                            <h3> Invoice Issued by : {{ $customer->user->first_name }} </h3>
                            
                            <h3> Security checks by: ______________________________________________
                                            Name & signature </h3>
                            </td>
                        </tr>
                    </tbody>
                    </table>
            </div>

    
</body>
</html>