@extends('layouts.app')

@section('pageheader')
<a class="navbar-brand" href="{{ route('online-supervisions.index') }}">Online Supervisions{{ Auth::user()->role_id == 4 ? " - ".Auth::user()->facility->name : ""}}</a>
@endsection

@section('breadcrumbs')
<li><a href="{{ route('online-supervisions.index') }}">Online Supervisions</a></li>
<li class="active">{{ $category->name }}</li>
@endsection

@section('headersheets')
<style>
    .subquestion {
        font-style: italic;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Supervision Category - {{ $category->name }}</h4>
                </div>
                <div class="content table-responsive">
                    @if($category->questions->count() > 0)
                        {!!	Form::open(['route' => ['online-supervisions.store', $category->id]]) !!}
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2">Question</th>
                                        <th>Response</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $current_iteration; @endphp
                                    @foreach($category->questions->where('parent_id', null) as $key => $question)
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
                                                        <div class="row">
                                                            <div class="col-xs-6">
                                                                <div class="radio">
                                                                    <input type="radio" name="answers[{{ $question->id }}]" value="1" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <div class="radio">
                                                                    <input type="radio" name="answers[{{ $question->id }}]" value="0" autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>
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
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <input type="number" name="answers[{{ $question->id }}]" class="form-control" placeholder="Response">
                                                            </div>
                                                        </div>
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
                                                    <td colspan="2"><strong>{{ $question->question }}</strong></td>                                                                              
                                                </tr>
                                                @if($question->subQuestions->count() > 0)
                                                    @foreach($question->subQuestions as $subquestion)
                                                        @switch($subquestion->question_type_id)
                                                            @case(1)
                                                                <tr>                
                                                                    <td></td>                                        
                                                                    <td class="subquestion">{{ $subquestion->question }}</td>
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-xs-6">
                                                                                <div class="radio">
                                                                                    <input type="radio" name="answers[{{ $subquestion->id }}]" value="1" autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xs-6">
                                                                                <div class="radio">
                                                                                    <input type="radio" name="answers[{{ $subquestion->id }}]" value="0" autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @break
                                                            
                                                            @case(2)
                                                                <tr>         
                                                                    <td></td>                                               
                                                                    <td class="subquestion">
                                                                        <div class=form-group>
                                                                            <div class="row">
                                                                                <div class="col-sm-1">
                                                                                    <div class="checkbox">
                                                                                        <input name="answers[{{ $subquestion->id }}]" type="checkbox">                                                                            
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-11">
                                                                                    {{ $subquestion->question }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                @break
                                                            @case(3)
                                                                <tr>                     
                                                                    <td></td>                           
                                                                    <td class="subquestion">{{ $subquestion->question }}</td>
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-xs-12">
                                                                                <input type="number" name="answers[{{ $subquestion->id }}]" class="form-control" placeholder="Response">
                                                                            </div>
                                                                        </div>
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
                                        @endswitch
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Submit
                                </button>
                            </div>
                        {!! Form::close() !!} 
                    @else
                        Sorry This Supervison Category has no questions
                    @endif 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection