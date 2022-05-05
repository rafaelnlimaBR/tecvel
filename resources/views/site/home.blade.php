<!DOCTYPE html>
<html lang="pt-br">
<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>{{$titulo}}</title>

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{isset($post)?$meta_description:$dados->descricao}}">
    <meta name="keywords" content="{{isset($post)?$meta_tags:$dados->tags}}">
    <meta name="author" content="{{$dados->nome_empresa}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <link rel="alternate" href="" hreflang="pt-br" />
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <meta property="og:url" content="{{ url()->current()}}" />
    <meta property="og:title" content="{{isset($post)?$post->titulo:$dados->nome_empresa}}" />
    <meta property="og:image" content="{{isset($post)?url('imagens/posts/'.$post->img):url('imagens/'.$dados->logo)}}" />
    <meta property="og:description" content="{{isset($post)?$post->descricao:$dados->descricao}}" />
    <meta name="theme-color" content="#fe2813">

    <meta property="business:contact_data:country_name" content="Brasil" />
    <meta property="business:contact_data:website" content="URL" />
    <meta property="business:contact_data:region" content="CE" />
    <meta property="business:contact_data:email" content="{{$dados->email}}" />
    <meta property="business:contact_data:phone_number" content="{{$dados->telefone_movel}}" />


    <meta name="twitter:card" content="{{isset($post)?$post->titulo:$dados->nome_empresa}}" />
    <meta name="twitter:description" content="{{isset($post)?$meta_description:$dados->descricao}}"/>
    <meta name="twitter:title" content="{{isset($post)?$post->titulo:$dados->nome_empresa}}" />
    <meta name="twitter:image" content="{{isset($post)?url('imagens/posts/'.$post->img):url('imagens/'.$dados->logo)}}" />


    <meta name="geo.placename" content="Fortaleza" />
    <meta name="geo.region" content="BR" />
    <meta name="description" content="{{isset($post)?$meta_description:$dados->descricao}}" />
    <link rel="canonical" href="{{ base_path()}}" />

    <meta property="og:type" content="website" />
    <meta property="og:locale" content="pt_BR" />
    <meta name="format-detection" content="telephone=no">

    <!-- Favicon
  ================================================== -->
    <!-- CSS
 ================================================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('vendor/site/plugins/bootstrap/bootstrap.min.css') }}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset('vendor/site/plugins/fontawesome/css/all.min.css') }}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ asset('vendor/site/plugins/animate-css/animate.css') }}">
    <!-- slick Carousel -->
    <link rel="stylesheet" href="{{ asset('vendor/site/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/site/plugins/slick/slick-theme.css') }}">
    <!-- Colorbox -->
    <link rel="stylesheet" href="{{ asset('vendor/site/plugins/colorbox/colorbox.css') }}">
    <!-- Template styles-->
    <link rel="stylesheet" href="{{ asset('vendor/site/css/style.css') }}">



    <script src="{{ asset('vendor/jquery/jquery.js') }}"></script>

