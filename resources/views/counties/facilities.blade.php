@extends('layouts.app')

@section('pageheader')
<a class="navbar-brand" href="{{ route('counties.index') }}">Counties</a>
@endsection

@section('breadcrumbs')
<li><a href="{{ route('counties.index') }}">Counties</a></li>
<li><a href="{{ route('counties.show', $subCounty->county->id) }}">{{ $subCounty->county->name }}</a></li>
<li>{{ $subCounty->name }}</li>
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