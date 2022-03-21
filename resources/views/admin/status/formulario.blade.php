@extends('admin.home')

@section("conteudo")


    <div class="row">

        <div class="col-md-6">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{$titulo_formulario}}</h3>
                </div>


                <form class="" action="{{isset($status)?route('status.atualizar'):route('status.cadastrar')}}" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">

                                <div class="form-group">
                                    <label>Habilitado</label>
                                    {{Form::select('habilitado', [0=>'Não',1=>'Sim'], $status->habilitado,['class'=>'form-control'])}}

                                    {{--<input  type="text" class="form-control" id="descricao" name="descricao" placeholder="Descricao" value="{{isset($status)?$status->descricao:''}}">--}}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Descricao</label>
                                    <input  type="text" class="form-control" id="nome" name="nome" placeholder="Descricao" value="{{isset($status)?$status->nome:''}}">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label>Cor</label>
                                <input type="color" class="form-control" data-original-title="" title="" name="cor" value="{{isset($status)?$status->cor:'fff'}}">

                            </div>
                            <div class="col-sm-2">

                                <div class="form-group">
                                    <label>Orçamento</label>
                                    {{Form::select('orcamento', [0=>'Não',1=>'Sim'], $status->orcamento,['class'=>'form-control'])}}
                                    {{--<input  type="text" class="form-control" id="descricao" name="descricao" placeholder="Descricao" value="{{isset($status)?$status->descricao:''}}">--}}
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="card-footer">
                        @if(isset($status))
                            <button type="submit" class="btn btn-warning">Editar</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir">
                                Deletar
                            </button>
                            <input type="hidden" class="form-control" id="id" name="id" value="{{$status->id}}">
                        @else
                            <button type="submit" class="btn btn-primary">Salva</button>
                        @endif

                        <a href="{{route('status.index')}}" class="btn btn-default" style="float: right">Voltar </a>
                    </div>
                </form>
            </div>
        </div>

        @if(isset($status))
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Relacionados</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nome</th>
                                <th style="width: 10%">Cor</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($status->proximos as $s)
                            <tr>
                                <td>{{$s->id}}</td>
                                <td>{{$s->nome}}</td>
                                <td>
                                    <div class="{{$s->cor}}" style="width: 80px; height: 20px; background-color: {{$s->cor}}; margin: 2px">

                                    </div>
                                </td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        @endif

    </div>

    @if(isset($status))
        <form class="" action="{{route('status.excluir')}}" method="post">
            <input name="id" value="{{$status->id}}" type="hidden">
            {{csrf_field()}}
        <div class="modal fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmação de exclusão</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Deseja excluir esse registro?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="input" class="btn btn-danger">Excluir</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    @endif
@stop
