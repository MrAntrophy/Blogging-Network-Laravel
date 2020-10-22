@extends ('layouts.app')

@section('title', 'Posts')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@section('content')
    <h1 class="ml-2">Posts</h1>

    @if (count([$posts]) > 0)
        @foreach ($posts as $post)
            <div class="card p-3 m-2 bg-dark">
                <div class="row">
                    <div class="col-4">
                        <img style="width:100%" src="/storage/posts_images/{{ $post->post_image }}" />
                    </div>
                    <div class="col-8">
                        <h3><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h3>
                        <small>Written on {{ $post->created_at }} by {{ $post->user->name }}</small><br>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <span>Categories:
                            @foreach ($post->categories as $category)
                                <a href="/categories/{{ $category->id }}">{{ $category->name }}</a>,&nbsp;
                            @endforeach
                        </span>
                    </div>
                    <div class="col-6 text-right">
                        @include('posts.likes', ['post' => $post])
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No posts found</p>
    @endif
@endsection
