@extends('admin.home')

@section('conteudo')

    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$titulo_tabela}}</h3>


                <div class="card-tools">
                    <a href="" type="button" class="btn btn-block btn-primary btn-sm left"><i class="fa fa-solid fa-plus"></i> Novo</a>
                </div>
            </div>


            <div class="card-body">
                <div class="" style="padding-bottom: 10px" >

                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Valor</th>
                        <th>Data</th>

                        <th style="width: 40px">Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($veiculos as $c)
                        <tr>
                            <td>{{$c->id}}</td>
                            <td>{{$c->valor}}</td>
                            <td>{{$c->data}}</td>
                            <td>
                                <a href="" class="btn btn-block btn-warning btn-xs">

                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="card-footer clearfix">
                    {{ $veiculos->links('pagination::bootstrap-4') }}
                </div>
            </div>


        </div>



    </div>
@stop
