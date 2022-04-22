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
                <div class="" style="padding-bottom: 10px" >
                    <form class="form-inline" action="{{route('post.index')}}" method="get">

                        {{csrf_field()}}
                        <div class="input-group input-group-sm" style="width: 350px;">

                            <input type="text" name="nome" class="form-control float-right col-md-5" style="" placeholder="Nome">
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
                        <th style="width: 50%">Título</th>
                        <th style="width: 20%">Data</th>
                        <th style="width: 20%">Habilitado</th>
                        <th style="width: 10px">Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $c)
                        <tr>
                            <td>{{$c->id}}</td>
                            <td>{{$c->titulo}}</td>
                            <td>{{$c->data}}</td>
                            <td>{{$c->habilitado?"Sim":"Não"}}</td>
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