</head>
<body>
<div class="body-inner">
    @include('site.includes.scripts')
    <div id="top-bar" class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <ul class="top-info text-center text-md-left">
                        <li><i class="fas fa-map-marker-alt"></i> <p class="info-text">{{$dados->endereco}}</p>
                        </li>
                    </ul>
                </div>
                <!--/ Top info end -->

                <div class="col-lg-4 col-md-4 top-social text-center text-md-right">
                    <ul class="list-unstyled">
                        <li>
                            <a target="_new" title="Facebook" href="{{$dados->facebook}}">
                                <span class="social-icon"><i class="fab fa-facebook-f"></i></span>
                            </a>

                            <a target="_new" title="Instagram" href="{{$dados->instagran}}">
                                <span class="social-icon"><i class="fab fa-instagram"></i></span>
                            </a>

                        </li>
                    </ul>
                </div>
                <!--/ Top social end -->
            </div>
            <!--/ Content row end -->
        </div>
        <!--/ Container end -->
    </div>
    <!--/ Topbar end -->
    <!-- Header start -->
    <header id="header" class="header-one">
        <div class="bg-white">
            <div class="container">
                <div class="logo-area">
                    <div class="row align-items-center">
                        <div class="logo col-lg-3 text-center text-lg-left mb-3 mb-md-5 mb-lg-0">
                            <a class="d-block" href="index.html">
                                <img loading="lazy" src="{{url('imagens/'.$dados->logo)}}" alt="Constra">
                            </a>
                        </div><!-- logo end -->

                        <div class="col-lg-9 header-right">
                            <ul class="top-info-box">
                                <li>
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <p class="info-box-title">Whatsapp</p>
                                            <p class="info-box-subtitle"><a target="_blank" href="http://wa.me/55{{str_replace(')', '', str_replace('(', '', $dados->telefone_movel))}}">{{$dados->telefone_movel}}</a></p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <p class="info-box-title">Email</p>
                                            <p class="info-box-subtitle"><a href="mailto:{{$dados->email}}">{{$dados->email}}</a></p>
                                        </div>
                                    </div>
                                </li>

                                <li class="header-get-a-quote">
                                    <a class="btn btn-primary" href="contact.html">Orçamento</a>
                                </li>
                            </ul><!-- Ul end -->
                        </div><!-- header right end -->
                    </div><!-- logo area end -->

                </div><!-- Row end -->
            </div><!-- Container end -->
        </div>

        <div class="site-navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-dark p-0">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div id="navbar-collapse" class="collapse navbar-collapse">
                                <ul class="nav navbar-nav mr-auto">
                                    <li class="nav-item {{isset($active)?$active == "inicio"?"active":"":""}}"><a class="nav-link" href="{{route('site.inicio')}}">Início</a></li>

                                    <li class="nav-item {{isset($active)?$active == "post"?"active":"":""}}"><a class="nav-link" href="{{route('site.postagens')}}">Postagens</a></li>


                                    <li class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Projects <i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="projects.html">Projects All</a></li>
                                            <li><a href="projects-single.html">Projects Single</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Services <i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="services.html">Services All</a></li>
                                            <li><a href="service-single.html">Services Single</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Features <i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="typography.html">Typography</a></li>
                                            <li><a href="404.html">404</a></li>
                                            <li class="dropdown-submenu">
                                                <a href="#!" class="dropdown-toggle" data-toggle="dropdown">Parent Menu</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#!">Child Menu 1</a></li>
                                                    <li><a href="#!">Child Menu 2</a></li>
                                                    <li><a href="#!">Child Menu 3</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">News <i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="news-left-sidebar.html">News Left Sidebar</a></li>
                                            <li><a href="news-right-sidebar.html">News Right Sidebar</a></li>
                                            <li><a href="news-single.html">News Single</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item {{isset($active)?$active == "contato"?"active":"":""}}"><a class="nav-link" href="{{route('site.contato')}}">Nosso Contato</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <!--/ Col end -->
                </div>
                <!--/ Row end -->

                <div class="nav-search">
                    <span id="search"><i class="fa fa-search"></i></span>
                </div><!-- Search end -->

                <div class="search-block" style="display: none;">
                    <label for="search-field" class="w-100 mb-0">
                        <input type="text" class="form-control" id="search-field" placeholder="Type what you want and enter">
                    </label>
                    <span class="search-close">&times;</span>
                </div><!-- Site search end -->
            </div>
            <!--/ Container end -->

        </div>
        <!--/ Navigation end -->
    </header>
    <!--/ Header end -->

    @yield('conteudo_site')


    <footer id="footer" class="footer bg-overlay">
        <div class="footer-main">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-4 col-md-6 footer-widget footer-about">
                        <h3 class="widget-title">About Us</h3>
                        {{--<img loading="lazy" width="200px" class="footer-logo" src="images/footer-logo.png" alt="Constra">--}}
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor inci done idunt ut
                            labore et dolore magna aliqua.</p>
                        <div class="footer-social">
                            <ul>
                                <li><a href="https://facebook.com/themefisher" aria-label="Facebook"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com/themefisher" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li><a href="https://instagram.com/themefisher" aria-label="Instagram"><i
                                                class="fab fa-instagram"></i></a></li>
                                <li><a href="https://github.com/themefisher" aria-label="Github"><i class="fab fa-github"></i></a></li>
                            </ul>
                        </div><!-- Footer social end -->
                    </div><!-- Col end -->

                    <div class="col-lg-4 col-md-6 footer-widget mt-5 mt-md-0">
                        <h3 class="widget-title">Working Hours</h3>
                        <div class="working-hours">
                            We work 7 days a week, every day excluding major holidays. Contact us if you have an emergency, with our
                            Hotline and Contact form.
                            <br><br> Monday - Friday: <span class="text-right">10:00 - 16:00 </span>
                            <br> Saturday: <span class="text-right">12:00 - 15:00</span>
                            <br> Sunday and holidays: <span class="text-right">09:00 - 12:00</span>
                        </div>
                    </div><!-- Col end -->

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0 footer-widget">
                        <h3 class="widget-title">Services</h3>
                        <ul class="list-arrow">
                            <li><a href="service-single.html">Pre-Construction</a></li>
                            <li><a href="service-single.html">General Contracting</a></li>
                            <li><a href="service-single.html">Construction Management</a></li>
                            <li><a href="service-single.html">Design and Build</a></li>
                            <li><a href="service-single.html">Self-Perform Construction</a></li>
                        </ul>
                    </div><!-- Col end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </div><!-- Footer main end -->

        <div class="copyright">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="copyright-info text-center text-md-left">
              <span>Copyright &copy; <script>
                  document.write(new Date().getFullYear())
                </script>, Designed &amp; Developed by <a href="https://themefisher.com">Themefisher</a></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="footer-menu text-center text-md-right">
                            <ul class="list-unstyled">
                                <li><a href="about.html">About</a></li>
                                <li><a href="team.html">Our people</a></li>
                                <li><a href="faq.html">Faq</a></li>
                                <li><a href="news-left-sidebar.html">Blog</a></li>
                                <li><a href="pricing.html">Pricing</a></li>
                            </ul>
                        </div>
                    </div>
                </div><!-- Row end -->

                <div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top position-fixed">
                    <button class="btn btn-primary" title="Back to Top">
                        <i class="fa fa-angle-double-up"></i>
                    </button>
                </div>

            </div><!-- Container end -->
        </div><!-- Copyright end -->
    </footer><!-- Footer end -->


    <!-- Javascript Files
    ================================================== -->
    <script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
    <!-- Bootstrap jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="{{ asset('vendor/site/plugins/bootstrap/bootstrap.min.js') }}" defer></script>
    <!-- Slick Carousel -->
    <script src="{{ asset('vendor/site/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('vendor/site/plugins/slick/slick-animation.min.js') }}"></script>
    <!-- Color box -->
    <script src="{{ asset('vendor/site/plugins/colorbox/jquery.colorbox.js') }}"></script>
    <!-- shuffle -->
    <script src="{{ asset('vendor/site/plugins/shuffle/shuffle.min.js') }}" defer></script>


    <!-- Google Map API Key-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
    <!-- Google Map Plugin-->
    <script src="{{ asset('vendor/site/plugins/google-map/map.js') }}" defer></script>



    <!-- Template custom -->
    <script src="{{ asset('vendor/site/js/script.js') }}"></script>

</div><!-- Body inner end -->
</body>

</html>