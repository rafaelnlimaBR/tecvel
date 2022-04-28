@extends('admin.home')

@section('conteudo')
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$titulo_tabela}}</h3>


                <div class="card-tools">
                    <a href="{{route('categoria.novo')}}" type="button" class="btn btn-block btn-primary btn-sm left"><i class="fa fa-solid fa-plus"></i> Novo</a>
                </div>
            </div>


            <div class="card-body">

                <table class="table table-bordered" id="tabela">
                    <thead>
                    <tr>
                        <th style="width: 15px">#</th>
                        <th style="width: 85%">Nome</th>
                        <th style="width: 2px">Editar</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($categorias as $c)
                        <tr>

                            <td>{{$c->id}}</td>
                            <td>{{$c->nome}}</td>

                            <td>
                                <a href="{{route('categoria.editar',['id'=>$c->id])}}" class="btn btn-block btn-warning btn-xs">

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
