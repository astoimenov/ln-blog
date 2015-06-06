@extends('app')

@section('content')
    <main class="row" xmlns="http://www.w3.org/1999/html">
        <section class="page-header clearfix">
            <div class="col-xs-12">
                <h1>{{ $post->post_title }}</h1>
            </div>
        </section>
        <section class="post-info clearfix">
            <div class="author-details clearfix">
                <div class="col-md-12">
                    <a class="image" href="{{-- route('authors.show', ['id' => $post->author]) --}}" title="{{ $post->author->name --}}">
                        <img src="{{ asset('/temp/author_thumb.png') }}" alt="image"/>
                    </a>

                    <div class="information">
                        <div class="author">
                            <span class="label-author">Автор:</span>
                            <a href="{{-- route('authors.show', ['id' => $post->author]) --}}" title="{{ $post->author->name }}">
                                <strong>{{ $post->author->name }}</strong>
                            </a>
                        </div>
                        <a class="view-all" href="{{-- route('authors.show', ['id' => $post->author]) --}}"
                           title="{{ $post->author->name }}">
                            Всички статии на автора <span class="glyphicon glyphicon-menu-right"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="info-bar">
                    <div class="information">
                        <span class="published">
                            <span class="date">
                                {{ $post->created_at->format('j F Y') }}
                            </span>
                            <span class="hours">
                                {{ $post->created_at->toTimeString() }}
                            </span>
                        </span>
                        <span class="comments">
                            <span class="glyphicon glyphicon-comment"></span>
                            <span class="count">
                                {{ count($post->comments) }} коментари
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </section>
        <article class="main-post clearfix">
            <div class="col-md-12">
                <div class="col-md-10 col-md-offset-1">
                    {!! $post->post_content !!}

                    @if(count($post->tags) !== 0)
                        <div class="tags">
                            <span class="fa fa-tags"></span>
                            <ul class="tags-list">
                                @foreach($post->tags as $tag)
                                    <li>
                                        {!! link_to_route('tags.show', $tag->tag_name, [$tag->tag_slug]) !!}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="share-box">
                        <span class="text-label">Сподели</span>
                        <ul class="social-sharing">
                            <li>
                                <a href="#">
                                    <img src="{{ asset('/images/social-icons/facebook.png') }}" alt="icon"/>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('/images/social-icons/linkedin.png') }}" alt="icon"/>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('/images/social-icons/twitter.png') }}" alt="icon"/>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('/images/social-icons/google-plus.png') }}" alt="icon"/>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('/images/social-icons/pinterest.png') }}" alt="icon"/>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('/images/social-icons/github.png') }}" alt="icon"/>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </article>
        <section class="post-comments post-page clearfix">
            <div class="col-md-12">
                <header class="top-stripe-header">
                    <h3>
                        <strong>{{ count($post->comments) }} коментар/a</strong>
                    </h3>
                </header>
            </div>
            <div class="col-md-12">
                @foreach($post->comments as $comment)
                    <post class="user-comment">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="user">
                                    <span class="fa fa-user"></span>

                                    <div class="spacer"></div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="top-bar">
                                    <span class="author">{{ $comment->visitor_name }}</span>
                                <span class="information">
                                    на {{ $comment->created_at->format('j F Y') }}
                                    в {{ $comment->created_at->toTimeString() }}
                                </span>
                                    <a class="reply" href="#">
                                        Отговори <span class="fa fa-reply"></span>
                                    </a>
                                </div>
                                <div class="comment">
                                    {{ $comment->comment_content }}
                                </div>
                            </div>
                        </div>
                    </post>
                @endforeach
            </div>
        </section>
        <section class="comment-form post-page">
            <div class="col-md-12">
                <header class="solid-header gray slider">
                    <h3><strong>Напиши коментар</strong></h3>
                </header>
            </div>
            {!! Form::open(array('action' => 'CommentsController@store')) !!}
            <input name="commentable_id" type="hidden" value="{{ $post->id }}"/>
            <input name="commentable_type" type="hidden" value="LittleNinja\News"/>

            <div class="on-row clearfix">
                <div class="col-md-6">
                    <label for="visitor_name"><strong>Вашите имена</strong> /задължително/</label>
                    <input id="visitor_name" type="text" name="visitor_name" required/>
                    @if ($errors->has('visitor_name'))
                        <div class="text-danger">
                            {{ $errors->first('visitor_name') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="visitor_email"><strong>E-mail</strong></label>
                    <input id="visitor_email" type="email" name="visitor_email"/>
                    @if ($errors->has('visitor_email'))
                        <div class="text-danger">
                            {{ $errors->first('visitor_email') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="on-row clearfix">
                <div class="col-md-12">
                    <label for="comment_content">
                        <strong>Коментар</strong> /задължително/
                    </label>
                    <textarea id="comment_content" name="comment_content" required></textarea>
                    @if ($errors->has('comment_content'))
                        <div class="text-danger">
                            {{ $errors->first('comment_content') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="on-row clearfix">
                <div class="col-md-12">
                    <div class="form-group form-g-f">
                        <div class="g-recaptcha" data-sitekey="6Lda1AcTAAAAAPol03oWmVsVpe653RfrPmvPTNxY"></div>
                        @if ($errors->has('g-recaptcha-response'))
                            <div class="text-danger">
                                {{ $errors->first('g-recaptcha-response') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="on-row clearfix">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <button type="submit" name="submit">Публикувай</button>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </section>
    </main>
@endsection

@section('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
