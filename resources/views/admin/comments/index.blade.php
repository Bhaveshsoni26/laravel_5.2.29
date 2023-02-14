@extends('layouts.admin')

@section('content')
    
    @if(count($comments) > 0)

    <h1 class="page-header">Comments</h1>

    <table class='table table-hover'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Body</th>
                <th>Show Post</th>
                <th>Replies</th>
                <th>Approval</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php /* dd($comments); */ ?>
            @foreach($comments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td><img height="50" src="{{ $comment->photo }}" alt=""></td>
                <td>{{ $comment->author }}</td>
                <td>{{ $comment->email }}</td>
                <td>{{ $comment->body }}</td>
                <td><a href="{{ route('home.post',$comment->post->id) }}">View Post</a></td>
                <td>
                    <a href="{{ route('admin.comment.replies.show', $comment->id) }}">View Replies</a>
                </td>
                <td>
                    @if($comment->is_active == 1)
                        {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                            <input type="hidden" name="is_active" value="0">
                            <button type="submit" class="btn btn-success">Un-Approve</button>
                        {!! Form::close() !!}

                    @else
                        {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                            <input type="hidden" name="is_active" value="1">
                            <button type="submit" class="btn btn-info">Approve</button>
                        {!! Form::close() !!}

                    @endif
                </td>


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