@extends('layouts.main')

@section('style')

@endsection

@section('content')

        <div class="row">
            <div class="span6">
                <div class="box">
                    <div class="box-header">
                        <i class="icon-book"></i>
                        <?php
                            if($editable) {
                                $method = 'PUT';
                                $act = 'Edit';
                                $action = 'user.update';
                                $btn = 'Update'; 
                                $psd = '';
                            }
                            else {
                                $method = 'POST';
                                $act = 'Add New';
                                $action = 'user.store';
                                $btn = 'Submit';
                                $psd = 'required';
                            }
                            ?>
                            
                        <h5> {{ $act }} User </h5>
                    </div>
                    <div class="box-content">
                    	<br>
                        {!! Form::model($user, [
                            'method' => $method,
                            'route' => [$action, $user->id]
                            ]) !!}
                            @if( $user->id == 1 )
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-user"></i></span>
                            {!! Form::select('role', App\Role::pluck('display_name', 'id'), 
                            $user->exists ? $user->roles[0]->id : null, ['class' => 'span4', 'disabled' => 'true']) !!}
                            </div>
                            @else
                             <div class="input-prepend">
                                <span class="add-on"><i class="icon-user"></i></span>
                               @if( \Auth::user()->hasRole('admin') )

                                {!! Form::select('role', App\Role::pluck('display_name', 'id'), 
                                $user->exists ? $user->roles[0]->id : null, ['class' => 'span4', 'placeholder' => 'Choose User Role ...', 'required' => "true"]) !!}

                               @else

                                 {!! Form::select('role', App\Role::pluck('display_name', 'id'), 
                                 isset($user->roles[0]->id) ? $user->roles[0]->id : 3, ['class' => 'span4', 'disabled' => 'true']) !!}

                               @endif
                            </div>
                            @endif
                            <br>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-check "></i></span>
                                <?php
                                $active = ""; $inactive = "";
                                switch ($user->status) {
                                    case '0':
                                        $inactive = "selected";
                                        break;
                                    case '1':
                                        $active = "selected";
                                        break;
                                }
                                
                                ?>
                                @if( $user->id == 1 )
                                <select class="span4" name="status" disabled="true" >
                                    <option value="0" {{ $inactive }} > Inactive </option>
                                    <option value="1" {{ $active }} > Active </option>
                                </select> 
                                @else
                                <select class="span4" name="status" required="true">
                                    <option value=""> Choose user Status .. </option>
                                    <option value="0" {{ $inactive }} > Inactive </option>
                                    <option value="1" {{ $active }} > Active </option>
                                </select> 
                                @endif
                            </div>
                            <br>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-envelope"></i></span>
                                <input class="span4" name="email" value="{{ $user->email }}" type="email" placeholder="Email address" required="true">
                            </div>
                            <br>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-key"></i></span>
                                <input class="span4" name="password"  type="password" placeholder="Password" {{ $psd }} >
                            </div>
                            <br>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-name"> First Name</i></span>
                                <input class="span4" name="first_name" value="{{ $user->first_name }}"  type="text" placeholder="First Name..." required >
                            </div>
                            <br>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-name">Last Name</i></span>
                                <input class="span4" name="last_name" value="{{ $user->last_name }}"  type="text" placeholder="Last Name..." required >
                            </div>
                            <br>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-name">Phone ... ..</i></span>
                                <input class="span4" value="{{ $user->phone }}"   name="phone" type="number" placeholder="Phone Number..." required>
                            </div>
            
                    </div>
                    <div class="box-footer">
                           <button type="submit" class="btn btn-primary">
                            <i class="icon-ok"></i>
                            {{ $btn }}
                           </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="span10">
               <div id="Person-1" class="box">
                        <div class="box-header">
                            <i class="icon-user icon-large"></i>
                            <h5> All Users </h5>
                        </div>
                        <div class="box-content box-table">
                            @include('inc.msg')
                        <table class="table table-hover tablesorter table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                    <th>Role </th>
                                    <th>Status </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                            @if( count($users) > 0 ) 
                                @foreach( $users as $user )
                                <tr> 
                                   @if( $user->id == 1 )
                                        @if( Auth()->user()->hasRole('admin') )
                                            <td> {{ $user->last_name }} {{ $user->first_name }} </td>
                                            <td> {{ $user->email }} </td>
                                            <td> {{ $user->phone }} </td>
                                            <td> {{ $user->roles[0]->name }} </td>
                                            <?php 
                                                if( $user->status == 1 ) $status = 'Active'; 
                                                else $status = 'Inactive'; 
                                            ?>
                                            <td> {{ $status }} </td>
                                            <td>
                                                <a href="{{ route('user.edit', $user->id ) }}" class="btn btn-small btn-info">
                                                <i class="btn-icon-only icon-edit"></i> </a>
                                            </td>
                                        @endif
                                   @else

                                    <td> {{ $user->last_name }} {{ $user->first_name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td> {{ $user->phone }} </td>
                                    <td> {{ $user->roles[0]->name }} </td>
                                    <?php 
                                        if( $user->status == 1 ) $status = 'Active'; 
                                        else $status = 'Inactive'; 
                                    ?>
                                    <td> {{ $status }} </td>
                                    <td>
                                        <a href="{{ route('user.edit', $user->id ) }}" class="btn btn-small btn-info">
                                        <i class="btn-icon-only icon-edit"></i> </a>

                                      @if( Auth()->user()->hasRole('admin') )
                                        {!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;', 'route' => ['user.destroy', $user->id]] ) !!}
                                        <button type="submit" onclick=" return confirm('this Action cannot be undone Are you Sure you want to delete this User')"  class="btn btn-small btn-danger">
                                        <i class="btn-icon-only icon-remove"></i></button>
                                        {!! Form::close() !!}
                                       @endif
                                    
                                    </td>
                                    @endif
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
                        </div>
            </div>
        </div>

@endsection


