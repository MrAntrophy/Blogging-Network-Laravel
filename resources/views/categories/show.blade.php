@extends ('layouts.app')

@section('title', 'Posts')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@section('content')
    <a href="{{ url()->previous() }}" class="btn btn-primary ml-2">Go Back</a>
    <h1>{{ $category->name }} Category</h1>

    @if (count([$category->posts]) > 0)
        @foreach ($category->posts as $post)
            <div class="card p-3 m-2 bg-dark">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="/storage/posts_images/{{ $post->post_image }}" />
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h3>
                        <small>Written on {{ $post->created_at }} by {{ $post->user->name }}</small><br>
                    </div>
                </div>
                <hr>
                <span>Categories:
                    @foreach ($post->categories as $category)
                        <a href="/categories/{{ $category->id }}">{{ $category->name }}</a>,&nbsp;
                    @endforeach
                </span>
            </div>
        @endforeach
    @else
        <p>No posts found</p>
    @endif
@endsection
