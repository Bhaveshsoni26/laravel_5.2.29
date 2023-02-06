@extends('layouts.admin')

@section('content')

    <h1 class="page-header">Edit User</h1>

    <div class="col-sm-3">
        <img src="{{ $user->photo ? $user->photo->file : 'https://picsum.photos/204/214' }}" alt="" class="img-responsive img-rounded">
    </div>

    <div class="col-sm-9">
    {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}
    
    <div class='form-group {{ $errors->has('name')?' has-error ':'' }}'>
    {!! Form::label('name', 'Name ') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
        @if ($errors->has('name'))
            <span class="error">{{ $errors->first('name') }}</span>
        @endif
    </div>

    <div class='form-group {{ $errors->has('email')?' has-error ':'' }}'>
    {!! Form::label('email', 'Email ') !!}
    {!! Form::email('email', null, ['class'=>'form-control']) !!}
        @if ($errors->has('email'))
            <span class="error">{{ $errors->first('email') }}</span>
        @endif
    </div>

    <div class='form-group' {{ $errors->has('role')?' has-error ':'' }}'>
    {!! Form::label('role', 'Role ') !!}
    {!! Form::select('role_id', $roles ,null, ['class'=>'form-control']) !!}
        @if ($errors->has('role'))
            <span class="error">{{ $errors->first('role') }}</span>
        @endif
    </div>

    <div class='form-group'>
    {!! Form::label('status', 'Status ') !!}
    {!! Form::select('is_active',array(1 => 'Active', 0 => 'Not Active') ,null, ['class'=>'form-control']) !!}
    </div>

    <div class='form-group'>
    {!! Form::label('file', 'File ') !!}
    {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
    </div>


    <div class='form-group' {{ $errors->has('password')?' has-error ':'' }}'>
    {!! Form::label('password', 'Password ') !!}
    {!! Form::password('password', ['class'=>'form-control']) !!}
        @if ($errors->has('password'))
            <span class="error">{{ $errors->first('password') }}</span>
        @endif
    </div>

    <div class='form-group' {{ $errors->has('password_confirmation')?' has-error ':'' }}'>
   {!! Form::label('password_confirmation', 'Confirm Password ' ) !!}
    {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
        @if ($errors->has('password_confirmation'))
            <span class="error">{{ $errors->first('password_confirmation') }}</span>
        @endif
    </div>
    
    <div class='form-group'>
    {!! Form::submit('Edit', ['class'=>'btn btn-primary']) !!}
    </div>
    
    {!! Form::close() !!}
    </div>

@endsection
