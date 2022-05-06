@extends('admin.home')

@section('conteudo')
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$titulo_tabela}}</h3>



            </div>


            <div class="card-body">

                <table class="table table-bordered" id="tabela">
                    <thead>
                    <tr>

                        <th style="width: 50%">Cliente</th>
                        <th style="width: 20%">Data</th>
                        <th style="width: 20%">Visualizado</th>
                        <th style="width: 2px">Entrar</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($contatos as $c)
                        <tr>
                            <td>{{$c->cliente->nome}}</td>
                            <td>{{date('d/m/Y H:m', strtotime($c->created_at))}}</td>
                            <td>
                                @if($c->visualizado == 1)
                                    <span class='badge' style='background: green ; color: white' >Visualizado</span>
                                @else
                                    <span class='badge' style='background: red ; color: white' >Não Visualizado</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('contato.visualizar',['id'=>$c->id])}}" class="btn btn-block btn-primary btn-xs">

                                    <i class="fas fa-fw fa-share "></i>
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
