@extends('layouts.app')

@section('pageheader')
<a class="navbar-brand" href="{{ route('counties.index') }}">Counties</a>
@endsection

@section('breadcrumbs')
<li class="active">Counties</li>
@endsection

@section('content')
<div class="container-fluid" id="app">
    <div class="row">
        <div class="col-md-12">
        	<div class="card">
		        <div class="header">
		            <h4 class="title">All Facilities</h4>
		        </div>
		        <div class="content table-responsive">
		            <table class="table table-striped table-no-bordered table-hover">
		            	<thead>
			            	<tr>
			            		<td>S/N</td>
			            		<td>County</td>
			            		<td></td>
			            	</tr>
			            </thead>
			            <tbody>
		            	@foreach($counties as $key => $county)
		            		<tr>
		            			<td>{{ $counties->count() - $key }}</td>
		            			<td>{{ $county->name }}</td>
		            			<td><a href="{{ route('counties.show', $county->id) }}" class="btn btn-default btn-xs">View</a></td>
		            		</tr>
		            	@endforeach
		            	</tbody>
		            </table>
		        </div>
		    </div>
        </div>
    </div>
</div>
@endsection