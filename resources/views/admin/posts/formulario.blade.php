@extends('admin.home')

@section("conteudo")


    <div class="row">

        <div class="col-md-12">
            <div class="card card-secondary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{request()->exists('tela')?request()->get('tela') == "dados"?"active":"":"active"}}" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-post" role="tab" aria-controls="custom-tabs-one-post" aria-selected="true">Conteudo</a>
                        </li>
                        @if(isset($post))
                        <li class="nav-item">
                            <a class="nav-link {{request()->exists('tela')?request()->get('tela') == "imagens"?"active":"":""}}" id="custom-tabs-one-imagens-tab" data-toggle="pill" href="#custom-tabs-one-imagens" role="tab" aria-controls="custom-tabs-one-imagens" aria-selected="false">Imagens</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{request()->exists('tela')?request()->get('tela') == "comentarios"?"active":"":""}}" id="custom-tabs-one-comentarios-tab" data-toggle="pill" href="#custom-tabs-one-comentarios" role="tab" aria-controls="custom-tabs-one-comentarios" aria-selected="false">Comentarios</a>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade {{request()->exists('tela')?request()->get('tela') == "dados"?"show active":"":"show active"}}" id="custom-tabs-one-post" role="tabpanel" aria-labelledby="custom-tabs-one-post-tab">
                            <form class="" action="{{isset($post)?route('post.atualizar'):route('post.cadastrar')}}"  method="post" files="true" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <label>Título</label>
                                                    <input  type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" placeholder="Título" value="{{isset($post)?$post->titulo:''}}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
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
                                                {{ Form::select('habilitado', [0=>"Não",1=>"Sim"], (isset($post)?$post->habilitado:0) ,['class'=>'form-control ','required']) }}
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Autor</label>
                                                {{ Form::select('usuario', $usuarios->pluck('name','id'), (isset($post)?$post->user_id:1) ,['class'=>'form-control','required']) }}
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Categorias</label>
                                                {{ Form::select('categorias[]', $categorias->pluck('nome','id'), (isset($post)?$post->categorias()->pluck('categoria_id'):0) ,['class'=>'form-control select-multiple','multiple']) }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Tags</label>
                                                {{ Form::select('tags[]', $tags->pluck('nome','id'), (isset($post)?$post->tags()->pluck('tag_id'):0) ,['class'=>'form-control select-multiple-tags','multiple']) }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">

                                                <div class="form-group">
                                                    <label>Meta Descrição</label>
                                                    <textarea type="text" class="form-control @error('descricao') is-invalid @enderror" id="editor-texto"  name="descricao" placeholder="">{{isset($post)?$post->descricao:''}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">

                                                <div class="form-group">
                                                    <label>Conteudo</label>
                                                    <textarea type="text" class="form-control editor-texto @error('conteudo') is-invalid @enderror" id="editor-texto"  name="conteudo" placeholder="">{{isset($post)?$post->conteudo:''}}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">

                                                <div class="form-group">
                                                    <label>Meta Imagem</label>
                                                    <input  type="file" class="form-control @error('img') is-invalid @enderror"   name="img" >
                                                </div>
                                            </div>
                                            <div class="col-sm-6">

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
                        @if(isset($post))
                        <div class="tab-pane fade {{request()->exists('tela')?request()->get('tela') == "imagens"?"show active":"":""}}" id="custom-tabs-one-imagens" role="tabpanel" aria-labelledby="custom-tabs-one-imagens-tab">
                          <div class="row">
                              <a href="{{route('post.imagem.novo',['id'=>$post->id])}}" class="btn btn-primary">Nova Imagem</a>
                          </div>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">Seq</th>
                                    <th>Imagen</th>
                                    <th>Título</th>
                                    <th style="width: 40px">Editar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($post->imagens as $i)
                                    <tr>
                                        <td>{{$i->sequencia}}</td>
                                        <td><img src="{{url('/imagens/posts/'.$i->img)}}" style="height: 50px" alt="{{$i->alt}}"></td>
                                        <td>
                                            {{$i->titulo}}
                                        </td>
                                        <td>
                                            <a href="{{route('post.imagem.editar',['id'=>$post->id,'imagem_id'=>$i->id])}}" class="btn btn-block btn-warning btn-xs">

                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>
                            </table>

                        </div>
                        <div class="tab-pane fade {{request()->exists('tela')?request()->get('tela') == "comentarios"?"show active":"":""}}" id="custom-tabs-one-comentarios" role="tabpanel" aria-labelledby="custom-tabs-one-comentarios-tab">

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th>Nome</th>
                                        <th>Data</th>
                                        <th style="width: 10%">Visualizado</th>
                                        <th style="width: 10%">Habilitado</th>
                                        <th style="width: 40px">Editar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($post->comentarios as $i)
                                        <tr>
                                            <td>{{$i->id}}</td>
                                            <td>{{$i->autor->nome}}</td>
                                            <td>{{$i->data}}</td>
                                            <td>
                                                @if($i->visualizado == 1)
                                                    <span class='badge' style='background: green ; color: white' >Visualizado</span>
                                                @else
                                                    <span class='badge' style='background: red ; color: white' >Não Visualizado</span>
                                                @endif
                                            </td>
                                            <td>
                                            @if($i->habilitado == 1)
                                                <span class='badge' style='background: green ; color: white' >Sim</span>
                                            @else
                                                <span class='badge' style='background: red ; color: white' >Não</span>
                                            @endif
                                            </td>
                                            <td>
                                                <a href="{{route('comentario.editar',['id'=>$i->id])}}" class="btn btn-block btn-warning btn-xs">

                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>

                                    @endforeach


                                    </tbody>
                                </table>

                            </div>
                        @endif
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
