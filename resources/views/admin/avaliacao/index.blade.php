@extends('admin.home')

@section('conteudo')

    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$titulo_tabela}}</h3>


                <div class="card-tools">
                    <a href="{{route('avaliacao.novo')}}" type="button" class="btn btn-block btn-primary btn-sm left"><i class="fa fa-solid fa-plus"></i> Novo</a>
                </div>
            </div>


            <div class="card-body">

                <table class="table table-bordered tabela" id="tabela">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 10px">Sequência</th>
                        <th style="width: 65%">Cliente</th>
                        <th style="width: 10%">Habilitado</th>
                        <th style="width: 10px">Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($avaliacao as $c)
                        <tr>
                            <td>{{$c->id}}</td>
                            <td>{{$c->sequencia}}</td>
                            <td>{{$c->cliente}}</td>


                            <td>
                                @if($c->habilitado == 1)
                                    <span class='badge' style='background: green ; color: white' >Habilitado</span>
                                @else
                                    <span class='badge' style='background: red ; color: white' >Não Habilitado</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('avaliacao.editar',$c->id)}}" class="btn btn-block btn-warning btn-xs">

                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>


        </div>



    </div>
@stop
