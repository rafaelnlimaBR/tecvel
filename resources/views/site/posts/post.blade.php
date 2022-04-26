@extends('site.home')

@section('conteudo')

    <section id="main-container" class="main-container">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 mb-5 mb-lg-0">

                    <div class="post-content post-single">
<<<<<<< HEAD
                        @if($post->imagens->count() != 0)
                        <div class="post-media post-image">
                            <img loading="lazy" src="{{url('imagens/posts/'.$post->imagens->first()->img)}}" class="img-fluid" alt="post-image">
                        </div>
                        @endif
=======
                        <div class="post-media post-image">
                            <img loading="lazy" src="{{url('imagens/posts/'.$post->imagens->first()->img)}}" class="img-fluid" alt="post-image">
                        </div>

>>>>>>> 08d4005608bc4d4a319875884628f64f64af0f11
                        <div class="post-body">
                            <div class="entry-header">
                                <div class="post-meta">
                <span class="post-author">
                  <i class="far fa-user"></i><a href="#"> {{$post->autor->name}}</a>
                </span>
                                    <span class="post-cat">
                  <i class="far fa-folder-open"></i><a href="#"> News</a>
                </span>
                                    <span class="post-meta-date"><i class="far fa-calendar"></i>{{date('d/m/Y H:m', strtotime($post->data))}}</span>
                                    <span class="post-comment"><i class="far fa-comment"></i> {{$post->comentarios()->habilitados(1)->count()}}<a href="#" class="comments-link">Comentários</a></span>
                                </div>
                                <h2 class="entry-title">
                                    {{$post->titulo}}
                                </h2>
                            </div><!-- header end -->

                            <div class="entry-content">
<<<<<<< HEAD
                                {!!$post->conteudo!!}
=======
                                {{html_entity_decode($post->conteudo)}}
>>>>>>> 08d4005608bc4d4a319875884628f64f64af0f11
                            </div>
                            {{--<blockquote>--}}
                                {{--<p>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud--}}
                                    {{--exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.<cite>---}}
                                        {{--Anger Mathe</cite></p>--}}

                            {{--</blockquote>--}}
                            <div class="tags-area d-flex align-items-center justify-content-between">
                                <div class="post-tags">
                                    <a href="#">Construction</a>
                                    <a href="#">Safety</a>
                                    <a href="#">Planning</a>
                                </div>
                                <div class="share-items">
                                    <ul class="post-social-icons list-unstyled">
                                        <li class="social-icons-head">Share:</li>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>

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
                    @include('site.posts.comentarios')
                </div><!-- Content Col end -->

                <div class="col-lg-4">

                    <div class="sidebar sidebar-right">
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

            </div><!-- Main row end -->

        </div><!-- Conatiner end -->
    </section>



@endsection