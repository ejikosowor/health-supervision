@extends('layouts.app')

@section('headersheets')
<script src="https://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
<style>
    #map-canvas {
        margin: 0;
        padding: 0;
        height: 400px;
        max-width: none;
    }
    #map-canvas img {
        max-width: none !important;
    }
    .bg-success, .label-success {
        background-color: #228B22;
    }
    .bg-danger, .label-danger {
        background-color: #FF0000;
    }
    .bg-warning, .label-warning {
        background-color: #FFFF66;
    }
    #maternityChart .ct-series-b .ct-bar:nth-child(2) {
        stroke: #f05b4f;
    }
    #maternityChart .ct-series-b .ct-bar:nth-child(3) {
        stroke: #7AC29A;
    }
    dl {
        margin-bottom: 0;
    }
</style>
@endsection

@section('pageheader')
<a class="navbar-brand" href="{{ route('facilities.index') }}">Facilities</a>
@endsection

@section('breadcrumbs')
<li><a href="{{ route('facilities.index') }}">Facilities</a></li>
<li><a href="{{ route('facilities.show', $facility->id) }}">{{ $facility->name }}<a/></li>
<li class="active">Analytics</li>
@endsection

@section('content')
<div class="container-fluid" id="app">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-plain">
                <div class="header text-center">
                    <h4 class="title">
                        <span class="label label-danger">Summary By Category</span>
                    </h4>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Code</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categories as $key => $category)
                                                @php
                                                    $score = 0;

                                                    $catQuestions = $category->questions->where('question_type_id', 1);

                                                    $supervision = $supervisions->where('supervision_category_id', $category->id)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                                                    if(isset($supervision)){

                                                        foreach($catQuestions as $key => $catQuestion){
                                                            $transaction = $supervision->transactions->where('question_id', $catQuestion->id)->first();

                                                            if(isset($transaction->answer)){
                                                                $score += $transaction->answer;
                                                            }
                                                        }
                                                    }

                                                    if($score != 0 && $catQuestions->count() != 0){
                                                        $per = round($score/$catQuestions->count()*100);
                                                    } else {
                                                        $per = 1;
                                                    }

                                                @endphp
                                                <tr>
                                                    <td>{{ $category->name }}</td>
                                                    <td>
                                                        @switch($per)
                                                            @case($per == 75 || $per > 75)
                                                                <span class="label label-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                            @break

                                                            @case($per < 50)
                                                                <span class="label label-danger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                            @break

                                                            @case($per == 50 || ($per > 50 && $per < 75))
                                                                <span class="label label-warning">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td><strong><span>{{ $per.'%' }}</span></strong>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="footer">
                                        <div class="chart-legend">
                                            <i class="fa fa-circle text-success"></i> &#8805; 75% <br>
                                            <i class="fa fa-circle text-warning"></i> &#8805; 50% &#60; 75% <br>
                                            <i class="fa fa-circle text-danger"></i> &#60; 50%
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
                        $catHRH = $categories->where('id', 9)->first();
                    @endphp
                    <h4 class="title">
                        <span class="label label-danger">Neonatal Ressuscitation</span>
                    </h4>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="card" >
                                <div class="header">
                                    @php
                                        $q1;
                                        $seriesLabel = ['EmONC', 'MPDSR', 'HBB'];
                                        $questions1 = [71, 75, 79];
                                        $questions2 = [72, 76, 80];
                                        $seriesOne;
                                        $seriesTwo;

                                        $supervision = $supervisions->where('supervision_category_id', 9)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                                        if(isset($supervision)){
                                            foreach ($questions1 as $key => $question) {
                                                $transaction = $supervision->transactions->where('question_id', $question)->first();

                                                if(isset($transaction->answer)){
                                                    $seriesOne[] = new \StdClass;
                                                    $seriesOne[$key] = $transaction->answer;
                                                } else {
                                                    $seriesOne[] = new \StdClass;
                                                    $seriesOne[$key] = null;
                                                }
                                            }

                                            foreach ($questions2 as $key => $question) {
                                                $transaction = $supervision->transactions->where('question_id', $question)->first();

                                                if(isset($transaction->answer)){
                                                    $seriesTwo[] = new \StdClass;
                                                    $seriesTwo[$key] = $transaction->answer;
                                                } else {
                                                    $seriesTwo[] = new \StdClass;
                                                    $seriesTwo[$key] = null;
                                                }
                                            }
                                            $q1 = $transaction = $supervision->transactions->where('question_id', 70)->first();

                                        }
                                    @endphp
                                    <h4 class="title">Total number of clinical staff working in MCH and maternity <b>({{ (isset($q1->answer)) ? $q1->answer : 0 }})</b></h4>
                                </div>
                                <div class="content">
                                    <div id="EmONCCHart" class="ct-chart"></div>
                                    <div class="footer">
                                        <div class="chart-legend">
                                            <i class="fa fa-circle text-info"></i>Number ever trained
                                            <i class="fa fa-circle text-warning"></i>Number refreshed in the last 12 months
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="card">
                                <div class="header">
                                    <h3 class="title">% of Clinical Staff trained</h3>
                                </div>
                                <div class="content">
                                    <dl class="dl-horizontal">
                                    @foreach($seriesLabel as $key => $series)
                                        @php
                                            if($seriesOne[$key] != 0 && $seriesTwo[$key] != 0){
                                                $per = round($seriesTwo[$key]/$seriesOne[$key]*100);
                                            } else {
                                                $per = 1;
                                            }
                                        @endphp
                                        @switch($per)
                                            @case($per == 75 || $per > 75)
                                                <dt><span class="label label-success">&nbsp;&nbsp;&nbsp;&nbsp;</span></dt><dd>{{ $series }} - {{ $per }}%</dd><br/>
                                            @break

                                            @case($per < 50)
                                                <dt><span class="label label-danger">&nbsp;&nbsp;&nbsp;&nbsp;</span></dt><dd>{{ $series }} - {{ $per }}%</dd>
                                            @break

                                            @case($per == 50 || ($per > 50 && $per < 75))
                                                <dt><span class="label label-warning">&nbsp;&nbsp;&nbsp;&nbsp;</span></dt><dd>{{ $series }} - {{ $per }}%</dd>
                                            @break
                                        @endswitch
                                    @endforeach
                                    </dl>
                                    <div class="footer">
                                        <div class="chart-legend">
                                            <i class="fa fa-circle text-success"></i> &#8805; 75% <br>
                                            <i class="fa fa-circle text-warning"></i> &#8805; 50% &#60; 75% <br>
                                            <i class="fa fa-circle text-danger"></i> &#60; 50%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="card">
                                <div class="header">
                                    @php
                                        $question = $questions->find(212);
                                        $subquestions;

                                        $supervision = $supervisions->where('supervision_category_id', 5)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                                        if(isset($supervision)){
                                            foreach ($question->subQuestions->take(8) as $key => $subQuestion) {
                                                $transaction = $supervision->transactions->where('question_id', $subQuestion->id)->first();

                                                if(isset($transaction)){
                                                    $subquestions[] = new \StdClass;
                                                    $subquestions[$key] = $transaction->answer;
                                                } else {
                                                    $subquestions[] = new \StdClass;
                                                    $subquestions[$key] = null;
                                                }
                                            }
                                        }
                                    @endphp
                                    <h4 class="title">Availability of the following neonatal & maternal resuscitation items</h4>
                                </div>
                                <div class="content">
                                    <dl class="dl-horizontal">
                                        @foreach ($question->subQuestions->take(8) as $key => $subQuestion)
                                            @switch($subquestions[$key])
                                                @case(1)
                                                    <dt><span class="label label-success">&nbsp;&nbsp;&nbsp;&nbsp;</span></dt><dd>{{ $subQuestion->question }}</dd><br>
                                                @break

                                                @case(0)
                                                    <dt><span class="label label-danger">&nbsp;&nbsp;&nbsp;&nbsp;</span></dt><dd>{{ $subQuestion->question }}</dd><br>
                                                @break
                                            @endswitch
                                        @endforeach
                                    </dl>
                                    <div class="footer">
                                        <div class="chart-legend">
                                            <i class="fa fa-circle text-success"></i> Yes
                                            <i class="fa fa-circle text-danger"></i> No
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="card" >
                                <div class="header">
                                    @php
                                        $seriesSetLabel = ['Neonatal Deaths', 'Still Births', 'Babies Born Alive'];
                                        $questionsSet1 = [275, 277, 279];
                                        $questionsSet2 = [276, 278, 280];
                                        $seriesSet1;
                                        $seriesSet2;

                                        $supervision = $supervisions->where('supervision_category_id', 5)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                                        if(isset($supervision)){
                                            foreach ($questionsSet1 as $key => $question) {
                                                $transaction = $supervision->transactions->where('question_id', $question)->first();

                                                if(isset($transaction->answer)){
                                                    $seriesSet1[] = new \StdClass;
                                                    $seriesSet1[$key] = $transaction->answer;
                                                } else {
                                                    $seriesSet1[] = new \StdClass;
                                                    $seriesSet1[$key] = null;
                                                }
                                            }

                                            foreach ($questionsSet2 as $key => $question) {
                                                $transaction = $supervision->transactions->where('question_id', $question)->first();

                                                if(isset($transaction->answer)){
                                                    $seriesSet2[] = new \StdClass;
                                                    $seriesSet2[$key] = $transaction->answer;
                                                } else {
                                                    $seriesSet2[] = new \StdClass;
                                                    $seriesSet2[$key] = null;
                                                }
                                            }
                                        }
                                    @endphp
                                    <h4 class="title">Neonatal Deaths/Still Births/Born Alive</h4>
                                </div>
                                <div class="content">
                                    <div id="maternityChart" class="ct-chart"></div>
                                    <div class="footer">
                                        <div class="chart-legend">
                                            <i class="fa fa-circle text-info"></i>Neonatal deaths, Still Births, Babies Born Alive in the last quarter
                                        </div>
                                        <div class="chart-legend">
                                            <i class="fa fa-circle text-warning"></i>Neonatal deaths occured in the last 24hrs after birth
                                            <i class="fa fa-circle text-danger"></i>No. of Fresh still births
                                            <i class="fa fa-circle text-success"></i>No. Had Birth weight &#62; 2500g
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="card" >
                                <div class="header">
                                    @php
                                        $seriesSet2Label = ['a' , 'b', 'c', 'd', 'e', 'f', 'g'];
                                        $seriesSet2Question = $questions->find(281);
                                        $seriesSet2Answers;

                                        $supervision = $supervisions->where('supervision_category_id', 5)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                                        if(isset($supervision)){
                                            foreach ($seriesSet2Question->subQuestions as $key => $question) {
                                                $transaction = $supervision->transactions->where('question_id', $question->id)->first();

                                                if(isset($transaction->answer)){
                                                    $seriesSet2Answers[] = new \StdClass;
                                                    $seriesSet2Answers[$key] = $transaction->answer;
                                                } else {
                                                    $seriesSet2Answers[] = new \StdClass;
                                                    $seriesSet2Answers[$key] = null;
                                                }
                                            }
                                        }
                                    @endphp
                                    <h4 class="title">Births weighing &#62; 2500g who recieved the following services</h4>
                                </div>
                                <div class="content">
                                    <div id="maternity2Chart" class="ct-chart"></div>
                                    <div class="footer">
                                        <div class="chart-legend">
                                            @foreach ($seriesSet2Question->subQuestions as $key => $question)
                                                <span><i><b>{{ $seriesSet2Label[$key] }}</b></i> - {{ $question->question }}</span><br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Services score for Births weighing &#62; 2500g who recieved the following services</h4>
                                </div>
                                <div class="content">
                                    @php
                                        $sumTotal = 0;

                                        foreach($seriesSet2Answers as $answer){
                                            $sumTotal += $answer;
                                        }
                                    @endphp
                                    <ul>
                                        @foreach ($seriesSet2Question->subQuestions as $key => $question)
                                            <li>{{ $question->question }}</li>
                                        @endforeach
                                    </ul>
                                    @switch($sumTotal)
                                        @case($sumTotal > 55)
                                            <span>Score: </span><span class="label label-success">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                        @break

                                        @case($sumTotal < 55)
                                            <span>Score: </span><span class="label label-danger">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                        @break

                                        @case($sumTotal == 35 || ($per > 35 && $per < 555))
                                            <span>Score: </span><span class="label label-warning">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                        @break
                                    @endswitch
                                    <div class="footer">
                                        <div class="chart-legend">
                                            <i class="fa fa-circle text-success"></i> &#62; 55 <br>
                                            <i class="fa fa-circle text-warning"></i> 35 - 55 <br>
                                            <i class="fa fa-circle text-danger"></i> &#60; 55
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="card">
                                <div class="header">
                                    @php
                                        $questionsset = [185, 223, 232, 238, 242, 243, 244];
                                        $subanswers;

                                        $supervision = $supervisions->where('supervision_category_id', 5)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                                        if(isset($supervision)){
                                            foreach ($questionsset as $key => $subQuestion) {
                                                $transaction = $supervision->transactions->where('question_id', $subQuestion)->first();

                                                if(isset($transaction)){
                                                    $subanswers[] = new \StdClass;
                                                    $subanswers[$key] = $transaction->answer;
                                                } else {
                                                    $subanswers[] = new \StdClass;
                                                    $subanswers[$key] = null;
                                                }
                                            }
                                        }
                                    @endphp
                                    <h4 class="title">More Indicator Analysis questions</h4>
                                </div>
                                <div class="content">
                                    <dl class="dl-horizontal">
                                        @foreach ($questionsset as $key => $subQuestion)
                                            @switch($subanswers[$key])
                                                @case(1)
                                                    <dt><span class="label label-success">&nbsp;&nbsp;&nbsp;&nbsp;</span></dt><dd>{{ $questions->find($subQuestion)->question }}</dd><br>
                                                @break

                                                @case(0)
                                                    <dt><span class="label label-danger">&nbsp;&nbsp;&nbsp;&nbsp;</span></dt><dd>{{ $questions->find($subQuestion)->question }}</dd><br>
                                                @break
                                            @endswitch
                                        @endforeach
                                    </dl>
                                    <div class="footer">
                                        <div class="chart-legend">
                                            <i class="fa fa-circle text-success"></i> Yes
                                            <i class="fa fa-circle text-danger"></i> No
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-plain">
                <div class="header text-center">
                    <h4 class="title">
                        <span class="label label-danger">Manual Vacuum Aspiration</span>
                    </h4>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="card" >
                                <div class="header">
                                    <h4 class="title"></h4>
                                </div>
                                <div class="content">
                                    <dl class="dl-horizontal">
                                        @php
                                            $questionsSet3 = $questions->find([300, 301, 308]);
                                            $PACanswersSet3;

                                            $supervision = $supervisions->where('supervision_category_id', 11)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                                            if(isset($supervision)){
                                                foreach ($questionsSet3 as $key => $subQuestion) {
                                                    $transaction = $supervision->transactions->where('question_id', $subQuestion->id)->first();

                                                    if(isset($transaction)){
                                                        $PACanswersSet3[] = new \StdClass;
                                                        $PACanswersSet3[$key] = $transaction->answer;
                                                    } else {
                                                        $PACanswersSet3[] = new \StdClass;
                                                        $PACanswersSet3[$key] = null;
                                                    }
                                                }
                                            }
                                        @endphp
                                        @foreach ($questionsSet3 as $key => $subQuestion)
                                            @switch($PACanswersSet3[$key])
                                                @case(1)
                                                    <dt><span class="label label-success">&nbsp;&nbsp;&nbsp;&nbsp;</span></dt><dd>{{ $subQuestion->question }}</dd><br>
                                                @break

                                                @case(0)
                                                    <dt><span class="label label-danger">&nbsp;&nbsp;&nbsp;&nbsp;</span></dt><dd>{{ $subQuestion->question }}</dd><br>
                                                @break
                                            @endswitch
                                        @endforeach
                                        @php
                                            $fpafterPAC = $questionsSet3->find(308);
                                            $fpafterPACAnswers;

                                            $supervision = $supervisions->where('supervision_category_id', 11)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                                            if(isset($supervision)){

                                                $transaction = $supervision->transactions->where('question_id', $fpafterPAC->id)->first();

                                                if(isset($transaction)){

                                                    if($transaction->answer == 1){
                                                        $afterPAC1 = $questions->find(309);
                                                        foreach ($afterPAC1->subQuestions as $key => $subQuestion) {
                                                            $transaction = $supervision->transactions->where('question_id', $subQuestion->id)->first();

                                                            if(isset($transaction)){
                                                                $fpafterPACAnswers[] = new \StdClass;
                                                                $fpafterPACAnswers[$key] = $transaction->answer;
                                                            } else {
                                                                $fpafterPACAnswers[] = new \StdClass;
                                                                $fpafterPACAnswers[$key] = null;
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    $fpafterPACAnswers[] = new \StdClass;
                                                    $fpafterPACAnswers[$key] = null;
                                                }
                                            }
                                        @endphp
                                        @if(count($fpafterPACAnswers) > 1)
                                            @php
                                                $afterPAC1 = $questions->find(309);
                                            @endphp
                                            <dt></dt><dd>
                                                <dl class="dl-horizontal">
                                                    @foreach ($afterPAC1->subQuestions as $key => $subQuestion)
                                                        @switch($fpafterPACAnswers[$key])
                                                            @case(1)
                                                                <dt><span class="label label-success">&nbsp;&nbsp;&nbsp;&nbsp;</span></dt><dd>{{ $subQuestion->question }}</dd><br>
                                                            @break

                                                            @case(0)
                                                                <dt><span class="label label-danger">&nbsp;&nbsp;&nbsp;&nbsp;</span></dt><dd>{{ $subQuestion->question }}</dd><br>
                                                            @break
                                                        @endswitch
                                                    @endforeach
                                                </dl>
                                            </dd>
                                        @endif
                                    </dl>
                                    <div class="footer">
                                        <div class="chart-legend">
                                            <i class="fa fa-circle text-success"></i> Yes
                                            <i class="fa fa-circle text-danger"></i> No
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title"></h4>
                                </div>
                                <div class="content">
                                    <h4 class="title">Are the following guidlines available?</h4>
                                    <dl class="dl-horizontal">
                                        @php
                                            $question = $questions->find(302);
                                            $PACsubquestions1;

                                            $supervision = $supervisions->where('supervision_category_id', 11)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                                            if(isset($supervision)){
                                                foreach ($question->subQuestions->take(2) as $key => $subQuestion) {
                                                    $transaction = $supervision->transactions->where('question_id', $subQuestion->id)->first();

                                                    if(isset($transaction)){
                                                        $PACsubquestions1[] = new \StdClass;
                                                        $PACsubquestions1[$key] = $transaction->answer;
                                                    } else {
                                                        $PACsubquestions1[] = new \StdClass;
                                                        $PACsubquestions1[$key] = null;
                                                    }
                                                }
                                            }
                                        @endphp
                                        @foreach ($question->subQuestions->take(2) as $key => $subQuestion)
                                            @switch($PACsubquestions1[$key])
                                                @case(1)
                                                    <dt><span class="label label-success">&nbsp;&nbsp;&nbsp;&nbsp;</span></dt><dd>{{ $subQuestion->question }}</dd><br>
                                                @break

                                                @case(0)
                                                    <dt><span class="label label-danger">&nbsp;&nbsp;&nbsp;&nbsp;</span></dt><dd>{{ $subQuestion->question }}</dd><br>
                                                @break
                                            @endswitch
                                        @endforeach
                                    </dl>
                                    <h4 class="title">Are the following available?</h4>
                                    <dl class="dl-horizontal">
                                        @php
                                            $question = $questions->find(306);
                                            $PACsubquestions1;

                                            $supervision = $supervisions->where('supervision_category_id', 11)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                                            if(isset($supervision)){
                                                foreach ($question->subQuestions as $key => $subQuestion) {
                                                    $transaction = $supervision->transactions->where('question_id', $subQuestion->id)->first();

                                                    if(isset($transaction)){
                                                        $PACsubquestions1[] = new \StdClass;
                                                        $PACsubquestions1[$key] = $transaction->answer;
                                                    } else {
                                                        $PACsubquestions1[] = new \StdClass;
                                                        $PACsubquestions1[$key] = null;
                                                    }
                                                }
                                            }
                                        @endphp
                                        @foreach ($question->subQuestions as $key => $subQuestion)
                                            @switch($PACsubquestions1[$key])
                                                @case(1)
                                                    <dt><span class="label label-success">&nbsp;&nbsp;&nbsp;&nbsp;</span></dt><dd>{{ $subQuestion->question }}</dd><br>
                                                @break

                                                @case(0)
                                                    <dt><span class="label label-danger">&nbsp;&nbsp;&nbsp;&nbsp;</span></dt><dd>{{ $subQuestion->question }}</dd><br>
                                                @break
                                            @endswitch
                                        @endforeach
                                    </dl>
                                    <div class="footer">
                                        <div class="chart-legend">
                                            <i class="fa fa-circle text-success"></i> Yes
                                            <i class="fa fa-circle text-danger"></i> No
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
</div>
@endsection

@section('footerscripts')
<script src="{{ asset('js/chartist-plugins/axis-title/chartist-plugin-axistitle.min.js') }}"></script>
<script>    var data = {
      labels: [
            @foreach($seriesLabel as $series)
                '{{ $series }}',
            @endforeach
        ],
        series: [
        [
            @foreach($seriesOne as $series)
                {{ $series }},
            @endforeach
        ],
        [
            @foreach($seriesTwo as $series)
                {{ $series }},
            @endforeach
        ]
      ]
    };
    var options = {
        seriesBarDistance: 10
    };
    var responsiveOptions = [
      ['screen and (min-width: 641px) and (max-width: 1024px)', {
        seriesBarDistance: 10,
        axisX: {
          labelInterpolationFnc: function (value) {
            return value;
          }
        }
      }],
      ['screen and (max-width: 640px)', {
        seriesBarDistance: 5,
        axisX: {
          labelInterpolationFnc: function (value) {
            return value[0];
          }
        }
      }]
    ];

    new Chartist.Bar('#EmONCCHart', data, options, responsiveOptions);

    var data = {
      labels: [
            @foreach($seriesSetLabel as $series)
                '{{ $series }}',
            @endforeach
        ],
        series: [
        [
            @foreach($seriesSet1 as $series)
                {{ $series }},
            @endforeach
        ],
        [
            @foreach($seriesSet2 as $series)
                {{ $series }},
            @endforeach
        ]
      ]
    };
    var options = {
        seriesBarDistance: 10
    };
    var responsiveOptions = [
      ['screen and (min-width: 641px) and (max-width: 1024px)', {
        seriesBarDistance: 10,
        axisX: {
          labelInterpolationFnc: function (value) {
            return value;
          }
        }
      }],
      ['screen and (max-width: 640px)', {
        seriesBarDistance: 5,
        axisX: {
          labelInterpolationFnc: function (value) {
            return value[0];
          }
        }
      }]
    ];

    new Chartist.Bar('#maternityChart', data, options, responsiveOptions);

    new Chartist.Bar('#maternity2Chart', {
        labels: [
            @foreach($seriesSet2Label as $series)
                "{{ $series }}",
            @endforeach
        ],
        series: [
            @foreach($seriesSet2Answers as $series)
                {{ $series }},
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
</script>
@endsection