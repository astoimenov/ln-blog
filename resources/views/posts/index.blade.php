@extends('app')

@section('content')
<main class="row">
    <section class="page-header clearfix">
        <div class="col-xs-12">
            <h1>
                <strong class="uppercase">{{ $title }}</strong>
            </h1>
        </div>
    </section>
    <section class="news-list clearfix">
        @foreach($posts as $post)
            <article class="news-list-article clearfix">
                <div class="col-md-9 col-sm-8 col-smx-7 col-xs-12">
                    <h3 class="title">
                        {!! link_to_route('posts.show', $post->post_title, ['posts' =>
                        $post->post_slug], ['title' => $post->post_title]) !!}
                    </h3>

                    <div class="information clearfix">
                        <span class="published">
                            <span class="date">{{ $post->created_at->format('j F Y')  }}</span>
                            <span class="hours">{{ $post->created_at->toTimeString() }}</span>
                        </span>
                        <span class="comments">
                            <span class="glyphicon glyphicon-comment"></span>
                            <span class="count">{{ count($post->comments) }}</span>
                        </span>
                    </div>
                    <div class="preview">{!! str_limit($post->post_content, 200) !!}</div>
                </div>
            </article>
        @endforeach
    </section>
    <section class="pagi clearfix">
        <div class="col-xs-12 text-center">
            <?= $posts->render() ?>
        </div>
    </section>
</main>
@endsection
