@foreach ($responses as $response)
    <div class="card p-3 m-2 bg-secondary">
        <div class="row">
            <div class="col-1">
                <img height="100%" src="/storage/profile_images/{{ $response->user->profile_image }}" />
            </div>
            <div class="col-3">
                <span>{{ $response->user->name }} wrote: </span>
            </div>
            <div class="col-1">
                @if (!Auth::guest())
                    @if (Auth::user()->id == $response->user_id)
                        {!! Form::open(['action' => ['App\Http\Controllers\CommentsController@destroy', $response->id],
                        'method' => 'POST', 'class' => 'float-right']) !!}

                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}

                        {!! Form::close() !!}
                    @endif
                @endif
            </div>
            <div class="col-1">
                @if (!Auth::guest())
                    <a ID="reply{{ $response->id }}" class="btn btn-primary ml-2" href="#"
                        onclick="$('.reply-area{{ $response->id }}').slideToggle(function(){$('#reply{{ $response->id }}').html($('.details').is(':visible')?'Reply':'Reply');});">Reply</a>
                @endif
            </div>
            <div class="col-1">
                @if (!Auth::guest())
                    @if (Auth::user()->id == $response->user_id)
                        <a ID="edit{{ $response->id }}" class="btn btn-primary ml-2" href="#"
                            onclick="$('.edit-area{{ $response->id }}').slideToggle(function(){$('#edit{{ $response->id }}').html($('.details').is(':visible')?'Edit':'Edit');});">Edit</a>
                    @endif
                @endif
            </div>
            <div class="col-5 text-right">
                <span> {{ $response->created_at }} </span>
            </div>
            <div class="row p-3 m-2">
            <hr>

                {{ $response->body }}
            </div>
        </div>
        <div class="row h-25">
            <div class="reply-area{{ $response->id }} col-12" style="display:none">
                {!! Form::open(['action' => 'App\Http\Controllers\CommentsController@store', 'method' => 'POST']) !!}
                {{ Form::hidden('post_id', $response->post_id) }}
                {{ Form::hidden('parent_id', $response->id) }}
                {{ Form::textarea('reply-text', '', ['class' => 'form-control', 'placeholder' => 'Your reply']) }}
                {{ Form::submit('Send', ['class' => 'btn btn-primary']) }}
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row h-25">
            <div class="edit-area{{ $response->id }} col-12" style="display:none">
                {!! Form::open(['action' => ['App\Http\Controllers\CommentsController@update', $response->id], 'method'
                => 'POST']) !!}
                {{ Form::textarea('update-text', $response->body, ['class' => 'form-control', 'placeholder' => 'Your reply']) }}
                {{ Form::hidden('_method', 'PUT') }}
                {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                {!! Form::close() !!}
            </div>
        </div>
        @include('components.comment', ['responses' => $response->responses])
    </div>
@endforeach
