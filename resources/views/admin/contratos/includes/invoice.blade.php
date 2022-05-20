@extends('admin.home')

@section("conteudo")
    <div class="invoice p-3 mb-3">

        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> {{$contrato->historicos->last()->tipo->descricao}}
                    <small class="float-right">{{date('d/m/Y', strtotime(\Carbon\Carbon::now()))}}</small>
                </h4>
            </div>

        </div>

        <div class="row invoice-info">
            <div class="col-sm-3 invoice-col">
                @if($conf->logo != "")
                    <img loading="lazy" style="height: 100px; margin:35px 0 0 15px"  src="{{url('imagens/'.$conf->logo)}}" alt="logo-tecvel">
                @endif
            </div>
            <div class="col-sm-3 invoice-col">
                Dados
                <address>
                    <strong>{{$conf->nome_empresa}}</strong><br>
                    {{$conf->endereco}}<br>
                    Telefone: {{$conf->telefone_movel}}<br>
                    Email: {{$conf->email}}<br>

                </address>
            </div>

            <div class="col-sm-3 invoice-col">
                Cliente
                <address>
                    <strong>{{$contrato->cliente->nome}}</strong><br>
                    {{$contrato->cliente->telefone01}}<br>
                    Email: {{$contrato->cliente->email}}<br>

                </address>
            </div>

            <div class="col-sm-3 invoice-col">
                <b>ID #{{$contrato->id}}</b><br>
                <b>Data: </b>{{date('d/m/Y', strtotime($contrato->data))}}
                @if($contrato->historicos->last()->tipo->id != $conf->orcamento)
                <br>
                 <b>Garantia: </b> {{date('d/m/Y', strtotime($contrato->data_fim_garantia))}}
                @endif
                <br>


            </div>

        </div>
        @if($contrato->qntServicos() >= 1)
        <div class="row">
            <div class="col-12 table-responsive">


                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Serviço
                            @if($contrato->historicos->last()->tipo->id != $conf->orcamento)
                                | <b>TOTAL: R$ {{$contrato->TotalServicoAutorizadoSemDesconto()}}</b>
                            @endif
                        </th>
                        <th style="width: 20%">Valor</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if($contrato->historicos->last()->tipo->id != $conf->orcamento)
                        @foreach($contrato->historicos as $h)
                            @if($h->tipo->id != $conf->orcamento)
                                @foreach($h->servicos as $servico)
                                    <tr>
                                        <td style="{{$servico->pivot->autorizado == 0?"text-decoration:line-through":""}};">{{$servico->descricao}}</td>
                                       <td style="{{$servico->pivot->autorizado == 0?"text-decoration:line-through":""}};">R$ {{$servico->pivot->valor}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    @else
                        @foreach($contrato->historicos->last()->servicos as $servico)
                            <tr>
                                <td>{{$servico->descricao}}</td>
                                <td>R$ {{$servico->pivot->valor}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>

        </div>
        @endif
        @if($contrato->qntPecas() >= 1)
        <div class="row">
            <div class="col-12 table-responsive">


                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Peça
                            @if($contrato->historicos->last()->tipo->id != $conf->orcamento)
                                | <b>TOTAL: R$ {{$contrato->TotalPecasAutorizadoSemDesconto()}}</b>
                            @endif
                        </th>
                        <th>Qnt</th>
                        <th>Valor</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($contrato->historicos->last()->tipo->id != $conf->orcamento)
                        @foreach($contrato->historicos as $h)
                            @foreach($h->pecas as $peca)
                                <tr>
                                    <td style="{{$peca->pivot->autorizado == 0?"text-decoration:line-through":""}};">{{$peca->descricao}}</td>
                                    <td style="{{$peca->pivot->autorizado == 0?"text-decoration:line-through":""}};">{{$peca->pivot->qnt}}</td>
                                    <td style="{{$peca->pivot->autorizado == 0?"text-decoration:line-through":""}};">R$ {{$peca->pivot->valor}}</td>
                                    <td style="{{$peca->pivot->autorizado == 0?"text-decoration:line-through":""}};">R$ {{$peca->pivot->valor*$peca->pivot->qnt}}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @else
                        @foreach($contrato->historicos->last()->pecas as $peca)
                            <tr>
                                <td>{{$peca->descricao}}</td>
                                <td>{{$peca->pivot->qnt}}</td>
                                <td>R$ {{$peca->pivot->valor}}</td>
                                <td>R$ {{$peca->pivot->valor*$peca->pivot->qnt}}</td>
                            </tr>
                        @endforeach

                    @endif
                    </tbody>
                </table>
            </div>

        </div>
        @endif
        <div class="row">

            <div class="col-6">
                <p class="lead">Forma de Pagamentos:</p><br>
                <p>Pix, Cartão de crédito, Débito, Dinheiro</p>

            </div>

            <div class="col-6" >
                <p class="lead">Valores</p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>R$ {{$contrato->totalServicoAutorizadoSemDesconto()+$contrato->TotalPecasAutorizadoSemDesconto()}}</td>
                            </tr>
                            @if($contrato->qntServicos() >= 1)
                            <tr>
                                <th>Serviços {{$contrato->desconto_servico == 0?"":'('.$contrato->desconto_servico.'%)'}}</th>
                                <td>R$ {{$contrato->totalServicoAutorizadoComDesconto() .($contrato->desconto_servico==0?"":" (R$ ".$contrato->TotalServicoAutorizadoSemDesconto().")")}} </td>
                            </tr>
                            @endif
                            @if($contrato->qntPecas() >= 1)
                            <tr>
                                <th>Peças {{$contrato->desconto_peca == 0?"":'('.$contrato->desconto_peca.'%)'}}</th>
                                <td>R$ {{$contrato->TotalPecasAutorizadoComDesconto()}} {{($contrato->desconto_peca==0?"":" (R$ ".$contrato->$contrato->TotalPecasAutorizadoSemDesconto().")")}}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Total:</th>
                                <td>R$ {{$contrato->totalPecasAutorizadoComDesconto()+$contrato->totalServicoAutorizadoComDesconto()}}</td>
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