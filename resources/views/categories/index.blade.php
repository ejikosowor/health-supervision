@extends('layouts.app')

@section('pageheader')
<a class="navbar-brand" href="{{ route('categories.index') }}">Supervision Settings</a>
@endsection

@section('breadcrumbs')
<li class="active">Supervision Categories</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">All Categories</h4>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Category Name</th>
                                <th>No of Questions</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->questions->count() }}</td>
                                    <td><a href="{{ route('categories.show', $category->id) }}" class="btn btn-default btn-xs">Manage/Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="header">New Supervision Category</div>
                <div class="content">
                    {!!	Form::open(['route' => 'categories.store']) !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ Form::text('name', null, ["class" => "form-control", "placeholder" => "Category Name", "rows" => 5]) }}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-fill btn-sm">
                                Add Category
                            </button>
                        </div>
                    {!! Form::close() !!}                        
                </div>
            </div>
            <div class="card">
                <div class="header">New Supervision Area</div>
                <div class="content">
                    {!!	Form::open(['route' => 'areas.store']) !!}
                        <div class="form-group{{ $errors->has('area-name') ? ' has-error' : '' }}">
                            {{ Form::text('area-name', null, ["class" => "form-control", "placeholder" => "Area Name", "rows" => 5]) }}
                            @if ($errors->has('area-name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('area-name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-fill btn-sm">
                                Add Area
                            </button>
                        </div>
                    {!! Form::close() !!}                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection