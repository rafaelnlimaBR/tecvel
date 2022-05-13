@extends('admin.home')

@section("conteudo")
    <div class="invoice p-3 mb-3">

        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> {{$historico->tipo->nome}}
                    <small class="float-right">{{date('d/m/Y', strtotime(\Carbon\Carbon::now()))}}</small>
                </h4>
            </div>

        </div>

        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                Dados
                <address>
                    <strong>{{$conf->nome_empresa}}</strong><br>
                    {{$conf->endereco}}<br>
                    Telefone: {{$conf->telefone_movel}}<br>
                    Email: {{$conf->email}}<br>

                </address>
            </div>

            <div class="col-sm-4 invoice-col">
                Cliente
                <address>
                    <strong>{{$historico->contrato->cliente->nome}}</strong><br>
                    {{$historico->contrato->cliente->telefone01}}<br>
                    Email: {{$historico->contrato->cliente->email}}<br>

                </address>
            </div>

            <div class="col-sm-4 invoice-col">
                <b>ID #{{$historico->contrato->id}}</b><br>
                <b>Data: </b>{{date('d/m/Y', strtotime($historico->contrato->data))}}
                <br>


            </div>

        </div>


        <div class="row">
            <div class="col-12 table-responsive">
                <h5>Serviços | <b>TOTAL: R$ {{$contrato->totalServicoSemDesconto()}}</b></h5>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Serviço</th>
                        <th style="width: 20%">Valor</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contrato->historicos as $h)
                        @foreach($h->servicos as $s)
                            <tr>
                                <td>{{$s->descricao}}</td>
                               <td>R$ {{$s->pivot->valor}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="row">
            <div class="col-12 table-responsive">
                <h5>Peças | <b>TOTAL: R$ {{$contrato->TotalPecasSemDesconto()}}</b></h5>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Peça</th>
                        <th>Qnt</th>
                        <th>Valor</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contrato->historicos as $h)
                        @foreach($h->pecas as $p)
                            <tr>
                                <td>{{$p->descricao}}</td>
                                <td>{{$p->pivot->qnt}}</td>
                                <td>R$ {{$p->pivot->valor}}</td>
                                <td>R$ {{$p->pivot->valor*$p->pivot->qnt}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="row">

            <div class="col-6">
                <p class="lead">Forma de Pagamentos:</p><br>
                <p>Pix, Cartão de crédito, Débito, Dinheiro</p>

            </div>

            <div class="col-6">
                <p class="lead">Valores</p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>R$ {{$contrato->totalServicoSemDesconto()+$contrato->TotalPecasSemDesconto()}}</td>
                            </tr>
                            @if($contrato->qntServicos() >= 1)
                            <tr>
                                <th>Serviços {{$contrato->desconto_servico == 0?"":'('.$contrato->desconto_servico.'%)'}}</th>
                                <td>R$ {{$contrato->totalServicoComDesconto() .' (R$ '.$contrato->TotalServicoSemDesconto().')'}} </td>
                            </tr>
                            @endif
                            @if($contrato->qntPecas() >= 1)
                            <tr>
                                <th>Peças {{$contrato->desconto_peca == 0?"":'('.$contrato->desconto_peca.'%)'}}</th>
                                <td>R$ {{$contrato->totalPecasComDesconto()}} (R$ {{$contrato->TotalPecasSemDesconto()}})</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Total:</th>
                                <td>R$ {{$contrato->totalPecasComDesconto()+$contrato->totalServicoComDesconto()}}</td>
                            </tr>
                            <tr>
                                @if($contrato->qntPagamentos() >= 1)

                                   <th>Pagamento:</th>
                                    <td>R$ {{$contrato->valorTotalPagamentos()}}</td>
                                @endif


                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


        <div class="row no-print">
            <div class="col-12">
                <a href="" rel="noopener" target="_blank" class="btn btn-default printPage"><i class="fas fa-print"></i> Print</a>
                <a href="{{route('contrato.index')}}" rel="noopener" target="" class="btn btn-default"> Voltar</a>
               {{-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                </button>--}}
                {{--<button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                </button>--}}
            </div>
        </div>
    </div>
<script type="text/javascript">
    $('.printPage').click(function(){
        window.print();
        return false;
    });
</script>
@stop