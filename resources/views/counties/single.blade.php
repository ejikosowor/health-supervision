@extends('layouts.app')

@section('pageheader')
<a class="navbar-brand" href="{{ route('counties.index') }}">Counties</a>
@endsection

@section('breadcrumbs')
<li><a href="{{ route('counties.index') }}">Counties</a></li>
<li class="active">{{ $county->name }}</li>
@endsection

@section('content')
<div class="container-fluid" id="app">
	@php
		$categorySupervisions;

		foreach($categories as $key => $category){
			
			$supCount;

			foreach ($county->facilities as $subkey => $facility) {
				$sups = $facility->supervisions->where('supervision_category_id', $category->id)->count();

				$supCount[] = new \StdClass;
				$supCount[$subkey] = $sups;
			}

			$categorySupervisions[] = new \StdClass;
            $categorySupervisions[$key] = (isset($supCount)) ? array_sum($supCount) : 0;
		}
	@endphp

	@include('home.partials._supoverview')
    <div class="row">
        <div class="col-md-12">
        	<div class="card">
		        <div class="header">
		            <h4 class="title">Sub Counties</h4>
		        </div>
		        <div class="content table-responsive">
		            <table class="table table-striped table-no-bordered table-hover">
		            	<thead>
			            	<tr>
			            		<td>S/N</td>
			            		<td>Name</td>
			            		<td></td>
			            	</tr>
			            </thead>
			            <tbody>
			            @if($county->subcounties->count() > 0)
			            	@foreach($county->subcounties as $key => $subcounty)
			            		<tr>
			            			<td>{{ $key + 1 }}</td>
			            			<td>{{ $subcounty->name }}</td>
			            			<td><a href="{{ route('subcounty.show', ['county' => $county->id, 'subcounty' => $subcounty->id]) }}" class="btn btn-default btn-xs">View Facilities</a></td>
			            		</tr>
			            	@endforeach
			            @else
			            	<tr>
			            		<td colspan="3" class="text-center">Sorry!! There are no sub counties here.</td>
			            	</tr>
			            @endif
		            	</tbody>
		            </table>
		        </div>
		    </div>
        </div>
    </div>
</div>
@endsection

@section('footerscripts')
<script>
	new Chartist.Bar('#supervisionsOverview', {
	    labels: [
	        @foreach($categories as $category)
	            "{{ str_limit($category->name, 10) }}",
	        @endforeach
	    ],
	    series: [
	        @foreach($categories as $key => $category)
	            "{{ $categorySupervisions[$key] }}",
	        @endforeach
	    ]
	}, {
	    distributeSeries: true,
	    chartPadding: {
	        top: 15,
	        right: 0,
	        bottom: 0,
	        left: 0
	    },
	    axisY: {
	        onlyInteger: true
	    }
	});
</script>
@endsection