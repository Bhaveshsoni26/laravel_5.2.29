@extends('layouts.admin')

@section('content')

    <h1 class="page-header">Create Posts</h1> 

    {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true]) !!}

    <div class='form-group {{ $errors->has('title')?' has-error ':'' }}'>
        {!! Form::label('title', 'Title ') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
        @if ($errors->has('title'))
            <span class="error">{{ $errors->first('title') }}</span>
        @endif
    </div>

    <div class='form-group {{ $errors->has('category_id')?' has-error ':'' }}'>
        {!! Form::label('category_id', 'Category ') !!}
        {!! Form::select('category_id', array(''=>'Choose Categories') , null, ['class'=>'form-control']) !!}
        @if ($errors->has('category_id'))
            <span class="error">{{ $errors->first('category_id') }}</span>
        @endif
    </div>

    <div class='form-group {{ $errors->has('photo_id')?' has-error ':'' }}'>
        {!! Form::label('photo_id', 'Photo ') !!}
        {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
        @if ($errors->has('photo_id'))
            <span class="error">{{ $errors->first('photo_id') }}</span>
        @endif
    </div>

    <div class='form-group {{ $errors->has('body')?' has-error ':'' }}'>
        {!! Form::label('body', 'Description ') !!}
        {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>8]) !!}
        @if ($errors->has('body'))
            <span class="error">{{ $errors->first('body') }}</span>
        @endif
    </div>

    <div class='form-group'>
        {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

@endsection