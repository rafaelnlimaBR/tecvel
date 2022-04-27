@extends('site.home')

@section('conteudo')

    <div class="row">

        <div class="col-lg-8 mb-5 mb-lg-0">
            @yield('postagem')


        </div><!-- Content Col end -->

        <div class="col-lg-4">

            <div class="sidebar sidebar-right">
                <div class="widget recent-posts">
                    <h3 class="widget-title">Postagens Mais Visitadas</h3>
                    <ul class="list-unstyled">
                        @foreach($postagems_mais as  $p)
                            <li class="d-flex align-items-center">
                                @if($p->imagens->count() != 0)
                                    <div class="posts-thumb">
                                        <a href="{{route('site.postagem',['titulo'=>strtolower(str_replace(' ','-',$p->titulo)),'id'=>$p->id])}}"><img loading="lazy" alt="img" src="{{url('imagens/posts/'.$p->imagens->first()->img)}}"></a>
                                    </div>
                                @endif
                                <div class="post-info">
                                    <h4 class="entry-title">
                                        <a href="#">{{$p->titulo}}</a>
                                    </h4>
                                </div>
                            </li><!-- 1st post end-->
                        @endforeach

                    </ul>

                </div><!-- more vist post end -->
                <div class="widget recent-posts">
                    <h3 class="widget-title">Postagens Recentes</h3>
                    <ul class="list-unstyled">
                        @foreach($postagem_recentes as  $p)
                            <li class="d-flex align-items-center">
                                @if($p->imagens->count() != 0)
                                <div class="posts-thumb">
                                    <a href="{{route('site.postagem',['titulo'=>strtolower(str_replace(' ','-',$p->titulo)),'id'=>$p->id])}}"><img loading="lazy" alt="img" src="{{url('imagens/posts/'.$p->imagens->first()->img)}}"></a>
                                </div>
                                @endif
                                <div class="post-info">
                                    <h4 class="entry-title">
                                        <a href="#">{{$p->titulo}}</a>
                                    </h4>
                                </div>
                            </li><!-- 1st post end-->
                        @endforeach

                    </ul>

                </div><!-- Recent post end -->

                <div class="widget">
                    <h3 class="widget-title">Categorias</h3>
                    <ul class="arrow nav nav-tabs">
                        @foreach($categorias as $c)
                            <li><a href="{{route('site.categoria',['nome'=>strtolower(str_replace(" ","-",$c->nome)),'id'=>$c->id])}}">{{$c->nome}}</a></li>
                        @endforeach
                    </ul>
                </div><!-- Categories end -->


                <div class="widget widget-tags">
                    <h3 class="widget-title">Tags </h3>

                    <ul class="list-unstyled">
                        <li><a href="#">Construction</a></li>
                        <li><a href="#">Design</a></li>
                        <li><a href="#">Project</a></li>
                        <li><a href="#">Building</a></li>
                        <li><a href="#">Finance</a></li>
                        <li><a href="#">Safety</a></li>
                        <li><a href="#">Contracting</a></li>
                        <li><a href="#">Planning</a></li>
                    </ul>
                </div><!-- Tags end -->


            </div><!-- Sidebar end -->
        </div><!-- Sidebar Col end -->

    </div>



@endsection
