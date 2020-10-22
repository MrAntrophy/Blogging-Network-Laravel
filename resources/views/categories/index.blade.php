@extends ('layouts.app')

@section('title', 'Users')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@section('content')
    @php
    $name = '';
    $description = '';
    $category_id = 0;
    @endphp
    <h1>Categories Administration</h1>

    <table class="table table-stripped text-primary">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>No. posts</th>
            <th></th>
            <th></th>
        </tr>

        @if (count([$categories]) > 0)
            @foreach ($categories as $category)
                <tr>
                    <th>{{ $category->name }}</th>
                    <th>{{ $category->description }}</th>
                    <th>{{ count($category->posts) }}</th>
                    <td>
                        <a ID="edit" class="btn btn-primary ml-2" href="#edit"
                            onclick="$('.edit-cat').slideToggle(function(){$('#edit').html($('.details').is(':visible')?'Edit':'Edit');});">Edit</a>
                        @php
                        $name = $category->name;
                        $description = $category->description;
                        $category_id = $category->id;
                        @endphp
                    </td>
                    <td>
                        {!! Form::open(['action' => ['App\Http\Controllers\CategoriesController@destroy', $category->id],
                        'method' => 'POST', 'class' => 'float-right']) !!}

                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}

                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @else
            <p>No Categories found</p>
        @endif
    </table>
    <a ID="create" class="btn btn-primary ml-2" href="#create"
        onclick="$('.create-new').slideToggle(function(){$('#create').html($('.details').is(':visible')?'Create new':'Create new');});">Create
        new</a>
    <br>
    <div class="create-new ml-2 mr-2" style="display: none">
        {!! Form::open(['action' => ['App\Http\Controllers\CategoriesController@store'], 'method' => 'POST', 'enctype' =>
        'multipart/form-data']) !!}

        {{ Form::label('name', 'Name:') }}
        {{ Form::text('name', '', ['placeholder' => 'New category name', 'class' => 'form-control']) }}

        {{ Form::label('description', 'Description:') }}
        {{ Form::text('description', '', ['placeholder' => 'New category description', 'class' => 'form-control']) }}
        <br>
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
        {!! Form::close() !!}
    </div>
    <div class="edit-cat ml-2 mr-2" style="display: none">
        {!! Form::open(['action' => ['App\Http\Controllers\CategoriesController@update', $category_id], 'method' => 'POST',
        'enctype' => 'multipart/form-data']) !!}

        {{ Form::label('name', 'Name:') }}
        {{ Form::text('name', $name, ['placeholder' => 'New category name', 'class' => 'form-control']) }}

        {{ Form::label('description', 'Description:') }}
        {{ Form::text('description', $description, ['placeholder' => 'New category description', 'class' => 'form-control']) }}
        <br>
        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
        {!! Form::close() !!}
    </div>

@endsection
