<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$titulo}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Font Awesome Icons -->

    <!-- IonIcons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    {{--<script src="{{ asset('dist/css/adminlte.css') }}"></script>--}}
    @include('admin.includes.css')

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    @if($comentarios->count() > 0)
                    <span class="badge badge-danger navbar-badge">{{$comentarios->count()}}</span>
                    @endif
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    @foreach($comentarios as $comentario)
                        <a href="{{route('comentario.editar',['id'=>$comentario->id])}}" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">

                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{$comentario->autor->nome}}
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">{{substr($comentario->texto,0,50)}}</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{$comentario->diferencaTempo()}}</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                    @endforeach

                    <div class="dropdown-divider"></div>

                    <a href="" class="dropdown-item dropdown-footer">Veja todos</a>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">

                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    @if($contatos->count() > 0)
                    <span class="badge badge-warning navbar-badge">{{$contatos->count()}}</span>
                    @endif
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>

                    @foreach($contatos as $contato)
                        <a href="{{route('contato.visualizar',['id'=>$contato->id])}}" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> {{$contato->cliente->nome}}
                            <p class="text-sm">{{substr($contato->mensagem,0,50)}}</p>
                            <span class="float-right text-muted text-sm">{{$contato->diferencaTempo()}}</span>
                        </a>

                    @endforeach
                    <a href="{{route('contato.index')}}" class="dropdown-item dropdown-footer">Ver todos</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('sair')}}" role="button">
                  Sair
                </a>
            </li>
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">--}}
                    {{--<i class="fas fa-th-large"></i>--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.includes.menu')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$titulo}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                    @include('admin.includes.alertas')
                    @yield('conteudo')
                    <!-- /.col-md-6 -->

                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2022-{{now()->year}} <a target="_new" href="https://www.instagram.com/rafael_nlima/">Rafael N. Lima</a>.</strong>
        Todos direitos reservados
        <div class="float-right d-none d-sm-inline-block">
            {{--<b>Version</b> 3.2.0--}}
        </div>
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
<!-- Bootstrap -->

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
{{--<script src="{{ asset('vendor/adminlte/dist/js/adminlte.js') }}"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
<!-- OPTIONAL SCRIPTS -->

<script src="{{ asset('plugins/plugins/moment/moment.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>

<script src="{{ asset('vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js') }}"></script>

<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
@include('admin.includes.scripts')

<!-- AdminLTE for demo purposes -->
{{--<script src="{{asset('dist/js/demo.js')}}"></script>--}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<script src="{{asset('dist/js/pages/dashboard3.js')}}"></script>
</body>
</html>
