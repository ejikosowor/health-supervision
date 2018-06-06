@extends('layouts.app')

@section('pageheader')
<a class="navbar-brand" href="{{ route('categories.index') }}">Supervisions</a>
@endsection

@section('breadcrumbs')
<li class="active">Supervisions</li>
@endsection

@section('content')
<div class="container-fluid" id="app">
    <div class="row">
        <div class="col-md-12">
            <supervisions :supervisions="{{ $supervisions }}"></supervisions>
        </div>
    </div>
</div>
@endsection