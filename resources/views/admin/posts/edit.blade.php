@extends('layouts.admin')

@section('content')

<h1 class="page-header">Edit Posts</h1>

<div class="row">
        <div class="post-pic-div text-center">
            <img height="300" width="400" src="{{ $posts->photo ? $posts->photo->file : 'https://picsum.photos/204/214' }}" alt="" class="img-rounded">
        </div>
</div>
<div class="row">
    {!! Form::model($posts ,['method'=>'PATCH', 'action'=>['AdminPostsController@update', $posts->id], 'files'=>true]) !!}
    <div class='form-group {{ $errors->has('title')?' has-error ':'' }}'>
        {!! Form::label('title', 'Title ') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
        @if ($errors->has('title'))
        <span class="error">{{ $errors->first('title') }}</span>
        @endif
    </div>

    <div class='form-group {{ $errors->has('category_id')?' has-error ':'' }}'>
        {!! Form::label('category_id', 'Category ') !!}
        {!! Form::select('category_id', [''=>'Choose Categories'] + $categories , null, ['class'=>'form-control']) !!}
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
        {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
</div>
@endsection