@extends('admin.home')

@section("conteudo")
    <div class="invoice p-3 mb-3">

        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> {{$conf->nome_empresa}}
                    <small class="float-right">Data: {{date('d/m/Y', strtotime($contrato->data))}}</small>
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
                    <strong>{{$contrato->cliente->nome}}</strong><br>
                    {{$contrato->cliente->telefone01}}<br>
                    Email: {{$contrato->cliente->email}}<br>

                </address>
            </div>

            <div class="col-sm-4 invoice-col">
                <b>ID #{{$contrato->id}}</b><br>
                <br>
                <b>Pagamentos:</b>
                comentado
                <br>

            </div>

        </div>


        <div class="row">
            <div class="col-12 table-responsive">
                <h5>Serviços</h5>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Serviço</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contrato->historicos as $h)
                        @foreach($h->servicos as $s)
                            <tr>
                                <td>{{$s->descricao}}</td>
                                <td>{{$s->pivot->valor}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="row">
            <div class="col-12 table-responsive">
                <h5>Peças</h5>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Peça</th>
                        <th>Qnt</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contrato->historicos as $h)
                        @foreach($h->pecas as $p)
                            <tr>
                                <td>{{$p->descricao}}</td>
                                <td>{{$p->pivot->qnt}}</td>
                                <td>{{$p->pivot->valor}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="row">

            <div class="col-6">
                <p class="lead">Payment Methods:</p>
                <img src="../../dist/img/credit/visa.png" alt="Visa">
                <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                <img src="../../dist/img/credit/american-express.png" alt="American Express">
                <img src="../../dist/img/credit/paypal2.png" alt="Paypal">
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                </p>
            </div>

            <div class="col-6">
                <p class="lead">Amount Due 2/22/2014</p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody><tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>$250.30</td>
                        </tr>
                        <tr>
                            <th>Tax (9.3%)</th>
                            <td>$10.34</td>
                        </tr>
                        <tr>
                            <th>Shipping:</th>
                            <td>$5.80</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>$265.24</td>
                        </tr>
                        </tbody></table>
                </div>
            </div>

        </div>


        <div class="row no-print">
            <div class="col-12">
                <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                </button>
                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                </button>
            </div>
        </div>
    </div>

@stop