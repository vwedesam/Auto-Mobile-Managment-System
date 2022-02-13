@extends('layouts.main')

@section('style')
<link rel="stylesheet" href="{{ asset('css/panel.css') }}">
@endsection

@section('content')
        @include('inc.msg')
        <div class="row">
            <div class="span16">
                <div class="row"> <!- row  -->
                    <div class="span7">
                        <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="text-right" style="text-align:right;font-size:20px;"> Today Sales </div>

                            <div class="text-right" style="text-align:right;font-size:50px;padding:20px"> &#8358; {{ $daily_sales }} </div>
                            <a href="{{ route('summary.index') }}" style="color:white;"> &laquo; View Details &raquo; </a>

                        </div>
                        </div>
                    </div> <!-- span end -->
                    <div class="span9">
                        <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="text-right" style="text-align:right;font-size:20px;"> This Month Sales </div>
                            <div class="text-right" style="text-align:right;font-size:50px;padding:20px"> &#8358; {{ $monthly_sales }} </div>
                            <a href="" style="color:white;"> &laquo; View Details &raquo; </a>
                        </div>
                        </div>
                    </div> <!-- span end -->
                </div> <!-- row end -->
            </div> <!-- span end -->
            <div class="span4">
                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-heading">
                        <i class="icon-user icon-large"></i> &nbsp; Numbers of Customer
                    </div>
                    <a href="{{ route('customer.index') }}">
                    <div class="panel-body" >
                        <div style="text-align:center;" >
                            <div class="icon-lg"><i class="icon-user-md" ></i> </div>
                            <div class="text-lg"> {{ $customer }} </div>
                        </div>
                    </div>
                    </a>
                    <!-- /.panel-body -->
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="icon-th icon-large"></i> &nbsp; Available Brand/make
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body" style="height:235px;overflow-y:scroll;">
                    @if( count($brands) > 0 )
                       @foreach($brands as $brand)
                        <div class="list_group text-sm" >
                            <span> {{ $brand->name }} </span>
                        </div>
                        @endforeach
                    @endif
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
            <div class="span12">
                <div class="box">
                    <div class="box-header">
                        <i class="icon-th-list"></i>
                        <h5> Your Recent Invoice </h5>
                        <!-- Search Filter -->
                        <div style="float:right;margin-top:-5px;">
                            {!! Form::select('customer_id', App\Customer::pluck('name', 'id'), '', ['placeholder' => 'Select Customer', 'id' => 'customerId' ]) !!}
                            <input type="date" name="name" id="fromDate" >
                        </div>
                    </div>
                    <div class="box-content" style="height:400px;overflow-y:scroll;width:98%;">
                        <table class="table table-hover tablesorter table-bordered">
                            <thead>
                                <thead>
                                <tr style="background:#eee;"> 
                                <th> # </th> <th> Invoice Id </th> 
                                <th> Customer <br> </th>
                                <th> Date </th> <th> Status </th>
                                <th>  Product(s) </th> <th> Total  </th>
                                </tr>
                            </thead>
                            <tbody id="invoiceTable">
                                
                            </tbody>
                        </table>
                    </div>
                </div> <!-- box end -->

            </div> <!-- span end -->
            
        </div> <!-- row end -->

@endsection

@section('script')

        <script src="{{ asset('js/easyhttp3.js') }}" type="text/javascript" ></script>

        <script type="text/javascript">

        const data = {
            '_token': "{!! csrf_token() !!}"
        };

        const userRole = "{{ Request()->user()->roles()->first()->name }}";

        const fetchSummaries = (data, userRole) => {

        const xhr = new EasyHttp();



        xhr.post('/invoice/fetch', data)
            .then(datas => {
                console.log(datas);

                let html = '';

                let i = 1;

                datas.forEach((data) => {
                
                console.log(data);

                html+= `<tr> 
                    <td> ${i++} </td>
                    <td> <a href="/invoice/${data.id}/view"> ${data.invoice_ID} </a>  </td>
                    <td> ${data.customer.name } </td>
                    <td> ${data.created_at.slice(0, 10)}   </td>
                    <td> <strong> ${ (data.status).toUpperCase() } </strong>  </td>
                    <td> ${ data.product_sales_invoice.length + data.miscellaneous_sales.length } </td>
                    <td> &#8358; ${ new Intl.NumberFormat().format(data.invoice_total) } </td>
                </tr> `;
                })
            

                document.getElementById('invoiceTable').innerHTML = html;
            })
            .catch(err => {
                document.getElementById('invoiceTable').innerHTML = 
                `<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong> No Sales Found for this Search!! </strong>
                </div>`;
            });
            
        };

        fetchSummaries(data, userRole);

        const customerId = document.getElementById('customerId');

        customerId.addEventListener('change', function(e){

            data.customer_id = e.target.value;
            data.from_date = null;

            fetchSummaries(data, userRole);

        });

        const fromDate = document.getElementById('fromDate');

        fromDate.addEventListener('change', function(e){

            data.from_date = e.target.value;
            data.customer_id = null;

            fetchSummaries(data, userRole);

        });

       </script>

@endsection


