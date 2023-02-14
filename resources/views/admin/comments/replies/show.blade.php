@extends('layouts.admin')

@section('content')


    @if(count($replies) > 0)

    <h1 class="page-header">Replies</h1>

    <table class="table table-hover">
    <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Body</th>
                <th>Show Post</th>
                <th>Approval</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($replies as $reply)
            <tr>
                <td>{{ $reply->id }}</td>
                <td><img height="50" src="{{ $reply->photo }}" alt=""></td>
                <td>{{ $reply->author }}</td>
                <td>{{ $reply->email }}</td>
                <td>{{ $reply->body }}</td>
                <td>
                    <a href="{{ route('home.post', $reply->comment->post->id) }}">View Post</a>
                </td>

                <td>

                    @if($reply->is_active == 1)
                        {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" name="is_active" value="0">
                            <button type="submit" class="fa fa-times btn btn-info btn-lg"></button>
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" name="is_active" value="1">
                            <button type="submit" class="fa fa-check btn btn-success btn-lg"></button>
                        {!! Form::close() !!}
                    @endif

                </td>

                <td>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}
                        <button type="submit" class="fa fa-trash-o btn btn-danger btn-lg"></button>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
            <h1 class="text-center" style="padding-top:20rem;">No replies</h1>
@endif

@endsection

