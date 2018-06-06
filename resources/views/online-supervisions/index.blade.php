@extends('layouts.app')

@section('pageheader')
<a class="navbar-brand" href="{{ route('online-supervisions.index') }}">Online Supervisions{{ Auth::user()->role_id == 4 ? " - ".Auth::user()->facility->name : ""}}</a>
@endsection

@section('breadcrumbs')
<li class="active">Online Supervisions</li>
@endsection

@section('content')
<div class="container-fluid" id="app">
    <div class="row">
        <div class="col-md-12">
            @if (Auth::user()->hasRole(4) && Auth::user()->facility_id == null )
                <div class="alert alert-danger">
                    You are not assiged to a health facility
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <online-supervisions :supervisions="{{ $supervisions }}"></online-supervisions>
        </div>
        <div class="col-md-4">
            <start-supervision :categories="{{ $categories }}"></start-supervision>
        </div>
    </div>
</div>
@endsection