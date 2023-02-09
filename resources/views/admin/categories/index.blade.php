@extends('layouts.admin')

@section('content')

<center>
    <h1 class="page-header">Categories</h1>
</center>

<div class="col-sm-6" style="padding-top: 50px;">
    {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}
    
    <div class='form-group'>
    {!! Form::label('name', 'Name ') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
    
    <div class='form-group'>
    {!! Form::submit('Create', ['class'=>'btn btn-primary']) !!}
    </div>
    
    {!! Form::close() !!}
</div>

<div class="col-sm-6">
<table class='table table-hover'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{  $category->name  }}</td>
            <td>{{ $category->created_at->diffForHumans() }}</td>
            <td>{{ $category->updated_at->diffForHumans() }}</td>
            <td>
                {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id], 'method'=>'DELETE' ]) !!}
                
                <!-- {{Form::hidden('_method', 'DESTROY')}} -->
                
                <!-- {{Form::submit('', ['class' => 'fa fa-trash-o fa-lg'])}} -->
                <button type="submit" class="fa fa-minus btn btn-danger"></button>
                <!-- <i class="fa fa-trash-o fa-lg"></i> -->
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="fa fa-pencil btn btn-primary"></a>
                {!! Form::close() !!}
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection