@extends('admin.home')

@section('conteudo')

    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$titulo_tabela}}</h3>


                <div class="card-tools">
                    <a href="{{route('contrato.editar',['id'=>$contrato_id,'historico_id'=>$historico_id,'active'=>'servicos'])}}" type="button" class="btn btn-block btn-default left">Voltar</a>
                </div>
            </div>


            <div class="card-body">
                <div class="" style="padding-bottom: 10px" >
                    <form class="form-inline" action="{{route('trabalho.index',['id'=>$contrato_id,'historico_id'=>$historico_id])}}" method="get">

                        {{csrf_field()}}
                        <div class="input-group input-group-sm" style="width: 350px;">

                            <input type="text" name="nome" class="form-control float-right col-md-5" style="" placeholder="Nome">
                            <input type="text" name="email" class="form-control float-right" placeholder="Email">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 50%">Descrição</th>
                        <th style="width: 10%">Valor</th>
                        <th style="width: 10%">Autorizado</th>
                        <th style="width: 10%">Status</th>

                        <th style="width: 5%">Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contrato->historicos as $h)
                        @foreach($h->servicos as $s)
                            <tr>
                                <td>{{$s->id}}</td>
                                <td>{{$s->descricao}}</td>
                                <td>{{$s->pivot->valor}} </td>
                                <td>{{$s->pivot->autorizado}}</td>
                                <td>{{$h->status->nome}}</td>

                                <td>
                                    <a href="{{route('trabalho.index',['id'=>$contrato_id,'historico_id'=>$historico_id])}}" class="btn btn-block btn-warning btn-xs">

                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach

                    </tbody>
                </table>
                <div class="card-footer clearfix">

                </div>
            </div>


        </div>



    </div>
@stop
