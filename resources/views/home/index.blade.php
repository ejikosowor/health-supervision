@extends('layouts.app')

@section('headersheets')
<style>
    .card .numbers a {
        /* font-size: 24px;
        line-height: 1.4em; */
    }
/*    .ct-series-a .ct-slice-pie {
        fill: #228B22;
    }
    .ct-series-b .ct-slice-pie {
        fill: #FF0000;
    }*/

    #cardLeadershipContent, #cardAncContent, #cardCWalfareContent, #cardMaternityContent {
        padding-left: 0px;
        padding-right: 0px;
    }
    #cardLeadershipContent .numbers, #cardAncContent .numbers, #cardMaternityContent .numbers, #cardCWalfareContent .numbers {
        text-align: center;
    }
</style>
@endsection

@section('pageheader')
<a class="navbar-brand" href="{{ route('home') }}">Dashboard{{ Auth::user()->role_id == 4 ? " - ".Auth::user()->facility->name : ""}}</a>
@endsection

@section('content')
<div class="container-fluid" id="app">
    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        @include('home.partials._info')
    @endif
    @include('home.partials._supoverview')
</div>
@endsection

@section('footerscripts')
<script>
    @if(Auth::user()->role_id == 4)
        new Chartist.Bar('#supervisionsOverview', {
            labels: [
                @foreach($categories as $category)
                    "{{ str_limit($category->name, 10) }}",
                @endforeach
            ],
            series: [
                @foreach($categories as $category)
                    "{{ $category->supervisions->where('facility_id', Auth::user()->facility->id)->count() }}",
                @endforeach
            ]
        }, {
            distributeSeries: true,
            chartPadding: {
                top: 11,
                right: 0,
                bottom: 0,
                left: 0
            },
            axisY: {
                onlyInteger: true
            }
        });
    @else
        //Supervision Overview Bar Chart
        new Chartist.Bar('#supervisionsOverview', {
            labels: [
                @foreach($categories as $category)
                    "{{ str_limit($category->name, 10) }}",
                @endforeach
            ],
            series: [
                @foreach($categories as $category)
                    "{{ $category->supervisions->count() }}",
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
    @endif
</script>
@endsection
