@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark text-primary">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h3 class="text-center">Your Blog Posts</h3>
                        @if (count(array($posts)) > 0)
                            <table class="table table-striped text-primary">
                                <tr>
                                    <th>Title </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach ($posts as $post)
                                    <tr>
                                        <th> {{ $post->title }} </th>
                                        <td><a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a></td>
                                        <td>
                                            {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy',
                                            $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}

                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}

                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p>You have no posts</p>
                        @endif
                        <a href="/posts/create" class="btn btn-primary">Create new Post</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
