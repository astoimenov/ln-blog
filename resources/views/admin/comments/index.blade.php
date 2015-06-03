@extends('admin.app')

@section('content')
    @include('admin.partials.sidebar')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h1>Коментари</h1>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>ID на новина</th>
                    <th>Дата</th>
                    <th>Потребител</th>
                    <th>Коментар</th>
                    <th>Manage</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->commentable_id }}</td>
                        <td>{{ $comment->created_at }}</td>
                        <td>{{ $comment->user_name }}</td>
                        <td>{{ $comment->comment_content }}</td>
                        <td>
                            @if(is_null($comment->deleted_at))
                                {!! Form::open(['method' => 'DELETE', 'class' => 'inline',
                                'action' => ['Admin\CommentsController@destroy', $comment->id]]) !!}
                                <button type="submit" class="btn btn-danger glyphicon glyphicon-remove-circle"></button>
                                {!! Form::close() !!}
                            @else
                                {!! link_to_action('Admin\CommentsController@restore', 'Възстанови', ['id' =>
                                $comment->id], ['class' => 'btn btn-default']) !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-center">
                <?= $comments->render() ?>
            </div>
        </div>
    </div>
@endsection
