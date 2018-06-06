@extends('layouts.app')

@section('pageheader')
<a class="navbar-brand" href="{{ route('categories.index') }}">Online Supervisions{{ Auth::user()->role_id == 4 ? " - ".Auth::user()->facility->name : ""}}</a>
@endsection

@section('breadcrumbs')
<li><a href="{{ route('online-supervisions.index') }}">Online Supervisions</a></li>
<li class="active">{{ $supervision->category->name }}</li>
@endsection

@section('headersheets')
<style>
    .subquestion {
        font-style: italic;
    }
    .ct-series-a .ct-slice-pie {
        fill: #228B22;
    }
    .ct-series-b .ct-slice-pie {
        fill: #FF0000;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">{{ $supervision->category->name }}</h4> 
                    <p class="category">{{ date('M j, Y g:ia', strtotime($supervision->created_at)) }}</p>
                    <a href="{{ route('supervision.download', $supervision->id) }}" class="btn btn-xs btn-fill btn-info pull-right">
                        <span class="btn-label">
                            <i class="fa fa-cloud-download"></i>
                        </span>
                        Download
                    </a>
                </div>
                <div class="content table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Question</th>
                                <th>Response</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $current_iteration; @endphp
                        @foreach($supervision->category->questions->where('parent_id', null) as $key=>$question)
                            @php $answer = $transactions->where('question_id', $question->id)->first() @endphp                            
                            @switch($question->question_type_id)
                                @case(1)
                                    <tr>
                                        @if(isset($current_iteration))
                                            @if($current_iteration - $loop->iteration == -1)
                                                <td>{{ $current_iteration }}</td>
                                            @else
                                                <td>{{ $current_iteration + 1 }}</td>
                                                @php $current_iteration++ ; @endphp
                                            @endif                                                    
                                        @else
                                            <td>{{ $loop->iteration }}</td>
                                        @endif
                                        <td>{{ $question->question }}</td>
                                        <td>
                                            @if(isset($answer['answer']))
                                                @if($answer['answer'] == 1)
                                                    <span class="label label-success">Yes</span>
                                                @else
                                                    <span class="label label-danger">No</span>                                                    
                                                @endif                                                                                                                
                                            @else
                                                <span class="label label-default">Not Answered</span>                                                            
                                            @endif
                                        </td>
                                    </tr>
                                    @break
                                
                                @case(3)
                                    <tr>
                                        @if(isset($current_iteration))
                                            @if($current_iteration - $loop->iteration == -1)
                                                <td>{{ $current_iteration }}</td>
                                            @else
                                                <td>{{ $current_iteration + 1 }}</td>
                                                @php $current_iteration++ ; @endphp
                                            @endif                                                    
                                        @else
                                            <td>{{ $loop->iteration }}</td>
                                        @endif
                                        <td>{{ $question->question }}</td>
                                        <td>
                                            @if(isset($answer['answer']))
                                                <span class="label label-default">{{ $answer['answer'] }}</span>
                                            @else
                                                <span class="label label-default">Not Answered</span>                                                
                                            @endif
                                        </td>
                                    </tr>
                                    @break

                                @case(4)
                                    <tr>
                                        @if(isset($current_iteration))
                                            @if($current_iteration - $loop->iteration == -1)
                                                <td>{{ $current_iteration }}</td>
                                            @else
                                                <td>{{ $current_iteration + 1 }}</td>
                                                @php $current_iteration++ ; @endphp
                                            @endif                                                    
                                        @else
                                            <td>{{ $loop->iteration }}</td>
                                        @endif
                                        <td><strong>{{ $question->question }}</strong></td>
                                        <td></td>                              
                                    </tr>
                                        @if($question->subQuestions->count() > 0)
                                            @foreach($question->subQuestions as $subquestion)
                                                @php $subanswer = $transactions->where('question_id', $subquestion->id)->first() @endphp
                                                @switch($subquestion->question_type_id)
                                                    @case(1)
                                                        <tr>
                                                            <td></td>
                                                            <td class="subquestion">{{ $subquestion->question }}</td>
                                                            <td>
                                                                @if(isset($subanswer['answer']))
                                                                    @if($subanswer['answer'] == 1)
                                                                        <span class="label label-success">Yes</span>
                                                                    @else
                                                                        <span class="label label-danger">No</span>                                                    
                                                                    @endif                                                                                                                
                                                                @else
                                                                    <span class="label label-default">Not Answered</span>                                                            
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @break

                                                    @case(2)
                                                        <tr>
                                                            <td></td>
                                                            <td class="subquestion">{{ $subquestion->question }}</td>
                                                            <td>
                                                                @if(isset($subanswer['answer']))
                                                                    <span class="label label-success">Yes</span>                                                                                                                
                                                                @else
                                                                    <span class="label label-default">Not Answered</span>                                                            
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @break

                                                    @case(3)
                                                        <tr>
                                                            <td></td>
                                                            <td class="subquestion">{{ $subquestion->question }}</td>
                                                            <td>
                                                                @if(isset($subanswer['answer']))
                                                                    <span class="label label-default">{{ $subanswer['answer'] }}</span>
                                                                @else
                                                                    <span class="label label-default">Not Answered</span>                                                
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @break

                                                    @case(5)
                                                        <tr>
                                                            <td></td>
                                                            <td class="subquestion"><strong>{{ $subquestion->question }}</strong></td>
                                                            <td></td>
                                                        </tr>
                                                        @break
                                                @endswitch
                                            @endforeach
                                        @endif
                                    @break
                                
                                @case(5)
                                    @if(!isset($current_iteration))
                                        @php $current_iteration = $loop->iteration; @endphp
                                    @endif
                                    <tr>
                                        <td colspan="3"><strong>{{ $question->question }}</strong></td>
                                    </tr>
                                    @break
                                    
                                @default
                                    Default case...
                            @endswitch
                        @endforeach
                        </tbody>
                    </table>     
                </div>
            </div>
        </div>      
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h5 class="title"><strong>{{ $supervision->category->name }} Response Chart</strong></h5>
                        </div>
                        <div class="content">
                            <div id="supervision-cat-chart" class="ct-chart"></div>
                            <div class="footer">
                                <div class="chart-legend">
                                    @php
                                        $radioQuestions = $supervision->category->questions->where('question_type_id', 1);
                                        $yesAnswers = [];                                    
                                        $noAnswers = [];                                    
                                        foreach($radioQuestions as $radioQuestion){
                                            $ranswer = $transactions->where('question_id', $radioQuestion->id)->first();
                                            if(isset($ranswer['answer'])){
                                                if($ranswer['answer'] == 1){
                                                    $yesAnswers[] = $ranswer;                                                    
                                                } else {
                                                    $noAnswers[] = $ranswer;
                                                }
                                            }
                                        }
                                    @endphp
                                    <i class="fa fa-circle text-success"></i>Yes ({{ count($yesAnswers) }})
                                    <i class="fa fa-circle text-danger"></i>No ({{ count($noAnswers) }})
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h5 class="title"><strong>Supervision Team</strong></h5>
                        </div>
                        @if($supervision->collaborators->count() > 0)
                            <div class="content table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        @foreach ($supervision->collaborators as $key => $collaborator)
                                            <tr>
                                                <td>{{ $collaborator->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="content">
                                Sorry!! Supervision has no team Members!!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
@endsection

@section('footerscripts')
<script>
    var data = {
        series: [
            {{ count($yesAnswers) }}, 
            {{ count($noAnswers) }}
        ]
    };

    var sum = function(a, b) { return a + b };

    new Chartist.Pie('#supervision-cat-chart', data, {
    labelInterpolationFnc: function(value) {
        return Math.round(value / data.series.reduce(sum) * 100) + '%';
    }
    });
</script>
@endsection