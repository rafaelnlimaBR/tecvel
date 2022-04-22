@extends('site.home')

@section('conteudo')


    <div class="row">

        <div class="col-lg-4 order-1 order-lg-0">

            <div class="sidebar sidebar-left">
                <div class="widget recent-posts">
                    <h3 class="widget-title">Recent Posts</h3>
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center">
                            <div class="posts-thumb">
                                <a href="#"><img loading="lazy" alt="img" src="images/news/news1.jpg"></a>
                            </div>
                            <div class="post-info">
                                <h4 class="entry-title">
                                    <a href="#">We Just Completes $17.6 Million Medical Clinic In Mid-missouri</a>
                                </h4>
                            </div>
                        </li><!-- 1st post end-->

                        <li class="d-flex align-items-center">
                            <div class="posts-thumb">
                                <a href="#"><img loading="lazy" alt="img" src="images/news/news2.jpg"></a>
                            </div>
                            <div class="post-info">
                                <h4 class="entry-title">
                                    <a href="#">Thandler Airport Water Reclamation Facility Expansion Project Named</a>
                                </h4>
                            </div>
                        </li><!-- 2nd post end-->

                        <li class="d-flex align-items-center">
                            <div class="posts-thumb">
                                <a href="#"><img loading="lazy" alt="img" src="images/news/news3.jpg"></a>
                            </div>
                            <div class="post-info">
                                <h4 class="entry-title">
                                    <a href="#">Silicon Bench And Cornike Begin Construction Solar Facilities</a>
                                </h4>
                            </div>
                        </li><!-- 3rd post end-->

                    </ul>

                </div><!-- Recent post end -->

                <div class="widget">
                    <h3 class="widget-title">Categories</h3>
                    <ul class="arrow nav nav-tabs">
                        <li><a href="#">Construction</a></li>
                        <li><a href="#">Commercial</a></li>
                        <li><a href="#">Building</a></li>
                        <li><a href="#">Safety</a></li>
                        <li><a href="#">Structure</a></li>
                    </ul>
                </div><!-- Categories end -->

                <div class="widget">
                    <h3 class="widget-title">Archives </h3>
                    <ul class="arrow nav nav-tabs">
                        <li><a href="#">Feburay 2016</a></li>
                        <li><a href="#">January 2016</a></li>
                        <li><a href="#">December 2015</a></li>
                        <li><a href="#">November 2015</a></li>
                        <li><a href="#">October 2015</a></li>
                    </ul>
                </div><!-- Archives end -->

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

        <div class="col-lg-8 mb-5 mb-lg-0 order-0 order-lg-1">
            @foreach($posts as $p)
                <div class="post">
                    <div class="post-media post-image">
                        <img loading="lazy" src="{{url('imagens/posts/'.$p->imagens->first()->img)}}" class="img-fluid" alt="{{$p->imagens->first()->img}}">
                    </div>

                    <div class="post-body">
                        <div class="entry-header">
                            <div class="post-meta">
                <span class="post-author">
                  <i class="far fa-user"></i><a href="#"> {{$p->autor->name}}</a>
                </span>
                                <span class="post-cat">
                  <i class="far fa-folder-open"></i><a href="#"> News</a>
                </span>
                                <span class="post-meta-date"><i class="far fa-calendar"></i> {{date('d/m/Y H:m', strtotime($p->data))}}</span>
                                <span class="post-comment"><i class="far fa-comment"></i> {{$p->comentarios->count()}}<a href="#"
                                                                                               class="comments-link">Comentarios</a></span>
                            </div>
                            <h2 class="entry-title">
                                <a href="news-single.html">{{$p->titulo}}</a>
                            </h2>
                        </div><!-- header end -->

                        <div class="entry-content">
                            <p>{{$p->conteudo}}</p>
                        </div>

                        <div class="post-footer">
                            <a href="news-single.html" class="btn btn-primary">Continuar Lendo</a>
                        </div>

                    </div><!-- post-body end -->
                </div>
            @endforeach

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

    </div><!-- Main row end -->


@endsection
