@extends('admin.home')

@section("conteudo")


    <div class="row">

        <div class="col-md-12">
            <div class="card card-secondary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-post" role="tab" aria-controls="custom-tabs-one-post" aria-selected="true">Conteudo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-imagens" role="tab" aria-controls="custom-tabs-one-imagens" aria-selected="false">Imagens</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-post" role="tabpanel" aria-labelledby="custom-tabs-one-post-tab">
                            <form class="" action="{{isset($post)?route('post.atualizar'):route('post.cadastrar')}}" method="post">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <label>Título</label>
                                                    <input  type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" placeholder="Título" value="{{isset($post)?$post->titulo:''}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Data</label>
                                                <div class="input-group date dataTempo @error('data') is-invalid @enderror" id="dataTempo" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" name="data" data-target=".dataTempo"  value="{{isset($post)?date('dd/mm/YYYY H:i',strtotime($post->data)):\Carbon\Carbon::now()->format('dd/mm/YYYY H:i')}}"/>
                                                    <div class="input-group-append" data-target=".dataTempo" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-2">
                                                <label>Habilitado</label>
                                                {{ Form::select('habilitado', [0=>"Não",1=>"Sim"], (isset($post)?$post->halitado:0) ,['class'=>'form-control ','required']) }}
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Autor</label>
                                                {{ Form::select('usuario', $usuarios->pluck('name','id'), (isset($post)?$post->user_id:1) ,['class'=>'form-control','required']) }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">

                                                <div class="form-group">
                                                    <label>Conteudo</label>
                                                    <textarea type="text" class="form-control editor-texto @error('conteudo') is-invalid @enderror" id="editor-texto"  name="conteudo" placeholder="" value="{{isset($post)?$post->conteudo:''}}"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        @if(isset($post))
                                            <button type="submit" class="btn btn-warning">Editar</button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir">
                                                Deletar
                                            </button>
                                            <input type="hidden" class="form-control" id="id" name="id" value="{{$post->id}}">
                                        @else
                                            <button type="submit" class="btn btn-primary">Salva</button>
                                        @endif

                                        <a href="{{route('post.index')}}" class="btn btn-default" style="float: right">Voltar </a>
                                    </div>
                                </form>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-imagens" role="tabpanel" aria-labelledby="custom-tabs-one-imagens-tab">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Imagen</th>
                                    <th>Data</th>
                                    <th style="width: 40px">Excluir</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Update software</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-danger">55%</span></td>
                                </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
























        </div>



    </div>

    @if(isset($post))
        <form class="" action="{{route('post.excluir')}}" method="post">
            <input name="id" value="{{$post->id}}" type="hidden">
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
