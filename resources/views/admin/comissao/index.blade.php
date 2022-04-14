@extends('admin.home')

@section('conteudo')

    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$titulo_tabela}}</h3>


                <div class="card-tools">

                </div>
            </div>


            <div class="card-body">
                <div class="" style="padding-bottom: 10px" >
                    <form class="form-inline" action="{{route('pedido.index')}}" method="get">

                        {{csrf_field()}}
                        <div class="input-group input-group-sm" style="width: 350px;">

                            <input type="text" name="descricao" class="form-control float-right col-md-5" style="" placeholder="Descrição">
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
                        <th style="width: 20%">Numero do pedido</th>
                        <th>Fornecedor</th>
                        <th style="width: 15%">Data do pedido</th>
                        <th style="width: 40px">Editar</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($pedidos as $c)
                        <tr>

                            <td>{{$c->id}}</td>
                            <td>{{$c->numero_pedido}}</td>
                            <td>{{$c->fornecedor->nome}}</td>
                            <td>{{date('d/m/Y H:m', strtotime($c->data))}}</td>

                            <td>
                                <a href="{{route('pedido.editar',$c->id)}}" class="btn btn-block btn-warning btn-xs">

                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="card-footer clearfix">
                    {{ $pedidos->links('pagination::bootstrap-4') }}
                </div>
            </div>


        </div>



    </div>
@stop
