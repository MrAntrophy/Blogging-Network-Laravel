@extends ('layouts.app')

@section('title', 'Posts')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@section('content')
    <h1>Edit Post</h1>
    <hr>
    {!! Form::open(['action' => ['App\Http\Controllers\PostsController@update', $post->id], 'method' => 'POST', 'enctype' =>
    'multipart/form-data']) !!}
    <div class="form-group">
        <h3>{{ Form::label('post_image', 'Post Image') }}</h3>
        <img src="/storage/posts_images/{{ $post->post_image }}" />
        <br>
        {{ Form::file('post_image') }}
    </div>
    <hr>
    <div>
        <h3>Categories</h3>
        <div class="row">

            <div class="form-group col-3">
                {{ Form::label('categories[]', 'Select existing') }}
                {{ Form::select('categories[]', $categories, $post->categories->pluck('id')->all(), ['id' => 'categories', 'multiple' => 'multiple', 'class' => 'form-control']) }}
            </div>

        </div>
    </div>
    <div>
        <hr>
        <h3>Post content</h3>
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title']) }}
        </div>
        <div class="form-group">
            {{ Form::label('body', 'Body') }}
            {{ Form::textarea('body', $post->body, ['class' => 'form-control', 'placeholder' => 'Body Text']) }}
        </div>
        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
        {!! Form::close() !!}
    @endsection
