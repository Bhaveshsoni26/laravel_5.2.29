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
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td><img height="50" src="{{ $post->photo ? $post->photo->file : 'Not Available' }}" alt=""></td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->category_id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->body }}</td>
            <td>{{ $post->created_at->diffForHumans() }}</td>
            <td>{{ $post->updated_at->diffForHumans() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection