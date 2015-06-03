@extends('admin.app')

@section('content')
    @include('admin.partials.sidebar')
    <div class="page-content-wrapper">
        <div class="page-content">
            {!! Form::model($user, array('method' => 'PUT', 'files' => true, 'action' =>
            array('Admin\UsersController@update', $user->id))) !!}
            {{-- Name form input --}}
            <div class="form-group">
                {!! Form::label('name', 'Име:') !!}
                {!! Form::text('name', $user->name, ['class' => 'form-control', 'required',
                'x-moz-errormessage' => 'Моля, попълнете това поле.', 'title' => 'Моля, попълнете това
                поле.']) !!}
                @if ($errors->has('name'))
                    <div class="text-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            {{-- Email form input --}}
            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::email('email', $user->email, ['class' => 'form-control', 'required',
                'x-moz-errormessage' => 'Моля, попълнете това поле.', 'title' => 'Моля, попълнете това
                поле.']) !!}
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success" title="Запази">Запази</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
