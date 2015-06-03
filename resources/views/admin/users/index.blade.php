@extends('admin.app')

@section('content')
    @include('admin.partials.sidebar')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h1>Потребители</h1>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Име</th>
                    <th>Е-майл</th>
                    <th>Manage</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if(is_null($user->deleted_at))
                                {!! link_to_action('Admin\UsersController@edit', '', ['id' => $user->id],
                                ['class' => 'btn btn-default glyphicon glyphicon-edit']) !!}
                                {!! Form::open(['method' => 'DELETE', 'class' => 'inline',
                                'action' => ['Admin\UsersController@destroy', $user->id]]) !!}
                                <button type="submit" class="btn btn-danger glyphicon glyphicon-remove-circle"></button>
                                {!! Form::close() !!}
                            @else
                                {!! link_to_action('Admin\UsersController@restore', 'Възстанови', ['id' =>
                                $user->id], ['class' => 'btn btn-default']) !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-center">
                <?= $users->render() ?>
            </div>
        </div>
    </div>
@endsection
