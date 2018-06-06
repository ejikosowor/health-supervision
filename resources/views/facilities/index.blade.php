@extends('layouts.app')

@section('pageheader')
<a class="navbar-brand" href="{{ route('facilities.index') }}">Facilities</a>
@endsection

@section('breadcrumbs')
<li class="active">Facilities</li>
@endsection

@section('content')
<div class="container-fluid" id="app">
    <div class="row">
        <div class="col-md-12">
            <facilities :facilities="{{ $facilities }}"></facilities>                        
        </div>
    </div>
</div>
@endsection