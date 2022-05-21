@extends('site.posts.posts')

@section('postagem')

    @foreach($posts as $p)

        <div class="post">
            @if($p->imagens->count() != 0)

                <div class="post-media post-image">
                    <img loading="lazy" src="{{url('imagens/posts/'.$p->imagens->first()->img)}}" class="img-fluid" alt="{{$p->imagens->first()->img}}">
                </div>
            @endif
            <div class="post-body">
                <div class="entry-header">
                    <div class="post-meta">
                <span class="post-author">
                  <i class="far fa-user"></i><a href=""> {{$p->autor->name}}</a>
                </span>
                        <span class="post-cat">
                  <i class="far fa-folder-open"></i><a href="#"> News</a>
                </span>
                        <span class="post-meta-date"><i class="far fa-calendar"></i> {{date('d/m/Y H:m', strtotime($p->data))}}</span>
                        <span class="post-comment"><i class="far fa-comment"></i> {{$p->comentarios->count()}}<a href="#"
                                                                                                                 class="comments-link">Comentarios</a></span>
                    </div>
                    <h2 class="entry-title">
                        <a href="{{route('site.postagem',['titulo'=>strtolower(str_replace(' ','-',$p->titulo)),'id'=>$p->id])}}">{{$p->titulo}}</a>
                    </h2>
                </div><!-- header end -->

                <div class="entry-content">

                    {!! substr($p->conteudo,0,500) !!}...<a style=" color: #0c84ff; text-decoration: underline" href="{{route('site.postagem',['titulo'=>strtolower(str_replace(' ','-',$p->titulo)),'id'=>$p->id])}}">Continuar lendo</a>
                </div>



                <div class="post-footer">
                    <a href="{{route('site.postagem',['titulo'=>strtolower(str_replace(' ','-',$p->titulo)),'id'=>$p->id])}}" class="btn btn-primary">Continuar Lendo</a>

                </div>

            </div><!-- post-body end -->
        </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {!!$posts->links('pagination::bootstrap-4') !!}
    </div>




@stop