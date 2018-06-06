@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">New Health Facility</div>

                <div class="panel-body">
                    {!!	Form::open(['route' => 'facilities.store', "class" => "form-horizontal"]) !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ Form::label('name', 'Facility Name', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-sm-9">                        
                                {{ Form::text('name', null, ["class" => "form-control", "placeholder" => "Facility Name"]) }}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('facility_code') ? ' has-error' : '' }}">
                            {{ Form::label('facility_code', 'Facility Code', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-sm-9">                        
                                {{ Form::text('facility_code', null, ["class" => "form-control", "placeholder" => "Facility Code"]) }}
                                @if ($errors->has('facility_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('facility_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                            {{ Form::label('contact_name', 'Contact Name', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-sm-9">                        
                                {{ Form::text('contact_name', null, ["class" => "form-control", "placeholder" => "Contact Name"]) }}
                                @if ($errors->has('contact_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', 'Contact Email', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-sm-9">                        
                                {{ Form::email('email', null, ["class" => "form-control", "placeholder" => "Contact Email"]) }}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            {{ Form::label('phone', 'Contact Phone', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-sm-9">                        
                                {{ Form::text('phone', null, ["class" => "form-control", "placeholder" => "Contact Phone"]) }}
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('contact_designation_id') ? ' has-error' : '' }}">
                            {{ Form::label('contact_designation_id', 'Contact Designation', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-sm-9">
                                {{ Form::select('contact_designation_id', $designations, null, ["class" => "form-control", "placeholder" => "Contact Designation"]) }}
                                @if ($errors->has('contact_designation_id'))
                                    <span class="text-danger help-block">
                                        <strong>{{ $errors->first('contact_designation_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('county_id') ? ' has-error' : '' }}">
                            {{ Form::label('county_id', 'County', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-sm-9">
                                {{ Form::select('county_id', $counties, null, ["class" => "form-control", "placeholder" => "County"]) }}
                                @if ($errors->has('county_id'))
                                    <span class="text-danger help-block">
                                        <strong>{{ $errors->first('county_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('sub_county_id') ? ' has-error' : '' }}">
                            {{ Form::label('sub_county_id', 'Sub County', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-sm-9">
                                {{ Form::select('sub_county_id', $subCounties, null, ["class" => "form-control", "placeholder" => "Sub County"]) }}
                                @if ($errors->has('sub_county_id'))
                                    <span class="text-danger help-block">
                                        <strong>{{ $errors->first('sub_county_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                            {{ Form::label('longitude', 'Longitude', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-sm-9">                        
                                {{ Form::text('longitude', null, ["class" => "form-control", "placeholder" => "Longitude"]) }}
                                @if ($errors->has('longitude'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('longitude') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                            {{ Form::label('latitude', 'Latitude', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-sm-9">                        
                                {{ Form::text('latitude', null, ["class" => "form-control", "placeholder" => "Latitude"]) }}
                                @if ($errors->has('latitude'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('latitude') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection