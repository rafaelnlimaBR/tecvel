@extends('site.home')

@section('conteudo')

    <div class="row">

        <div class="col-lg-8 mb-5 mb-lg-0">
            @yield('postagem')

            <nav class="paging" aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-double-left"></i></a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a></li>
                </ul>
            </nav>

        </div><!-- Content Col end -->

        <div class="col-lg-4">

            <div class="sidebar sidebar-right">
                <div class="widget recent-posts">
                    <h3 class="widget-title">Postagens Recentes</h3>
                    <ul class="list-unstyled">
                        @foreach($postagem_recentes as  $p)
                            <li class="d-flex align-items-center">
                                <div class="posts-thumb">
                                    <a href="#"><img loading="lazy" alt="img" src="images/news/news1.jpg"></a>
                                </div>
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
                            <li><a href="#">{{$c->nome}}</a></li>
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
