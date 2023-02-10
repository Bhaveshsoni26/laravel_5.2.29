@extends('layouts.admin')

@section('content')

<center>
    <h1 class="page-header">Media</h1>
</center>

@if($photos)

<div class="col-sm-12">
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
            @foreach($photos as $photo)
            <tr>
                <td>{{ $photo->id }}</td>
                <td><img height="50" src="{{ $photo->file }}" alt=""></td>
                <td>{{ $photo->created_at->diffForHumans() }}</td>
                <td>{{ $photo->updated_at->diffForHumans() }}</td>
                <td>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy', $photo->id], 'method'=>'DELETE' ]) !!}
                        <button type="submit" class="fa fa-trash-o btn btn-danger"></button>
                    {!! Form::close() !!}
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    @endsection