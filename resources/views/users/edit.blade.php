@extends ('layouts.app')

@section('title', 'User Edit')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@section('content')
    <h1>Edit User</h1>

    {!! Form::open(['action' => ['App\Http\Controllers\UsersController@update', $user->id], 'method' => 'POST', 'enctype' =>
    'multipart/form-data']) !!}

    <div class="form-group">
        {{ Form::label('profile_image', 'Profile Image') }}
        <br>
        {{ Form::file('profile_image') }}
    </div>
    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'name']) }}
    </div>
    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'email']) }}
    </div>
    @if(Auth::user()->user_role == 'Admin')
    <div class="form-group">
        {{ Form::label('role', 'Role') }}
        {{ Form::select('role', ['Basic' => 'Basic', 'Admin' => 'Admin'], $user->user_role), ['class' => 'form-control'] }}
    </div>
    @endif
    {{ Form::hidden('_method', 'PUT') }}
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection
