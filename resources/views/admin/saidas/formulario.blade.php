@extends('admin.home')

@section("conteudo")

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card card-primary">
                <form action="{{$action}}" method="post" name="faturar">
                    <div class="card-header">
                        <h3 class="card-title">{{$titulo_formulario}}</h3>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-12">

                                <div class="form-group">
                                    <label>Descrição</label>
                                    <input type="text" class="form-control" placeholder="Descrição" name="descricao" value="{{isset($pagamento)?$pagamento->descricao:$descricao}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Valor</label>
                                    <input type="text" class="form-control " name="valor" value="{{isset($pagamento)?$pagamento->valor:$valor}}">
                                    <input type="hidden" value="{{$fk_id}}" name="fk_id">
                                    {{csrf_field()}}

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    {{ Form::select('tipo', $tipos->pluck('nome','id'), isset($pagamento)?$pagamento->taxa->formaPagamento->id:null ,['class'=>'form-control tipo_pagamento','required']) }}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Taxas</label>
                                    {{ Form::select('taxa', isset($pagamento)?$taxas->pluck('nome','id'):[], isset($pagamento)?$pagamento->taxa->id:null ,['class'=>'form-control','required','id'=>'taxas-select']) }}
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

                        </div>

                    </div>

                    <div class="card-footer">
                        <a href="{{$route}}" type="button" value="Voltar" class="btn btn-default">Voltar</a>
                        @if(isset($pagamento))

                            <input type="submit" value="Editar" class="btn btn-primary">
                            <input type="hidden" value="{{$pagamento->id}}" name="pagamento_id">
                            <button type="button" class="btn btn-danger " style="float: right" data-toggle="modal" data-target="#modalExcluirFatura">
                                Excluir
                            </button>
                        @else
                            <input type="submit" value="Faturar" class="btn btn-primary">
                        @endif


                    </div>
                </form>
            </div>
        </div>

    </div>

    @if(isset($pagamento))
        <form method="post" action="{{$action_excluir}}">
            <div class="modal fade" id="modalExcluirFatura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Excluir Registro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" value="{{$pagamento->id}}" name="pagamento_id">
                            <input type="hidden" value="{{$fk_id}}" name="fk_id">
                            {{csrf_field()}}
                            Deseja Excluir esse registro?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    @endif

@stop
