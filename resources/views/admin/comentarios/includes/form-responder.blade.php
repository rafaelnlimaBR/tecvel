@extends('admin.home')

@section("conteudo")


    <div class="row">

        <div class="col-md-6">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{$titulo_formulario}}</h3>
                </div>


                <form class="" action="{{isset($resposta)?route('comentario.resposta.atualizar'):route('comentario.resposta.gravar')}}" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Comentário</label>
                                    <textarea   class="form-control" id="texto" name="comentario" placeholder="Comentário" rows="7" disabled="">{{isset($comentario)?$comentario->texto:''}}</textarea>

                                    <input type="hidden" name="comentario_id" value="{{$comentario->id}}">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="form-group">
                                    <label>Resposta</label>
                                    <textarea   class="form-control @error('resposta') is-invalid @enderror"  name="resposta" placeholder="Resposta" rows="7" >{{isset($resposta)?$resposta->texto:''}}</textarea>

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-5">

                                <div class="form-group">
                                    <label>Nome</label>
                                    {{Form::select('usuario_id', [$usuarios->pluck('name','id')], isset($resposta)?$resposta->autor->id:"",['class'=>'form-control',''])}}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Data</label>
                                <div class="input-group date dataTempo" id="dataTempo" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="data" data-target=".dataTempo"  value="{{isset($resposta)?date('dd/mm/YYYY H:i',strtotime($resposta->data)):\Carbon\Carbon::now()->format('dd/mm/YYYY H:i')}}"/>
                                    <div class="input-group-append" data-target=".dataTempo" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">

                                <div class="form-group">
                                    <label>Habilitado</label>
                                    {{Form::select('habilitado', [0=>'Não',1=>'Sim'], (isset($resposta)?$resposta->habilitado:1),['class'=>'form-control'])}}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        @if(isset($resposta))
                            <button type="submit" class="btn btn-warning">Editar</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir">
                                Deletar
                            </button>
                            <input type="hidden" name="id" value="{{$resposta->id}}">
                        @else

                            <button type="submit" class="btn btn-success">Gravar</button>

                        @endif

                            <a href="{{route('comentario.editar',['id'=>$comentario->id])}}" class="btn btn-default" style="float: right">Voltar </a>
                    </div>
                </form>
            </div>
        </div>



    </div>
    @if(isset($resposta))
        <form class="" action="{{route('comentario.resposta.excluir')}}" method="post">
            <input name="id" value="{{$resposta->id}}" type="hidden">
            <input name="comentario_id" value="{{$comentario->id}}" type="hidden">
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

