@extends ('layouts.app')

@section('title', 'Users')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@section('content')
    <h1>User List</h1>

    <table class="table table-stripped text-primary">
        <tr>
            <th></th>
            <th>Name</th>
            <th>E-Mail</th>
            <th></th>
            <th></th>
        </tr>

        @if (count([$users]) > 0)
            @foreach ($users as $user)
                <tr>
                    <td>
                        <img style="border-radius: 50%;" width="24px" height="24px"
                            src="/storage/profile_images/{{ $user->profile_image }}">
                    </td>
                    <th>{{ $user->name }}</th>
                    <th>{{ $user->email }}</th>
                    @if (Auth::user()->user_role == 'Admin')
                        <td>
                            <a href="/users/{{ $user->id }}/edit" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            @if (Auth::user()->id != $user->id)

                                {!! Form::open(['action' => ['App\Http\Controllers\UsersController@destroy', $user->id],
                                'method' => 'POST', 'class' => 'float-right']) !!}

                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}

                                {!! Form::close() !!}
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
        @else
            <p>No Users found</p>
        @endif
    </table>
@endsection
