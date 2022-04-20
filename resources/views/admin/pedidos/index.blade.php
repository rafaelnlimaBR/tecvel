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

                <table class="table table-bordered" id="tabela">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 20%">Numero do pedido</th>
                        <th style="width: 25%">Fornecedor</th>
                        <th style="width: 25%">Data do pedido</th>
                        <th>Pagamento</th>
                        <th style="width: 5px">Editar</th>
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

                                @if($c->pagamentos()->sum('valor') == $c->valorTotalDesconto())
                                    <span class="badge" style="background: #148f14 ; color: white" >PAGO</span>
                                @elseif($c->pagamentos()->sum('valor') > $c->valorTotalDesconto())
                                    <span class="badge" style="background: #3878ab ; color: white" >SUPER</span>
                                @else
                                    <span class="badge" style="background: #bb291a ; color: white" >PENDENTE</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('pedido.editar',['id'=>$c->historico->contrato->id,'historico_id'=>$c->historico->id,'pedido_id'=>$c->id])}}" class="btn btn-block btn-warning btn-xs">

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
