@extends('layouts.app')

@section('pageheader')
<a class="navbar-brand" href="{{ route('users.index') }}">Users</a>
@endsection

@section('breadcrumbs')
<li><a href="{{ route('users.index') }}">Users</a></li>
<li class="active">Update</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">Update User</h4>
                </div>
                <div class="content">
                    {!!	Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name', null, ["class" => "form-control", "disabled" => "disabled"]) }}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            {{ Form::label('username', 'Username') }}
                            {{ Form::text('username', null, ["class" => "form-control", "disabled" => "disabled"]) }}
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', null, ["class" => "form-control", "disabled" => "disabled"]) }}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection