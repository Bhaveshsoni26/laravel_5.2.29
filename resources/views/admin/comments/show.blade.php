@extends('layouts.admin')

@section('content')


    @if(count($comments) > 0)

    <h1 class="page-header">Comments</h1>

    <table class="table table-hover">
    <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Body</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td><img height="50" src="{{ $comment->photo }}" alt=""></td>
                <td>{{ $comment->author }}</td>
                <td>{{ $comment->email }}</td>
                <td>{{ $comment->body }}</td>

                <td>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}
                        <button type="submit" class="fa fa-trash-o btn btn-danger btn-lg"></button>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
            <h1 class="text-center" style="padding-top:20rem;">No Comments</h1>
@endif

@endsection

