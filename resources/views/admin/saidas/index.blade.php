@extends('admin.home')

@section('conteudo')

    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$titulo_tabela}}</h3>


                <div class="card-tools">
                    <a href="{{route('veiculo.novo')}}" type="button" class="btn btn-block btn-primary btn-sm left"><i class="fa fa-solid fa-plus"></i> Novo</a>
                </div>
            </div>


            <div class="card-body">
                <div class="" style="padding-bottom: 10px" >
                    <form class="form-inline" action="{{route('veiculo.index')}}" method="get">

                        {{csrf_field()}}
                        <div class="input-group input-group-sm" style="width: 350px;">

                            <input type="text" name="placa" class="form-control float-right col-md-5" style="" placeholder="Placa">
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
                        <th style="width: 10px">#</th>
                        <th>Placa</th>
                        <th>Modelo</th>
                        <th>Ano</th>
                        <th style="width: 40px">Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($veiculos as $c)
                        <tr>
                            <td>{{$c->id}}</td>
                            <td>{{$c->placa}}</td>
                            <td>{{$c->modelo}}</td>
                            <td>{{$c->mod_ano}}</td>
                            <td>
                                <a href="{{route('veiculo.editar',$c->id)}}" class="btn btn-block btn-warning btn-xs">

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
