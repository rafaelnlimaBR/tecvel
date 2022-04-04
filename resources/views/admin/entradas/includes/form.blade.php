

<div class="card card-warning">
    <form action="{{$route}}" method="post" name="faturar">
        <div class="card-header">
            <h3 class="card-title">General Elements</h3>
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
                        {{ Form::select('taxa', [0=>"Selecione uma taxa"], null ,['class'=>'form-control','required','id'=>'taxas-select']) }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Data</label>
                        <input type="text" class="form-control dataTempo" name="data" value="{{\Carbon\Carbon::now()->format('d/m/Y H:i')}}">
                    </div>
                </div>

            </div>

        </div>

        <div class="card-footer">
            <input type="submit" value="Faturar" class="bt btn-primary">
            <a type="button" value="Voltar" class="btn btn-default">Voltar</a>
        </div>
    </form>
</div>


