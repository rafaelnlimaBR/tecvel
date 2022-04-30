@extends('admin.home')

@section('conteudo')

    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$titulo_tabela}}</h3>


                <div class="card-tools">
                    <a href="{{route('post.novo')}}" type="button" class="btn btn-block btn-primary btn-sm left"><i class="fa fa-solid fa-plus"></i> Novo</a>
                </div>
            </div>


            <div class="card-body">

                <table class="table table-bordered" id="tabela">
                    <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 50%">Título</th>
                        <th style="width: 20%">Data</th>
                        <th style="width: 20%">Habilitado</th>
                        <th style="width: 10%">Visitas</th>
                        <th style="width: 10px">Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $c)
                        <tr>
                            <td>{{$c->id}}</td>
                            <td>{{$c->titulo}}</td>
                            <td>{{date('d/m/Y H:m', strtotime($c->data))}}</td>
                            <td>
                                @if($c->habilitado == 1)
                                    <span class='badge' style='background: green ; color: white' >Habilitado</span>
                                @else
                                    <span class='badge' style='background: red ; color: white' >Não Habilitado</span>
                                @endif
                            </td>
                            <td>{{$c->visitas}}</td>
                            <td>
                                <a href="{{route('post.editar',$c->id)}}" class="btn btn-block btn-warning btn-xs">

                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="card-footer clearfix">

                </div>
            </div>


        </div>



    </div>
@stop
