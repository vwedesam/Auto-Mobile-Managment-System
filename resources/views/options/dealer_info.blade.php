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
                                    
                                   <?php $d_info= 'class="active"';
                                          $name = $model = $make = '';
                                    ?>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <!-- Nav tabs -->
                                        @include('inc/options_nav')
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            
                                            <div class="tab-pane fade in active" id="settings">
                                                <div class="row">
                                                    <div class="span4"></div>
                                                    <div class="span8">
                                                        <div> 
                                                        @if( Auth()->user()->hasRole('admin') )
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#UpdateInfo">
                                                                 Update Company Info
                                                            </button>
                                                        @endif
                                                            <br>
                                                        </div>
                                                        @include('inc.msg')
                                                        <br>
                                                        <div class="alert alert-success alert-dismissible">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                            <h5> Company Name, Address and other information will be printed on all or most Invoices and Reports as required  </h5> 
                                                        </div>
                                                        <div class="box">
                                                        @if( $dealer_info == null )
                                                        @else
                                                            <div class="box-content" style="font-size:17px;">
                                                            
                                                            Company Name: {{ $dealer_info->dealer_name }}
                                                            <br>
                                                            <br>
                                                            Company Email: {{ $dealer_info->email }}
                                                            <br>
                                                            <br>
                                                            Company Phone: {{ $dealer_info->phone }}
                                                            <br>
                                                            <br>
                                                            Company Address: {{ $dealer_info->address }}, 
                                                            {{ $dealer_info->state }},
                                                            {{ $dealer_info->country }}. 
                                                                 
                                                            </div>
                                                        @endif   
                                                        </div>
                                                    </div>
                                                    
                                                </div>
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

        <!-- Modal -->
        <div class="modal fade" id="UpdateInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4> Company Information </h4>
                    </div>
                    <div class="modal-body">
                     {!! Form::model($dealer_info, [
                            'method' => 'PUT',
                            'route' => ['dealer_info.update', 1]
                            ]) !!}
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-">Dealer Name</i></span>
                                <input class="span4" name="d_name" type="text" value="{{ isset($dealer_info->dealer_name) ? $dealer_info->dealer_name : '' }}" placeholder="Dealer Name..." required >
                            </div>
                            <br>
                            <div class="input-prepend">
                                <span class="add-on"><i class="">Address</i></span>
                                <input class="span4" name="d_address" value="{{ isset($dealer_info->address) ? $dealer_info->address : '' }}" type="text" placeholder="Address ..." required >
                            </div>
                            <br>
                            <div class="input-prepend">
                                <span class="add-on"><i class="">State</i></span>
                                <input class="span4" name="d_state" type="text" value="{{ isset($dealer_info->state) ? $dealer_info->state : '' }}" placeholder="State ..." required >
                            </div>
                            <br>
                            <div class="input-prepend">
                                <span class="add-on"><i class="">Country</i></span>
                                <input class="span4" name="d_country" type="text" value="{{ isset($dealer_info->country) ? $dealer_info->country : '' }}" placeholder="Country ..." required >
                            </div>
                            <br>
                            <div class="input-prepend">
                                <span class="add-on"><i class="">Email</i></span>
                                <input class="span4" name="d_email" type="email" value="{{ isset($dealer_info->email) ? $dealer_info->email : '' }}" placeholder="Email address" required >
                            </div>
                            <br>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-">Phone Number</i></span>
                                <input class="span4"  name="d_phone" type="number" 
                                value="{{ isset($dealer_info->phone) ? $dealer_info->phone : '' }}" placeholder="Phone Number..."  required >
                            </div>
                            
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="icon-ok"></i>
                            Save Changes!!
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

@endsection


