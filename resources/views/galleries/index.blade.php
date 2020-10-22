@extends ('layouts.app')

@section('title', 'Gallery')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@section('content')
    <h1 class="ml-2 mr-2">Gallery</h1>

    @include('galleries.uploadphoto', ['gallery' => $gallery])

    @if (count($gallery) > 0)
        @foreach ($gallery as $photo)
            <div class="card p-3 m-2 bg-dark">
                <div class="row">
                    <h2 class="ml-2">{{ $photo->name }}</h2>
                </div>
                <div class="row">
                    <img style="width:100%" src="/storage/gallery_images/{{ $photo->photo }}" />
                </div>
                <hr>
                <div class="row text-center">
                    <span class="text-center">
                        {{ $photo->description }}
                    </span>
                </div>
            </div>
            <div>
                @if (Auth::user()->id == $photo->user_id)

                    {!! Form::open(['action' => ['App\Http\Controllers\GalleriesController@destroy', $photo->id], 'method'
                    => 'POST', 'class' => 'ml-2']) !!}

                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}

                    {!! Form::close() !!}
            </div>
        @endif
    @endforeach
@else
    <p>No photos found</p>
    @endif
@endsection
