@extends ('layouts.app')

@section('title', 'Posts')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@section('content')
    <h1>Create Post</h1>

    <a href="/posts" class="btn btn-primary">Go Back</a>
    <hr>
    {!! Form::open(['action' => ['App\Http\Controllers\PostsController@store'], 'method' => 'POST', 'enctype' =>
    'multipart/form-data']) !!}
    <div class="form-group">
        <h3>{{ Form::label('post_image', 'Post Image') }}</h3>
        <br>
        {{ Form::file('post_image') }}
    </div>
    <hr>
    <div class="form-group">

        {{ Form::label('categories', 'Categories') }}
        <br>
        {{ Form::select('categories[]', $categories, null, ['id' => 'categories', 'multiple' => 'multiple', 'class' => 'form-control']) }}

    </div>
    {!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' => 'POST']) !!}
    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
    </div>
    <div class="form-group">
        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body Text']) }}
    </div>
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection
