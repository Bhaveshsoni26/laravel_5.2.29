@extends('layouts.admin')


@section('content')

<h1 class="page-header">Upload Media</h1>

{!! Form::open(['method'=>'POST', 'action'=>'AdminMediasController@store', 'class'=>'dropzone', 'style'=>'margin-top : 100px']) !!}


{!! Form::close() !!}

@endsection