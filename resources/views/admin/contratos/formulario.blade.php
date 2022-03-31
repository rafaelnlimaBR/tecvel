@extends('admin.home')

@section("conteudo")

@if(Session::has('active'))
    @php
    $active = Session::get('active');
    @endphp
@endif


    <div class="col-12 col-sm-12">
        <div class="card card-secondary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                    <li class="pt-2 px-3"><h3 class="card-title">{{isset($contrato)?$historico->status->nome:$titulo_formulario}}</h3></li>
                    <li class="nav-item">
                        <a class="nav-link {{isset($active)?'':"active"}}" id="dados-tab" data-toggle="pill" href="#dados" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Dados</a>
                    </li>
                    @if(isset($contrato))


                    <li class="nav-item">
                        <a class="nav-link {{isset($active)?$active == "historicos"?"active":"":""}}" id="historicos-tab" data-toggle="pill" href="#historicos" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Historicos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{isset($active)?$active == "servicos"?"active":"":""}}" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#servicos" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Serviços</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-two-pecas-tab" data-toggle="pill" href="#custom-tabs-two-pecas" role="tab" aria-controls="custom-tabs-two-pecas" aria-selected="false">Peças</a>
                    </li>

                    @endif
                </ul>

            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                    <div class="tab-pane fade {{isset($active)?'':"show active"}}" id="dados" role="tabpanel" aria-labelledby="dados-tab">
                        <form action="{{isset($contrato)?route('contrato.atualizar'):route("contrato.cadastrar")}}" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label>Cliente <a class="" data-toggle="modal" data-target="#modalCliente"> Novo</a></label>
                                    {{ Form::select('cliente', (isset($contrato)?[$contrato->cliente->id=>$contrato->cliente->nome]:[null=>"Selecione um Cliente"]), null ,['class'=>'form-control clientes_select2','required']) }}
                                    <input type="hidden" name="tipo_contrato" value="{{isset($tipo_contrato)?$tipo_contrato:''}}">
                                    <input type="hidden" name="contrato_id" value="{{isset($contrato)?$contrato->id:''}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Veiculo <a class="" data-toggle="modal" data-target="#modalVeiculo"> Novo</a></label>
                                    {{ Form::select('veiculo', (isset($contrato)?[$contrato->veiculo->id=>$contrato->veiculo->placa]:[null=>"Selecione um Veiculo"]), null ,['class'=>'form-control veiculo_select2','required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Defeito</label>
                                    <textarea  class="form-control" id="defeito" name="defeito"  value="{{isset($contrato)?$contrato->defeito:""}}">{{isset($contrato)?$contrato->defeito:""}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Observações</label>
                                    <textarea  class="form-control" id="obs" name="obs"  value="{{isset($contrato)?$contrato->obs:""}}">{{isset($contrato)?$contrato->obs:""}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Data</label>
                                    <div class="input-group date dataTempo" id="dataTempo" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" name="data" data-target=".dataTempo"  value="{{isset($contrato)?date('dd/mm/YYYY H:i',strtotime($contrato->data)):\Carbon\Carbon::now()->format('dd/mm/YYYY H:i')}}"/>
                                        <div class="input-group-append" data-target=".dataTempo" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Garantia</label>

                                    {{Form::select('garantia', [0=>"Sem Garantia",30=>'30 Dias',90=>'90 Dias',180=>'180 Dias'], (isset($contrato)?$contrato->garantia:90),['class'=>'form-control'])}}

                                </div>
                            </div>
                        </div>
                            @if(isset($contrato))
                                <button type="submit" class="btn btn-warning">Atualizar</button>
                            @else
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            @endif
                        </form>
                    </div>
                    @if(isset($contrato))
                    <div class="tab-pane fade {{isset($active)?$active == "historicos"?"show active":"":""}}" id="historicos" role="tabpanel" aria-labelledby="historicos-tab">
                        @include('admin.contratos.includes.tabelaHistoricos')
                    </div>
                    <div class="tab-pane fade {{isset($active)?$active == "servicos"?"show active":"":""}}" id="servicos" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                        <form action="{{route('historico.cadastrar.servico')}}" method="post" name="form-adicionar-servico">



                            <div class="row">
                                <div class="col-sm-4">

                                    <div class="form-group">
                                        <label>Serviços <a class="" data-toggle="modal" data-target="#modalServico"> Novo</a></label>
                                        {{ Form::select('servico_id', [], null ,['class'=>'form-control selectServicos ','id'=>'selectServicos','required']) }}
                                        {{csrf_field()}}
                                        <input type="hidden" name="historico_id" value="{{$historico->id}}">
                                        <input type="hidden" name="contrato_id" value="{{$contrato->id}}">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Valor</label>
                                        <input class="form-control dinheiro" type="text" name="valor" id="valorServico" placeholder="Valor">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Autorizado</label>
                                        <select class="form-control "  name="autorizado"  >
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Adicionar</label>
                                        <button class="form-control btn btn-primary" type="submit"  >Adicionar</button>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Todos</label>
                                        <a class="form-control btn btn-default" href="{{route('trabalho.index',['id'=>$contrato->id,'historico_id'=>$historico->id])}}">Todos</a>
                                    </div>
                                </div>
                            </div>
                        </form>

                        @include('admin.contratos.includes.tabelaServicos')
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-two-pecas" role="tabpanel" aria-labelledby="custom-tabs-two-pecas-tab">
                        <form action="{{route('peca.cadastrar')}}" method="post" name="form-adicionar-peca">



                            <div class="row">
                                <div class="col-sm-3">

                                    <div class="form-group">
                                        <label>Descrição </label>
                                        <input type="text" class="form-control" name="descricao" placeholder="Descrição">
                                        {{csrf_field()}}
                                        <input type="hidden" name="historico_id" value="{{$historico->id}}">
                                        <input type="hidden" name="contrato_id" value="{{$contrato->id}}">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group" style="">
                                        <label>Valor Fornecedor</label>
                                        <input class="form-control dinheiro" type="text" name="valor_fornecedor" id="" placeholder="Valor Fornecedor">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Valor</label>
                                        <input class="form-control dinheiro" type="text" name="valor" id="valorPeca" placeholder="Valor">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Qnt</label>
                                        <input class="form-control" type="number" name="qnt" placeholder="Qnt">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label>Autori</label>
                                        <select class="form-control "  name="autorizado"  >
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Add</label>
                                        <button class="form-control btn btn-primary" type="submit"  >Adicionar</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        @include('admin.contratos.includes.tabelaPecas')
                    </div>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('contrato.index')}}" class="btn btn-default" style="border-color: rgba(105,105,106,0.85); color: rgba(72,72,73,0.85); font-weight: bolder; box-shadow: 5px 5px 5px rgba(5, 0, 0, 0.3)">Voltar</a>
                @if(isset($contrato))

                    @if($contrato->historicos->last()->tipo->id == \App\Models\Configuracao::find(1)->orcamento and $contrato->status->last()->id != \App\Models\Configuracao::find(1)->nao_autorizado)

                        <button status_id="{{\App\Models\Configuracao::find(1)->autorizado}}" type="button" class="btn btn-primary modalAtualizarStatus" data-toggle="modal" data-target="#modalStatus" style="background-color: {{\App\Models\Status::find(\App\Models\Configuracao::find(1)->autorizado)->cor}}; border-color: rgba(105,105,106,0.85); color: white; font-weight: bolder; box-shadow: 5px 5px 5px rgba(5, 0, 0, 0.3)">
                           Autorizadar
                        </button>
                        <button status_id="{{\App\Models\Configuracao::find(1)->nao_autorizado}}" type="button" class="btn btn-primary modalAtualizarStatus" data-toggle="modal" data-target="#modalStatus" style="background-color: {{\App\Models\Status::find(\App\Models\Configuracao::find(1)->nao_autorizado)->cor}}; border-color: rgba(105,105,106,0.85); color: white; font-weight: bolder; box-shadow: 5px 5px 5px rgba(5, 0, 0, 0.3)">
                            Não Autorizadar
                        </button>


                        <!-- Modal -->


                        {{--    Tela Não autorizado--}}

                    @else
                        @foreach($contrato->status->last()->proximos as $status)

                            <button status_id="{{$status->id}}" type="button" class="btn btn-primary modalAtualizarStatus" data-toggle="modal" data-target="#modalStatus" style="background-color: {{$status->cor}}; border-color: rgba(105,105,106,0.85); color: white; font-weight: bolder; box-shadow: 5px 5px 5px rgba(5, 0, 0, 0.3)">
                                {{$status->nome}}
                            </button>

                        @endforeach

                    @endif

                        @include('admin.contratos.includes.modalAtualizarStatus',['contrato_id'=>$contrato->id])
                @endif

            </div>

        </div>
    </div>





    <!-- Modal -->




    <!-- Tela Cliente -->
    @include('admin.clientes.includes.modalNovoCliente')
{{--    Tela Veiculo--}}
    @include('admin.veiculos.includes.modalNovoVeiculo')

{{--    Tela de Servicos--}}
    @include('admin.servicos.includes.modalNovoServico')


@stop
