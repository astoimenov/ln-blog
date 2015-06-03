@extends('admin.app')

@section('content')
    @include('admin.partials.sidebar')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h1>Категории</h1>

            <p>
                <button class="btn btn-primary" data-target="#create-category" data-toggle="modal">+ Добави</button>
            </p>


            <div class="modal fade" id="create-category">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            {!! Form::open(array('action' => 'Admin\CategoriesController@store')) !!}
                            {{-- Name form input --}}
                            <div class="form-group">
                                {!! Form::label('name', 'Име:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' !!}
                                @if ($errors->has('name'))
                                    <div class="text-danger">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group form-g-f">
                                <button type="submit" class="btn btn-success" title="Запази">Запази</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="edit-category">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            {!! Form::open(array('method' => 'PUT', 'id' => 'edit-form')) !!}
                            {{-- Name form input --}}
                            <div class="form-group">
                                {!! Form::label('name', 'Име:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' !!}
                            </div>

                            <div class="form-group form-g-f">
                                <button type="submit" class="btn btn-success" title="Запази">Запази</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Име</th>
                    <th>Manage</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            @if(is_null($category->deleted_at))
                                <button class="btn btn-default glyphicon glyphicon-edit edit-button"
                                        data-target="#edit-category" data-toggle="modal"
                                        data-id="{{ $category->id }}"></button>
                                {!! Form::open(['method' => 'DELETE', 'class' => 'inline',
                                'action' => ['Admin\CategoriesController@destroy', $category->slug]]) !!}
                                <button type="submit" class="btn btn-danger glyphicon glyphicon-remove-circle"></button>
                                {!! Form::close() !!}
                            @else
                                {!! link_to_action('Admin\CategoriesController@restore', 'Възстанови', ['category' =>
                                $category->slug], ['class' => 'btn btn-default']) !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.edit-button').click(function () {
            var id = $(this).attr('data-id');
            var baseUrl = 'http://localhost:8000/';

            $.ajax({
                type: 'GET',
                url: baseUrl + 'admin/categories/' + id,
                success: function (data) {
                    var category = $.parseJSON(data);
                    $('#edit-category').find('#name').val(category.name);

                    $('#edit-form').attr('action', baseUrl + 'admin/categories/' + id);
                }
            });
        });
    </script>
@endsection
