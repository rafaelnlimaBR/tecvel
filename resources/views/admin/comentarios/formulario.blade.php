@extends('admin.home')

@section("conteudo")


    <div class="row">

        <div class="col-md-6">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{$titulo_formulario}}</h3>
                </div>


                <form class="" action="{{route('comentario.atualizar')}}" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Comentário</label>
                                    <textarea   class="form-control" id="texto" name="texto" placeholder="Comentário" rows="7">{{isset($comentario)?$comentario->texto:''}}</textarea>
                                    <input type="hidden" name="id" value="{{$comentario->id}}">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-5">

                                <div class="form-group">
                                    <label>Nome</label>
                                    {{Form::select('cliente_id', [$comentario->autor->id=>$comentario->autor->nome], $comentario->autor->id,['class'=>'form-control',''])}}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Data</label>
                                <div class="input-group date dataTempo" id="dataTempo" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="data" data-target=".dataTempo"  value="{{isset($comentario)?date('dd/mm/YYYY H:i',strtotime($comentario->data)):\Carbon\Carbon::now()->format('dd/mm/YYYY H:i')}}"/>
                                    <div class="input-group-append" data-target=".dataTempo" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">

                                <div class="form-group">
                                    <label>Habilitado</label>
                                    {{Form::select('habilitado', [0=>'Não',1=>'Sim'], (isset($comentario)?$comentario->habilitado:1),['class'=>'form-control'])}}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Editar</button>
                        <a href="{{route('comentario.editar.responder',['id'=>$comentario->id])}}" class="btn btn-primary" >Responder</a>

                        <a href="{{route('post.editar',['id'=>$comentario->post->id,'tela'=>'comentarios'])}}" class="btn btn-default" style="float: right">Voltar </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{$titulo_formulario_segundario}}</h3>
                </div>

                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 50%">Autor</th>
                        <th style="width: 40%">Data</th>
                        <th style="width: 20%">Habilitado</th>
                        <th style="width: 10px">Editar</th>
                    </tr>
                    </thead>
                    <tbody>




                    @foreach($comentario->respostas as $c)
                    <tr data-widget="expandable-table" aria-expanded="false">
                        <td>{{$c->id}}</td>
                        <td>{{$c->autor->name}}</td>
                        <td>{{$c->data}}</td>
                        <td>
                            @if($c->habilitado == 1)
                                <span class='badge' style='background: green ; color: white' >Sim</span>
                            @else
                                <span class='badge' style='background: red ; color: white' >Não</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('comentario.responder.editar',['id'=>$comentario->id,'resposta_id'=>$c->id])}}" class="btn btn-block btn-warning btn-xs">

                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    <tr class="expandable-body d-none">
                        <td colspan="5">
                            <p style="display: none;">
                                {{$c->texto}}
                            </p>
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>

    </div>


@stop
