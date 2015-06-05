@extends('admin.app')

@section('content')
    @include('admin.partials.sidebar')
    <div class="page-content-wrapper">
        <div class="page-content">
            {!! Form::model($post, array('method' => 'PUT', 'action' => array('Admin\PostsController@update',
            $post->slug))) !!}
            {{-- Title form input --}}
            <div class="form-group">
                {!! Form::label('post_title', 'Заглавие:') !!}
                {!! Form::text('post_title', null, ['class' => 'form-control', 'onload' => 'slugify()', 'onkeyup' =>
                'slugify()', 'required']) !!}
                @if ($errors->has('post_title'))
                    <div class="text-danger">
                        {{ $errors->first('post_title') }}
                    </div>
                @endif
            </div>

            {{-- Slug form input --}}
            <div class="form-group">
                {!! Form::label('post_slug', 'Слъг:') !!}
                <input type="text" name="post_slug" id="post_slug" value="" class="form-control"/>
                @if ($errors->has('post_slug'))
                    <div class="text-danger">
                        {{ $errors->first('post_slug') }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="form-group col-sm-3">
                    {!! Form::label('categories', 'Категория:') !!}
                    {!! Form::select('categories', $categories, $selectedCategories, ['multiple', 'class' =>
                    'form-control', 'name' => 'categories[]']) !!}
                    @if ($errors->has('category'))
                        <div class="text-danger">
                            {{ $errors->first('category') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-3">
                    {!! Form::label('tags', 'Тагове:') !!}
                    {!! Form::select('tags', $tags, $selectedTags, ['multiple', 'class' => 'form-control', 'name' =>
                    'tags[]']) !!}
                    @if ($errors->has('tags'))
                        <div class="text-danger">
                            {{ $errors->first('tags') }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Content form input --}}
            <div class="form-group">
                {!! Form::label('post_content', 'Текст:') !!}
                {!! Form::textarea('post_content', null, ['class' => 'form-control', 'required']) !!}
                @if ($errors->has('post_content'))
                    <div class="text-danger">
                        {{ $errors->first('post_content') }}
                    </div>
                @endif
            </div>

            <div class="form-group form-g-f">
                <button type="submit" class="btn btn-success" title="Запази">Запази</button>
                <a href="{{ URL::previous() }}" class="btn btn-danger" title="Затвори">Затвори</a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/speakingurl/3.0.0/speakingurl.min.js"></script>
    <script src="{{ asset('/node_modules/tinymce/tinymce.min.js') }}"></script>
    <script>
        var slugify = function () {
            var slug = getSlug($('#post_title').val());
            $('#post_slug').val(slug);
        };

        window.onload = slugify();

        $(document).ready(function () {
            $('#categories').select2();
            $('#tags').select2({
                tags: true
            });

            tinymce.init({
                selector: '#content',
                plugins: [
                    'advlist autolink lists link charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste jbimages'
                ],
                toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages'
            });
        })
        ;
    </script>
@endsection
