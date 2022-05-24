<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">

        <img src="{{url('/imagens/'.$conf->logo)}}" alt="Tecvel-logo" class="brand-image  elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">TECVEL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{--<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">--}}
            </div>
            <div class="info">
                @if(auth()->check())
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
                @endif
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{--<div class="form-inline">--}}
            {{--<div class="input-group" data-widget="sidebar-search">--}}
                {{--<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">--}}
                {{--<div class="input-group-append">--}}
                    {{--<button class="btn btn-sidebar">--}}
                        {{--<i class="fas fa-search fa-fw"></i>--}}
                    {{--</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <!-- Sidebar Menu -->
        @if(isset($menu_open))
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item ">
                    <a href="{{route('home')}}" class="nav-link {{$menu_open=="dashboard"?"active":""}}">
                        <i class="nav-icon fas fa-dashboard"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{route('cliente.index')}}" class="nav-link {{$menu_open=="clientes"?"active":""}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Clientes
                            {{--<span class="right badge badge-danger">New</span>--}}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('veiculo.index')}}" class="nav-link  {{$menu_open=="veiculos"?"active":""}}">
                        <i class="nav-icon fas fa-car"></i>
                        <p>
                            Veiculos
                            {{--<span class="right badge badge-danger">New</span>--}}
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{route('fornecedor.index')}}" class="nav-link {{$menu_open=="fornecedores"?"active":""}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Fornecedores
                            {{--<span class="right badge badge-danger">New</span>--}}
                        </p>
                    </a>
                </li>
                <li class="nav-item {{$menu_open=="contratos"?"menu-is-opening menu-open":""}}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Contrato
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('contrato.index')}}" class="nav-link {{isset($menu_active)?$menu_active=="contratos"?"active":"":""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contrato</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('pedido.index')}}" class="nav-link {{isset($menu_active)?$menu_active=="pedidos"?"active":"":""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pedidos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('servico.index')}}" class="nav-link {{isset($menu_active)?$menu_active=="servicos"?"active":"":""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Serviços</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('status.index')}}" class="nav-link {{isset($menu_active)?$menu_active=="status"?"active":"":""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Status</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item {{$menu_open=="site"?"menu-is-opening menu-open":""}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Site
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('post.index')}}" class="nav-link {{isset($menu_active)?$menu_active=="posts"?"active":"":""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Postagens</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('contato.index')}}" class="nav-link {{isset($menu_active)?$menu_active=="contatos"?"active":"":""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contatos</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('banner.index')}}" class="nav-link {{isset($menu_active)?$menu_active=="banner"?"active":"":""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banner</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('avaliacao.index')}}" class="nav-link {{isset($menu_active)?$menu_active=="avaliacoes"?"active":"":""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Avaliações</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('categoria.index')}}" class="nav-link {{isset($menu_active)?$menu_active=="categorias"?"active":"":""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categorias</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-header">SISTEMA</li>
                <li class="nav-item">
                    <a href="{{route('configuracao.editar')}}" class="nav-link">
                        <i class="nav-icon fas fa-gear"></i>
                        <p>
                            Configurações

                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        @endif
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>