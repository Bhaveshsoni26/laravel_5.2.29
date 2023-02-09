@extends('layouts.admin')

@section('content')

<h1 class="page-header">Edit Categories</h1>
<div class="col-sm-8">
{!! Form::model($categories, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $categories->id] ]) !!}

<div class='form-group'>
    {!! Form::label('name', 'Name ') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>

<div class='form-group'>
    {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
</div>

{!! Form::close() !!}
</div>
@endsection