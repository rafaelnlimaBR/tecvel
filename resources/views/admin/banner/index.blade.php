@extends('admin.home')

@section('conteudo')

    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$titulo_tabela}}</h3>


                <div class="card-tools">
                    <a href="{{route('banner.novo')}}" type="button" class="btn btn-block btn-primary btn-sm left"><i class="fa fa-solid fa-plus"></i> Novo</a>
                </div>
            </div>


            <div class="card-body">
                <div class="" style="padding-bottom: 10px" >
                    <form class="form-inline" action="{{route('banner.index')}}" method="get">

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
                        <th style="width: 15px">#</th>
                        <th style="width: 15px">Sequência</th>
                        <th style="width: 25%">Img</th>
                        <th>Título</th>
                        <th style="width: 10%">Habilitado</th>
                        <th style="width: 40px">Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($banner as $c)
                        <tr>
                            <td>{{$c->id}}</td>
                            <td>{{$c->sequencia}}</td>
                            <td><img src="{{url('/imagens/banners/'.$c->img)}}" style="height: 50px" ></td>
                            <td>{{$c->titulo}}</td>

                            <td>
                                @if($c->habilitado == 1)
                                    <span class='badge' style='background: green ; color: white' >Habilitado</span>
                                @else
                                    <span class='badge' style='background: red ; color: white' >Não Habilitado</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('banner.editar',$c->id)}}" class="btn btn-block btn-warning btn-xs">

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
