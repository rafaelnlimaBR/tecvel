@extends('admin.home')

@section('content')




    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$titulo_tabela}}</h3>

                <div class="card-tools">
                    <a href="{{route('cliente.novo')}}" type="button" class="btn btn-block btn-primary btn-xs left"><i class="fa fa-solid fa-plus"></i> Novo</a>
                </div>
            </div>


            <div class="card-body">
                <div class="" style="padding-bottom: 10px" >
                    <form class="form-inline" action="{{route('cliente.index')}}" method="get">

                        {{csrf_field()}}
                        <div class="input-group input-group-sm" style="width: 350px;">

                            <input type="text" name="nome" class="form-control float-right col-md-5" style="" placeholder="Nome">
                            <input type="text" name="email" class="form-control float-right" placeholder="Email">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nome</th>
                        <th>Whatsapp</th>
                        <th>Telefone</th>
                        <th>App</th>
                        <th style="width: 40px">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clientes as $c)
                        <tr>
                            <td>{{$c->id}}</td>
                            <td>{{$c->nome}}</td>
                            <td><a href="https://wa.me/{{$c->telefone01}}" target="new">{{$c->telefone01}}</a> </td>
                            <td>{{$c->telefone02}}</td>
                            <td><a href="" class=""><i class="fa fa-telegram" aria-hidden="true"></i>a</a></td>
                            <td>
                                <a href="{{route('cliente.editar',$c->id)}}" class="btn btn-block btn-warning btn-xs">

                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="card-footer clearfix">
                    {{ $clientes->links('pagination::bootstrap-4') }}
                </div>
            </div>


        </div>



    </div>
@stop
