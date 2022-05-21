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
                    {{--<form class="form-inline" action="{{route('contrato.index')}}" method="get">

                        {{csrf_field()}}
                        <div class="input-group input-group-sm" style="width: 350px;">

                            <input type="text" name="cliente" class="form-control float-right col-md-4" style="" placeholder="Cliente">

                        </div>
                        <div class="input-group input-group-sm" style="width: 350px;">

                            <input type="text" name="veiculo" class="form-control float-right col-md-4" style="" placeholder="Placa">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>--}}
                </div>
                <table class="table table-bordered " id="tabela-contratos">
                    <thead>
                    <tr>
                        <th style="width: 5%">ID</th>
                        <th style="width: 40%">Cliente</th>
                        <th style="width: 20%">Veículo</th>
                        <th style="width: 25%">Data</th>
                        <th style="width: 15%">Tipo</th>
                        <th style="width: 10%">Status</th>
                        <th style="width: 10%">Pagamento</th>
                        <th style="width: 10%">Total</th>
                        <th style="width: 10%">Invoice</th>
                        <th style="width: 5%">Entrar</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($contratos as $c)
                        <tr>

                            <td>{{$c->id}}</td>
                            <td>{{$c->cliente->nome}}</td>
                            <td>{{$c->veiculo->placa}}</td>
                            <td><span style="font-size: 14px">{{date('d/m/Y H:m', strtotime($c->data))}}</span></td>
                            <td>{{$c->historicos->last()->tipo->descricao}}</td>
                            <td><span class="badge" style="background: {{$c->status->last()->cor}}; color: white" >{{$c->historicos->last()->status->nome}}</span></td>
                            <td>
                                @if($c->verificarPagamento() == 0)
                                    <span class='badge' style='background: #148f14 ; color: white' >PAGO</span>
                                @elseif($c->verificarPagamento()> 0)
                                    <span class='badge' style='background: #bb291a ; color: white' >PENDENTE</span>

                                @else
                                    <span class='badge' style='background: #3878ab ; color: white' >SUPER</span>
                                @endif
                            </td>
                            <td>
                                {{$c->valorTotal()}}
                            </td>
                            <td>
                                <a href="{{route('historico.invoice',['id'=>$c->id])}}" class="btn btn-success btn-sm">
                                    <i class="fa-solid fa-print fa-sm"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('contrato.editar',['id'=>$c->id,'historico_id'=>$c->historicos->last()->id,'tela'=>"dados"])}}" class="btn btn-block btn-primary btn-xs">

                                    <i class="fa fa-solid fa-arrow-right"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="card-footer clearfix">

                </div>
            </div>


        </div>



    </div>
@stop
