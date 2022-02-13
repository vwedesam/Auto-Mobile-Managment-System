@extends('layouts.main')

@section('style')

@endsection

@section('content')

        <div class="row">
            <div class="span5">
                <div class="box">
                    <div class="box-header">
                        <i class="icon-book"></i>
                        <h5> Add New Customer </h5>
                    </div>
                    <div class="box-content">
                    	<br>
                        <?php
                        if($editable) {
                            $method = 'PUT';
                            $act = 'Update';
                            $action = 'customer.update';
                            $btn = 'Update'; 
                        }
                        else {
                            $method = 'POST';
                            $act = 'Add';
                            $action = 'customer.store';
                            $btn = 'Submit';
                        }
                        ?>
                        <h4> {{ $act }} Customer </h4>
                        {!! Form::model($customer, [
                                'method' => $method,
                                'route' => [$action, $customer->id]
                            ]) !!} <!-- Customer Form -->            
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-user"></i></span>
                                <input class="span4" value="{{ $customer->name }}" name="full_name" type="text" placeholder="Full Name..." required >
                            </div>
                            <br>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-envelope"></i></span>
                                <input class="span4" value="{{ $customer->email }}" name="email" type="email" placeholder="Email address" required="true">
                            </div>
                            <br>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-flag"></i></span>
                                <input class="span4" value="{{ $customer->address }}" name="address" type="text" placeholder="Enter Full Address..." required >
                            </div>
                            <br>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-phone"></i></span>
                                <input class="span4" value="{{ $customer->phone }}"  name="phone_number" type="number" placeholder="Phone Number..." required >
                            </div>
                            <br>
                    </div>
                    <div class="box-footer">
                           <button type="submit" class="btn btn-primary">
                            <i class="icon-ok"></i>
                            {{ $btn  }}
                           </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="span11">
                @include('inc.msg')
               <div id="Person-1" class="box">
                        <div class="box-header">
                            <i class="icon-user icon-large"></i>
                            <h5> All Customer </h5>
                        </div>
                        <div class="box-content box-table">
                        <table class="table table-hover tablesorter table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                    <th>Address  </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                            @if( count($customers) > 0 ) 
                                @foreach( $customers as $customer )
                                <tr> 
                                    <td> {{ $customer->name }} </td>
                                    <td> {{ $customer->email }} </td>
                                    <td> {{ $customer->phone }} </td>
                                    <td> {{ $customer->address }} </td>
                                    <td>
                                    @if( Auth()->user()->hasRole('admin') ||  Auth()->user()->hasRole('manager') )
                                        <a href="{{ route('customer.edit', $customer->id ) }}" class="btn btn-small btn-info">
                                        <i class="btn-icon-only icon-edit"></i> </a>
                                      @if( Auth()->user()->hasRole('admin') )
                                        {!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;', 'route' => ['customer.destroy', $customer->id]] ) !!}
                                        <button type="submit" onclick=" return confirm('this Action cannot be undone Are you Sure you want to delete this Customer')"  class="btn btn-small btn-danger">
                                        <i class="btn-icon-only icon-remove"></i></button>
                                        {!! Form::close() !!}
                                       @endif
                                    @else
                                        <a class="btn btn-small btn-info" disabled="true">
                                        <i class="btn-icon-only icon-edit"></i> </a>
                                    @endif

                                    </td>
                                </tr>
                                @endforeach
                            @else
                             <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong> No Customer Found !! </strong>
                                </div>
                            @endif

                            </tbody>
                        </table>
                        {{ $customers->links() }}
                        </div>
            </div>
        </div>

@endsection


