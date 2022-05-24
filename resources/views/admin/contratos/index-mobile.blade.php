@extends('admin.home')

@section('conteudo')
    <style type="text/css">
        .col-mobile{margin: 10px}
    </style>
<div class="row ">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6 col-xxl-6 col-mobile">
        <a href="{{route('contrato.novo',['tipo'=>\App\Models\Configuracao::find(1)->ordem_servico])}}" type="button" class="btn btn-block btn-primary btn-lg ">
            <i class="fa fa-solid fa-plus fa-lg"></i> Nova Ordem
        </a>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6 col-xxl-6 col-mobile">
        <a href="{{route('contrato.novo',['tipo'=>\App\Models\Configuracao::find(1)->orcamento])}}" type="button" class="btn btn-block btn-primary btn-lg " >
            <i class="fa fa-solid fa-plus fa-lg"></i> Orçamento
        </a>
    </div>
</div>


@stop