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
    
    @if(Auth::user()->role_id != 4)
    <div class="text-center">
        <h3>Number of Facilities Sampled (6)</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-plain">
                <div class="header text-center">
                    @php
                        $catLeadership = $categories->where('id', 1)->first();
                    @endphp
                    <h4 class="title"><span class="label label-danger">{{ $catLeadership->name }}</span></h4>
                </div>
                <div class="content" id="cardLeadershipContent">
                    @include('home.partials._leadership')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-plain">
                <div class="header text-center">
                    @php
                        $catMaternity = $categories->where('id', 5)->first();
                    @endphp
                    <h4 class="title"><span class="label label-danger">{{ $catMaternity->name }}</span></h4>
                </div>
                <div class="content" id="cardMaternityContent">
                    <div class="row">
                        @include('home.partials._maternity')
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Maternity Service Provision times/days</h4>
                                </div>
                                <div class="content">
                                    <div id="maternity158" class="ct-chart"></div>
                                    <div class="footer">
                                        <div class="chart-legend">
                                            @php
                                                $weekdays = [];                                    
                                                $holidays = [];                                    
                                                $nights = []; 
                                                
                                                $category5 = $categories->find(5);
                                                $question158 = $category5->questions->find(158);

                                                foreach ($facilities->take(6) as $facility) {
                                                    $supervision = $supervisions->where('supervision_category_id', $category5->id)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                                                    foreach($question158->subQuestions as $key => $subQuestion){
                                                        $transaction = $supervision->transactions->where('question_id', $subQuestion->id)->first();

                                                        if(isset($transaction['answer'])){
                                                            if($transaction['answer'] == 1){
                                                                switch($key):
                                                                    case(0):
                                                                        $weekdays[] = $transaction;
                                                                        break;
                                                                    case(1):
                                                                        $holidays[] = $transaction;
                                                                        break;
                                                                    case(2):
                                                                        $nights[] = $transaction;
                                                                        break;
                                                                endswitch;                 
                                                            }
                                                        }
                                                    }
                                                }
                                            @endphp
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-plain">
                <div class="header text-center">
                    @php
                        $catCWalfare = $categories->where('id', 10)->first();
                    @endphp
                    <h4 class="title"><span class="label label-danger">{{ $catCWalfare->name }}</span></h4>
                </div>
                <div class="content" id="cardCWalfareContent">
                    <div class="row">
                        @include('home.partials._CWalfare')
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Weight Scale, Height Board, and MUAC tape</h4>
                                </div>
                                <div class="content">
                                    <div id="CWalfare346" class="ct-chart"></div>
                                    <div class="footer">
                                        <div class="chart-legend">
                                            @php
                                                $weighscale = [];                                    
                                                $heightboard = [];                                    
                                                $muactape = []; 
                                                
                                                $category10 = $categories->find(10);
                                                $question346 = $category10->questions->find(346);

                                                foreach ($facilities->take(6) as $facility) {
                                                    $supervision = $supervisions->where('supervision_category_id', $category10->id)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                                                    foreach($question346->subQuestions as $key => $subQuestion){
                                                        $transaction = $supervision->transactions->where('question_id', $subQuestion->id)->first();

                                                        if(isset($transaction['answer'])){
                                                            if($transaction['answer'] == 1){
                                                                switch($key):
                                                                    case(0):
                                                                        $weighscale[] = $transaction;
                                                                        break;
                                                                    case(1):
                                                                        $heightboard[] = $transaction;
                                                                        break;
                                                                    case(2):
                                                                        $muactape[] = $transaction;
                                                                        break;
                                                                endswitch;                 
                                                            }
                                                        }
                                                    }
                                                }
                                            @endphp
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-plain">
                <div class="header text-center">
                    @php
                        $catAnc = $categories->where('id', 2)->first();
                    @endphp
                    <h4 class="title"><span class="label label-danger">{{ $catAnc->name }}</span></h4>
                </div>
                <div class="content" id="cardAncContent">
                    @include('home.partials._anc')
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Weight Scale, Height Board, and MUAC tape</h4>
                            </div>
                            <div class="content">
                                <div id="ANC99" class="ct-chart"></div>
                                <div class="footer">
                                    <div class="chart-legend">
                                        @php
                                            $hiv = [];                                    
                                            $urine = [];                                    
                                            $blgrp = [];                                    
                                            $hb = [];                                    
                                            $syphilis = []; 
                                            
                                            $category2 = $categories->find(2);
                                            $question99 = $category2->questions->find(99);

                                            foreach ($facilities->take(6) as $facility) {
                                                $supervision = $supervisions->where('supervision_category_id', $category2->id)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                                                if(isset($supervision)){
                                                    foreach($question99->subQuestions as $key => $subQuestion){
                                                        $transaction = $supervision->transactions->where('question_id', $subQuestion->id)->first();

                                                        if(isset($transaction['answer'])){
                                                            if($transaction['answer'] == 1){
                                                                switch($key):
                                                                    case(0):
                                                                        $hiv[] = $transaction;
                                                                        break;
                                                                    case(1):
                                                                        $urine[] = $transaction;
                                                                        break;
                                                                    case(2):
                                                                        $blgrp[] = $transaction;
                                                                        break;
                                                                    case(3):
                                                                        $hb[] = $transaction;
                                                                        break;
                                                                    case(4):
                                                                        $syphilis[] = $transaction;
                                                                        break;
                                                                endswitch;                 
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
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

        //Maternity158
        new Chartist.Bar('#maternity158', {
            labels: [
                @foreach($question158->subQuestions as $subQuestion)
                    "{{ $subQuestion->question }}",
                @endforeach
            ],
            series: [
                @foreach($question158->subQuestions as $key => $subQuestion)
                    @switch($key)
                        @case(0)
                            "{{ count($weekdays) }}",
                            @break;
                        @case(1)
                            "{{ count($holidays) }}",
                            @break;
                        @case(2)
                            "{{ count($nights) }}",
                            @break;
                    @endswitch
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

        //CWalfare346
        new Chartist.Bar('#CWalfare346', {
            labels: [
                @foreach($question346->subQuestions as $subQuestion)
                    "{{ $subQuestion->question }}",
                @endforeach
            ],
            series: [
                @foreach($question346->subQuestions as $key => $subQuestion)
                    @switch($key)
                        @case(0)
                            "{{ count($weighscale) }}",
                            @break;
                        @case(1)
                            "{{ count($heightboard) }}",
                            @break;
                        @case(2)
                            "{{ count($muactape) }}",
                            @break;
                    @endswitch
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

        //ANC99
        new Chartist.Bar('#ANC99', {
            labels: [
                @foreach($question99->subQuestions as $subQuestion)
                    "{{ $subQuestion->question }}",
                @endforeach
            ],
            series: [
                @foreach($question99->subQuestions as $key => $subQuestion)
                    @switch($key)
                        @case(0)
                            "{{ count($hiv) }}",
                            @break;
                        @case(1)
                            "{{ count($urine) }}",
                            @break;
                        @case(2)
                            "{{ count($blgrp) }}",
                            @break;
                        @case(3)
                            "{{ count($hb) }}",
                            @break;
                        @case(4)
                            "{{ count($syphilis) }}",
                            @break;
                    @endswitch
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