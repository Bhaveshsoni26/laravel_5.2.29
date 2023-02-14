@extends('layouts.admin')

@section('content')

<h1 class="page-header">Posts</h1>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Owner</th>
            <th>Category</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Comments</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td><a href="{{ route('home.post',$post->id) }}"><img height="50" width="60" src="{{ $post->photo ? $post->photo->file : 'Not Available' }}" alt=""></a></td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ str_limit($post->body, 9) }}</td>
            <td>{{ $post->created_at->diffForHumans() }}</td>
            <td>{{ $post->updated_at->diffForHumans() }}</td>
            <td><a href="{{ route('admin.comments.show',$post->id) }}">Comments</a></td>
            <td>
                {!! Form::open(['method'=>'POST', 'action'=>['AdminPostsController@destroy', $post->id], 'method'=>'DELETE' ]) !!}

                    <!-- {{Form::hidden('_method', 'DESTROY')}} -->
                    
                    <!-- {{Form::submit('', ['class' => 'fa fa-trash-o fa-lg'])}} -->
                    <button type="submit" class="fa fa-trash-o btn btn-danger"></button>
                    <!-- <i class="fa fa-trash-o fa-lg"></i> -->
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="fa fa-pencil btn btn-primary"></a>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col-sm-6 col-sm-offset-5">
        {{ $posts->render() }}
    </div>
</div>

@endsection