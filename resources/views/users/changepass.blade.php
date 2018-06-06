@extends('layouts.app')

@section('pageheader')
<a class="navbar-brand" href="{{ route('home') }}">Dashboard{{ Auth::user()->role_id == 4 ? " - ".Auth::user()->facility->name : ""}}</a>
@endsection

@section('breadcrumbs')
<li class="active">Change Password</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Change Password</h4>
                </div>
                <div class="content">
                    {!!	Form::open(['route' => 'password.save']) !!}
                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                            <label for="current_password" class="=control-label">Current Password</label>
                            <input id="current_password" type="password" class="form-control" name="current_password" value="{{ old('current_password') }}">
                            @if ($errors->has('current_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
                            <label for="new_password" class="=control-label">New Password</label>
                            <input id="new_password" type="password" class="form-control" name="new_password" value="{{ old('new_password') }}">
                            @if ($errors->has('new_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new_password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation" class="control-label">Confirm Password</label>
                            <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation">
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">
                                Change Password
                            </button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection