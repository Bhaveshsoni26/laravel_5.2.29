@extends('layouts.blog_post')

@section('content')
<!-- Blog Post -->

<!-- Title -->
<h1>{{ $post->title }}</h1>

<!-- Author -->
<p class="lead">
    by <a href="#">{{ $post->user->name }}</a>
</p>

<hr>

<!-- Date/Time -->
<p><span class="glyphicon glyphicon-time"></span>Posted on {{ $post->created_at->diffForHumans() }}</p>

<hr>

<!-- Preview Image -->
<img class="img-responsive" src="{{ $post->photo->file }}" alt="">

<hr>

<!-- Post Content -->
<p class="lead">{{ $post->body }}</p>


<hr>

<!-- Blog Comments -->
@if(Auth::check())
<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>
    {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}

    <input type="hidden" name="post_id" value="{{ $post->id }}">

    <div class='form-group'>
        {!! Form::label('body','Body ') !!}
        {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
    </div>

    <div class='form-group'>
        {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
</div>
@endif

<hr>

<!-- Posted Comments -->
@if(count($comments) > 0)
<!-- Comment -->
@foreach($comments as $comment)
<div class="media">
    <a class="pull-left" href="#">
        <img style="border-radius: 50%;box-shadow:0 0 5px #bbbbbb;margin:5px;" height="64" class="media-object" src="{{ $comment->photo }}" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">{{ $comment->author }}
            <small>{{ $comment->created_at->diffForHumans() }}</small>
        </h4>
        <p>{{ $comment->body }}</p>



        @if(count($comment->replies) > 0)

        @foreach($comment->replies as $reply)

        @if($reply->is_active == 1)

        <!-- Nested Comment -->
        <div class="nested-comment media" style="margin-top: 40px;">
            <a class="pull-left" href="#">
                <img style="border-radius:50%;box-shadow:0 0 5px #bbbbbb;margin:5px;" height="44" class="media-object" src="{{ $reply->photo }}" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{ $reply->author }}
                    <small>{{ $reply->created_at->diffForHumans() }}</small>
                </h4>
                <p>{{ $reply->body }}</p>
            </div>

            <div class="comment-reply-container">

                <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                <div class="comment-reply col-sm-10" style="display: none;">

                    {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}

                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">

                    <div class='form-group' style="margin-top: 20px;">
                        {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1]) !!}
                    </div>

                    <div class='form-group'>
                        {!! Form::submit('Reply', ['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        @endif
        @endforeach
        @endif
    </div>
</div>
@endforeach
@endif
@endsection

@section('scripts')



@endsection