@extends('layouts.app')

@section('pageheader')
<a class="navbar-brand" href="{{ route('categories.index') }}">Supervision Settings</a>
@endsection

@section('breadcrumbs')
<li><a href="{{ route('categories.index') }}">Supervision Categories</a></li>
<li><a href="{{ route('categories.show', $question->category->id) }}">{{ $question->category->name }}</a></li>
<li class="active">Edit Question</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="header">Edit Question</div>
                <div class="content">
                    {!!	Form::model($question, ['route' => ['questions.update', $question->category->id, $question->id], 'method' => 'PUT', "class" => "form-horizontal"]) !!}
                        <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                            {{ Form::label('question', 'Question', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-sm-9">                        
                                {{ Form::textarea('question', null, ["class" => "form-control", "placeholder" => "Question", "rows" => 5]) }}
                                @if ($errors->has('question'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('question_type_id') ? ' has-error' : '' }}">
                            {{ Form::label('question_type_id', 'Question Type', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-sm-9">
                                {{ Form::select('question_type_id', $types, null, ["class" => "form-control", "placeholder" => "Question Type", "disabled" => "disabled"]) }}
                                    @if ($errors->has('question_type_id'))
                                        <span class="text-danger help-block">
                                            <strong>{{ $errors->first('question_type_id') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('supervision_area_id') ? ' has-error' : '' }}">
                            {{ Form::label('supervision_area_id', 'Question Area', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-sm-9">
                                {{ Form::select('supervision_area_id', $areas, null, ["class" => "form-control", "placeholder" => "Question Area"]) }}
                                @if ($errors->has('supervision_area_id'))
                                    <span class="text-danger help-block">
                                        <strong>{{ $errors->first('supervision_area_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-fill btn-sm">
                                    Update Question
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        @if($question->question_type_id == 4)
            <div class="col-md-4">
                <div class="card">
                    <div class="header">Add Sub-Question</div>
                    <div class="content">
                        {!!	Form::open(['route' => ['sub-question.store', $question->category->id]]) !!}
                            {{ Form::hidden('parent_id', $question->id, ["class" => "form-control"]) }}
                            <div class="form-group{{ $errors->has('sub_question') ? ' has-error' : '' }}">
                                {{ Form::label('sub_question', 'Question', ['class' => 'control-label']) }}
                                {{ Form::textarea('sub_question', null, ["class" => "form-control", "placeholder" => "Question", "rows" => 5]) }}
                                    @if ($errors->has('sub_question'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('sub_question') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('sub_question_type_id') ? ' has-error' : '' }}">
                                {{ Form::label('sub_question_type_id', 'Question Type', ['class' => 'control-label']) }}
                                {{ Form::select('sub_question_type_id', $types, null, ["class" => "form-control", "placeholder" => "Question Type"]) }}
                                    @if ($errors->has('sub_question_type_id'))
                                        <span class="text-danger help-block">
                                            <strong>{{ $errors->first('sub_question_type_id') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('sub_supervision_area_id') ? ' has-error' : '' }}">
                                {{ Form::label('sub_supervision_area_id', 'Question Area', ['class' => 'control-label']) }}
                                {{ Form::select('sub_supervision_area_id', $areas, null, ["class" => "form-control", "placeholder" => "Question Area"]) }}
                                    @if ($errors->has('sub_supervision_area_id'))
                                        <span class="text-danger help-block">
                                            <strong>{{ $errors->first('sub_supervision_area_id') }}</strong>
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
        @endif
    </div>
</div>
@endsection