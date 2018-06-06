@extends('layouts.app')

@section('pageheader')
<a class="navbar-brand" href="{{ route('categories.index') }}">Supervision Categories</a>
@endsection

@section('breadcrumbs')
<li><a href="{{ route('categories.index') }}">Supervision Categories</a></li>
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
        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">All Questions</h4>
                </div>
                <div class="content table-responsive">
                    @if($category->questions->count() > 0)
                        <table class="table table-no-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Question</th>
                                    <th>Area</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $current_iteration; @endphp
                                @foreach($category->questions->where('parent_id', null) as $key=>$question)
                                    @switch($question->question_type_id)
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
                                                @if($question->supervision_area_id != null)
                                                    <td><strong>{{ $question->area->name }}</strong></td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td><a href="{{ route('questions.edit', ['category' => $category->id, 'question' => $question->id]) }}" class="btn btn-default btn-xs">Edit</a></td>                                
                                            </tr>
                                                @if($question->subQuestions->count() > 0)
                                                    @foreach($question->subQuestions as $subquestion)
                                                        @if($subquestion->question_type_id == 5)
                                                            <tr>
                                                                <td></td>
                                                                <td class="subquestion"><strong>{{ $subquestion->question }}</strong></td>
                                                                @if($subquestion->supervision_area_id != null)
                                                                    <td>{{ $subquestion->area->name }}</td>
                                                                @else
                                                                    <td></td>
                                                                @endif
                                                                <td><a href="{{ route('questions.edit', ['category' => $category->id, 'question' => $subquestion->id]) }}" class="btn btn-default btn-xs">Edit</a></td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td></td>
                                                                <td class="subquestion">{{ $subquestion->question }}</td>
                                                                @if($subquestion->supervision_area_id != null)
                                                                    <td>{{ $subquestion->area->name }}</td>
                                                                @else
                                                                    <td></td>
                                                                @endif
                                                                <td><a href="{{ route('questions.edit', ['category' => $category->id, 'question' => $subquestion->id]) }}" class="btn btn-default btn-xs">Edit</a></td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @break
                                        
                                        @case(5)
                                            @if(!isset($current_iteration))
                                                @php $current_iteration = $loop->iteration; @endphp
                                            @endif
                                            <tr>
                                                <td colspan="2"><strong>{{ $question->question }}</strong></td>
                                                @if($question->supervision_area_id != null)
                                                    <td>{{ $question->area->name }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td><a href="{{ route('questions.edit', ['category' => $category->id, 'question' => $question->id]) }}" class="btn btn-default btn-xs">Edit</a></td>                                
                                            </tr>
                                            @break
                                            
                                        @default
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
                                                @if($question->supervision_area_id != null)
                                                    <td>{{ $question->area->name }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td><a href="{{ route('questions.edit', ['category' => $category->id, 'question' => $question->id]) }}" class="btn btn-default btn-xs">Edit</a></td>                                
                                            </tr>
                                    @endswitch
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        Sorry! No Questions have been added
                    @endif
                </div>                    
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="header">Add Question</div>
                <div class="content">
                    {!!	Form::open(['route' => ['questions.store', $category->id]]) !!}
                        <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                            {{ Form::label('question', 'Question', ['class' => 'control-label']) }}
                            {{ Form::textarea('question', null, ["class" => "form-control", "placeholder" => "Question", "rows" => 5]) }}
                                @if ($errors->has('question'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('question_type_id') ? ' has-error' : '' }}">
                            {{ Form::label('question_type_id', 'Question Type', ['class' => 'control-label']) }}
                            {{ Form::select('question_type_id', $types, null, ["class" => "form-control", "placeholder" => "Question Type"]) }}
                                @if ($errors->has('question_type_id'))
                                    <span class="text-danger help-block">
                                        <strong>{{ $errors->first('question_type_id') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('supervision_area_id') ? ' has-error' : '' }}">
                            {{ Form::label('supervision_area_id', 'Question Area', ['class' => 'control-label']) }}
                            {{ Form::select('supervision_area_id', $areas, null, ["class" => "form-control", "placeholder" => "Question Area"]) }}
                                @if ($errors->has('supervision_area_id'))
                                    <span class="text-danger help-block">
                                        <strong>{{ $errors->first('supervision_area_id') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-fill btn-sm">
                                Add Question
                            </button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection