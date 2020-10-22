@extends ('layouts.app')

@section('title', 'Posts')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@section('content')

    <a href="/posts" class="btn btn-primary ml-2">Go Back</a>
    <div class="card p-3 m-2 bg-dark">
        <h1>{{ $post->title }}</h1>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <img style="width:100%" src="/storage/posts_images/{{ $post->post_image }}" />
            </div>
            <div class="col-md-8 col-sm-8">
                {!! $post->body !!}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-4">
                <span>Categories:
                    @foreach ($post->categories as $category)
                        <a href="/categories/{{ $category->id }}">{{ $category->name }}</a>,&nbsp;
                    @endforeach
                </span>
            </div>
            @if (!Auth::guest())
                @if ($post->likes->contains('id', Auth::user()->id))
                    <div class="col-5">
                        {!! Form::open(['action' => ['App\Http\Controllers\PostsController@removelike', $post->id], 'method'
                        => 'POST', 'class' => 'float-right']) !!}

                        {{ Form::hidden('user_id', Auth::user()->id) }}
                        {{ Form::hidden('post_id', $post->id) }}
                        {{ Form::submit('Remove Like', ['class' => 'btn btn-danger mr-2']) }}
                        {{ Form::hidden('_method', 'DELETE') }}

                        {!! Form::close() !!}
                    </div>
                @else
                    <div class="col-5 text-right">
                        {!! Form::open(['action' => ['App\Http\Controllers\PostsController@addlike', $post->id], 'method' =>
                        'POST', 'class' => 'float-right']) !!}
                        {{ Form::hidden('user_id', Auth::user()->id) }}
                        {{ Form::hidden('post_id', $post->id) }}
                        {{ Form::submit('Like', ['class' => 'btn btn-primary mr-2']) }}

                        {!! Form::close() !!}
                    </div>
                @endif
            @endif
            <div class="col-3 text-right">
                @include('posts.likes', ['post' => $post])
            </div>
        </div>
        <small>Written on {{ $post->created_at }} by {{ $post->user->name }}</small><br>
    </div>
    @if (!Auth::guest())
        @if (Auth::user()->id == $post->user_id)
            <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary ml-2">Edit</a>

            {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST',
            'class' => 'float-right']) !!}

            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('Delete', ['class' => 'btn btn-danger mr-2']) }}

            {!! Form::close() !!}
        @endif
    @endif
    <hr>
    <h2 class="m-2">Comment Section</h2>
    @if (!Auth::guest())
        <div class="ml-2 mr-2">
            {!! Form::open(['action' => 'App\Http\Controllers\CommentsController@store', 'method' => 'POST']) !!}
            {{ Form::hidden('post_id', $post->id) }}
            {{ Form::hidden('parent_id', null) }}
            {{ Form::textarea('reply-text', '', ['class' => 'form-control', 'placeholder' => 'Your comment']) }}
            {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
            {!! Form::close() !!}
        </div>
    @endif
    @include('components.comment', ['responses' => $post->comments])

@endsection
