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
                                <input type="text" class="form-control" placeholder="Descrição" name="descricao" value="{{$descricao}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Valor</label>
                                <input type="text" class="form-control dinheiro" name="valor" value="{{$valor_total}}">
                                <input type="hidden" value="{{$fk_id}}" name="fk_id">
                                {{csrf_field()}}

                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Tipo</label>
                                {{ Form::select('tipo', $tipos->pluck('nome','id'), null ,['class'=>'form-control tipo_pagamento','required']) }}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Taxas</label>
                                {{ Form::select('taxa', [], null ,['class'=>'form-control','required','id'=>'taxas-select']) }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">
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
                    <input type="submit" value="Faturar" class="btn btn-primary">
                    <a href="{{$route}}" type="button" value="Voltar" class="btn btn-default">Voltar</a>
                </div>
            </form>
        </div>
    </div>

</div>
@stop
