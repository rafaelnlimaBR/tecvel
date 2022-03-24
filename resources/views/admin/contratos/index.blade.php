@extends('admin.home')

@section('conteudo')

    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$titulo_tabela}}</h3>
                <div class="card-tools" style="padding-left: 10px">
                    <a href="{{route('contrato.novo',['tipo'=>\App\Models\Configuracao::find(1)->ordem_servico])}}" type="button" class="btn btn-block btn-primary btn-sm ">
                        <i class="fa fa-solid fa-plus"></i> Nova Ordem
                    </a>

                </div>
                <div class="card-tools" style="padding-right: 10px">
                    <a href="{{route('contrato.novo',['tipo'=>\App\Models\Configuracao::find(1)->orcamento])}}" type="button" class="btn btn-block btn-primary btn-sm " >
                        <i class="fa fa-solid fa-plus"></i> Orçamento
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="" style="padding-bottom: 10px" >
                    <form class="form-inline" action="{{route('contrato.index')}}" method="get">

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
                        <th style="width: 5%">ID</th>
                        <th style="width: 40%">Cliente</th>
                        <th style="width: 20%">Veículo</th>
                        <th style="width: 20%">Data</th>
                        <th style="width: 20%">Tipo</th>
                        <th style="width: 10%">Status</th>
                        <th style="width: 5%">Editar</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($contratos as $c)
                        <tr>

                            <td>{{$c->id}}</td>
                            <td>{{$c->cliente->nome}}</td>
                            <td>{{$c->veiculo->placa}}</td>
                            <td>{{date('d/m/Y H:m', strtotime($c->data))}}</td>
                            <td>{{$c->historicos->last()->tipo->descricao}}</td>
                            <td>{{$c->status->last()->nome}}</td>
                            <td>
                                <a href="{{route('contrato.editar',$c->id)}}" class="btn btn-block btn-warning btn-xs">

                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="card-footer clearfix">
                    {{ $contratos->links('pagination::bootstrap-4') }}
                </div>
            </div>


        </div>



    </div>
@stop
