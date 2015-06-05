@extends('admin.app')

@section('content')
    @include('admin.partials.sidebar')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h1>{{ $title }}</h1>

            <p>
                {!! link_to_route('admin.posts.create', '+ Добави', [], ['class' => 'btn btn-primary']) !!}
            </p>

            <div class="row">
                <form action="/admin/search" method="GET">
                    {{-- Keyword form input --}}
                    <div class="form-group col-sm-4">
                        {!! Form::text('keyword', Input::get('keyword'), ['class' => 'form-control', 'placeholder'
                        => 'Ключова дума']) !!}
                    </div>

                    {{-- News_id form input --}}
                    <div class="form-group col-sm-2">
                        {!! Form::text('post_id', Input::get('news_id'), ['class' => 'form-control', 'placeholder'
                        => 'ID']) !!}
                    </div>

                    <div class="form-group col-sm-4">
                        {!! Form::select('category_id', array_merge(array(0 => null), $categories), 0, ['class' =>
                        'form-control first-disabled']) !!}
                    </div>

                    <div class="form-group col-sm-2">
                        <button type="submit" class="btn btn-success">
                            Търси
                        </button>
                    </div>
                </form>
            </div>

            @if(count($posts) > 0)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Дата</th>
                        <th>Заглавие</th>
                        <th>Manage</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->post_title }}</td>
                            <td>
                                @if(is_null($post->deleted_at))
                                    {!! link_to_action('Admin\PostsController@edit', '', ['posts' => $post->post_slug],
                                    ['class' => 'btn btn-default glyphicon glyphicon-edit']) !!}
                                    {!! Form::open(['method' => 'DELETE', 'class' => 'inline',
                                    'action' => ['Admin\PostsController@destroy', $post->post_slug]]) !!}
                                    <button type="submit"
                                            class="btn btn-danger glyphicon glyphicon-remove-circle"></button>
                                    {!! Form::close() !!}
                                @else
                                    {!! link_to_action('Admin\PostsController@restore', 'Възстанови', ['posts' =>
                                    $post->post_slug], ['class' => 'btn btn-default']) !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h2>Няма намерени постове</h2>
            @endif

            <div class="text-center">
                <?= $posts->render() ?>
            </div>
        </div>
    </div>
@endsection
