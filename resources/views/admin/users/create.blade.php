@extends('layouts.admin')

@section('content')

    <h1 class="page-header">Create User</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store', 'files'=>true]) !!}
    
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
    {!! Form::select('role_id',[''=>'Choose Option'] + $roles ,null, ['class'=>'form-control']) !!}
        @if ($errors->has('role'))
            <span class="error">{{ $errors->first('role') }}</span>
        @endif
    </div>

    <div class='form-group'>
    {!! Form::label('status', 'Status ') !!}
    {!! Form::select('is_active',array(1 => 'Active', 0 => 'Not Active') ,0, ['class'=>'form-control']) !!}
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
    {!! Form::submit('Create', ['class'=>'btn btn-primary']) !!}
    </div>
    
    {!! Form::close() !!}
@endsection
