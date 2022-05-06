@extends('site.home')

@section('conteudo_site')
    @include('site.banner.banner')




    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h3 class="column-title">Avaliações <a style="font-size: 11px; color: #0c84ff; text-decoration-line: underline " href="{{$dados->link_avaliacao}}" target="_new">deixe sua avaliação</a></h3>

                    <div id="testimonial-slide" class="testimonial-slide">

                        @foreach($avaliacoes as $avaliacao)
                            <div class="item">
                                <div class="quote-item">
                                <span class="quote-text">
                                  {{$avaliacao->texto}}
                                </span>

                                    <div class="quote-item-footer">

                                        <div class="quote-item-info">
                                            <h3 class="quote-author">{{$avaliacao->cliente}}</h3>

                                        </div>
                                    </div>
                                </div><!-- Quote item end -->
                            </div>

                        @endforeach
                    </div>
                    <!--/ Testimonial carousel end-->
                </div><!-- Col end -->

                <div class="col-lg-4">
                @if(isset($post_mais_visto))
                        <h3 class="column-title">Post Mais Visto</h3>
                        <div class="latest-post">
                            <div class="latest-post-media">
                                @if($post_mais_visto->imagens->count() != 0)
                                <a href="{{route('site.postagem',['titulo'=>strtolower(str_replace(' ','-',$post_mais_visto->titulo)),'id'=>$post_mais_visto->id])}}" class="latest-post-img">
                                    <img loading="lazy" class="img-fluid" src="{{url('imagens/posts/'.$post_mais_visto->imagens->first()->img)}}" alt="{{$post_mais_visto->imagens->first()->alt}}">
                                </a>
                                @endif
                            </div>
                            <div class="post-body">
                                <h4 class="post-title">

                                    <a href="{{route('site.postagem',['titulo'=>strtolower(str_replace(' ','-',$post_mais_visto->titulo)),'id'=>$post_mais_visto->id])}}" class="d-inline-block">{{$post_mais_visto->titulo }}</a>

                                </h4>
                                <div class="latest-post-meta">
                                <span class="post-item-date">
                                  <i class="fa fa-clock-o"></i> {{date('d/m/Y', strtotime($post_mais_visto->data))}}
                                </span>
                                </div>
                            </div>
                        </div>
                @endif
                </div>

            </div>
            <!--/ Content row end -->
        </div>
        <!--/ Container end -->
    </section><!-- Content end -->
    <section id="news" class="news">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="section-title">{{$dados->nome_empresa}}</h2>
                    <h3 class="section-sub-title">Posts Recentes</h3>
                </div>
            </div>
            <!--/ Title row end -->

            <div class="row">

                @foreach($posts as $p)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="latest-post">
                            <div class="latest-post-media">
                                @if($p->imagens->count() != 0)
                                <a href="{{route('site.postagem',['titulo'=>strtolower(str_replace(' ','-',$p->titulo)),'id'=>$p->id])}}" class="latest-post-img">
                                    <img loading="lazy" class="img-fluid" src="{{url('imagens/posts/'.$p->imagens->first()->img)}}" alt="img">
                                </a>
                                @endif
                            </div>
                            <div class="post-body">
                                <h4 class="post-title">
                                    <a href="{{route('site.postagem',['titulo'=>strtolower(str_replace(' ','-',$p->titulo)),'id'=>$p->id])}}}}" class="d-inline-block">{{$p->titulo}}</a>
                                </h4>
                                <div class="latest-post-meta">
                    <span class="post-item-date">
                      <i class="fa fa-clock-o"></i> {{date('d/m/Y', strtotime($p->data))}}
                    </span>
                                </div>
                            </div>
                        </div><!-- Latest post end -->
                    </div><!-- 1st post col end -->
                @endforeach
            </div>
            <!--/ Content row end -->

            <div class="general-btn text-center mt-4">
                <a class="btn btn-primary" href="{{route('site.postagens')}}">Veja todas</a>
            </div>

        </div>
        <!--/ Container end -->
    </section>

@stop