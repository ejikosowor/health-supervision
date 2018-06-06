@extends('layouts.app')

@section('pageheader')
<a class="navbar-brand" href="{{ route('users.index') }}">Users</a>
@endsection

@section('breadcrumbs')
<li class="active">Users</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">All Users</h4>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Facility</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    @if($user->facility_id != null)
                                        <td>{{ $user->facility->name }}</td>
                                    @elseif($user->role_id != 1)
                                        <td><span class="label label-danger">Not Assigned</span></td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-default btn-xs">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">New User</h4>
                </div>
                <div class="content">
                    {!!	Form::open(['route' => 'users.store']) !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name', null, ["class" => "form-control", "placeholder" => "Name"]) }}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            {{ Form::label('username', 'Username') }}
                            {{ Form::text('username', null, ["class" => "form-control", "placeholder" => "Username"]) }}
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', null, ["class" => "form-control", "placeholder" => "Email"]) }}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{ Form::label('password', 'Password') }}
                            {{ Form::password('password', ["class" => "form-control"]) }}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                            {{ Form::label('role_id', 'Role') }}
                            {{ Form::select('role_id', $roles, null, ["class" => "form-control", "placeholder" => "Role"]) }}
                                @if ($errors->has('role_id'))
                                    <span class="text-danger help-block">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('facility_id') ? ' has-error' : '' }}">
                            {{ Form::label('facility_id', 'Facility') }}
                            {{ Form::select('facility_id', $facilities, null, ["class" => "form-control", "placeholder" => "Facility"]) }}
                                @if ($errors->has('facility_id'))
                                    <span class="text-danger help-block">
                                        <strong>{{ $errors->first('facility_id') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-sm">Create</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection