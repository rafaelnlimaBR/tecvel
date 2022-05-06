@extends('admin.home')

@section('conteudo')

<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fa fa-file-text-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Contratos</span>
                <span class="info-box-number">
                    {{$contratos->count()}}
                </span>
            </div>

        </div>

    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-reply" aria-hidden="true"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Saidas Hoje</span>
                <span class="info-box-number">{{$saidas_hj}}</span>
            </div>

        </div>

    </div>


    <div class="clearfix hidden-md-up"></div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fa fa-money" aria-hidden="true"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Entradas Hoje</span>
                <span class="info-box-number">{{$entradas_hj}}</span>
            </div>

        </div>

    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Clientes</span>
                <span class="info-box-number">{{$clientes->count()}}</span>
            </div>

        </div>

    </div>

</div>


<div class="row">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Novos Comentários</h3>
            </div>

            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th style="width: 50%">Cliente</th>
                        <th style="width: 30%">Data</th>

                        <th>Responder</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if($comentarios->count() != 0)
                        @foreach($comentarios as $comentario)

                            <tr>
                                <td>{{$comentario->autor->nome}}</td>
                                <td ><span style="font-size: 12px">{{date('d/m/Y H:m', strtotime($comentario->data))}}</span></td>
                                <td><a class="btn btn-primary btn-sm " style="float: right" href="{{route('comentario.editar.responder',['id'=>$comentario->id])}}"><i class="fa fa-reply" aria-hidden="true"></i></a></td>
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">Não existe comentários não visualizados</td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Novos Contatos de Clientes</h3>
            </div>

            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th style="width: 50%">Cliente</th>
                        <th style="width: 30%">Data</th>

                        <th>Responder</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if($contatos->count() != 0)
                        @foreach($contatos as $contato)

                            <tr>
                                <td>{{$contato->cliente->nome}}</td>
                                <td ><span style="font-size: 12px">{{date('d/m/Y H:m', strtotime($contato->created_at))}}</span></td>
                                <td><a class="btn btn-primary btn-sm " style="float: right" href="{{route('contato.visualizar',['id'=>$contato->id])}}"><i class="fa fa-reply" aria-hidden="true"></i></a></td>
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">Não existe contato não visualizados</td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

    <script type="text/javascript">

       /* $(document).ready(function () {
            setTimeout(function () {
                window.location.reload(1);
            }, 1000); //tempo em milisegundos. Neste caso, o refresh vai acontecer de 5 em 5 segundos.
        });*/
    </script>
@stop