@extends('site.posts.posts')

@section('postagem')

<div class="post-content post-single">

    @if($post->imagens->count() != 0)
        <div class="post-media post-image">
            <img loading="lazy" src="{{url('imagens/posts/'.$post->imagens->first()->img)}}" class="img-fluid" alt="post-image">
        </div>
    @endif

    <div class="post-body">
        <div class="entry-header">
            <div class="post-meta">
                            <span class="post-author">
                                <i class="far fa-user"></i><a href="#"> {{$post->autor->name}}</a>
                            </span>
                <span class="post-cat">

                                    </span>
                <span class="post-meta-date"><i class="far fa-calendar"></i>{{date('d/m/Y H:m', strtotime($post->data))}}</span>
                <span class="post-comment"><i class="far fa-comment"></i> {{$post->comentarios()->habilitados(1)->count()}}<a href="#" class="comments-link">Comentários</a></span>
            </div>
            <h2 class="entry-title">
                {{$post->titulo}}
            </h2>
        </div><!-- header end -->

        <div class="entry-content">

            {!!$post->conteudo!!}

        </div>
        {{--<blockquote>--}}
        {{--<p>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud--}}
        {{--exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.<cite>---}}
        {{--Anger Mathe</cite></p>--}}

        {{--</blockquote>--}}
        @if($post->tags->count() != 0)
        <div class="tags-area d-flex align-items-center justify-content-between">
            <div class="post-tags">
                @foreach($post->tags as $tag)
                <a href="#">{{$tag->nome}}</a>
                @endforeach
            </div>
        </div>
        @endif

    </div><!-- post-body end -->
</div><!-- post content end -->

{{--<div class="author-box d-nlock d-sm-flex">
    <div class="author-img mb-4 mb-md-0">
        <img loading="lazy" src="images/news/avator1.png" alt="author">
    </div>
    <div class="author-info">
        <h3>Elton Themen<span>Site Engineer</span></h3>
        <p class="mb-2">Lisicing elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad vene minim
            veniam, quis nostrud exercitation nisi ex ea commodo.</p>
        <p class="author-url mb-0">Website: <span><a href="#">http://www.example.com</a></span></p>

    </div>
</div> <!-- Author box end -->--}}

<!-- Post comment start -->
<div id="comentarios">
@include('site.posts.includes.comentarios')
</div>

@stop