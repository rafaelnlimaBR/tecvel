@extends('admin.home')

@section("conteudo")


    <div class="row">

        <div class="col-md-7">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{$titulo_formulario}}</h3>
                </div>


                <form class="" action="{{isset($banner)?route('banner.atualizar'):route('banner.cadastrar')}}" method="post" files="true" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Título</label>
                                    <input  type="text" class="form-control @error('titulo') is-invalid @enderror"  name="titulo" placeholder="Título" value="{{isset($banner)?$banner->titulo:''}}">
                                </div>
                            </div>
                            <div class="col-sm-2">

                                <div class="form-group">
                                    <label>Habilitado</label>
                                    {{Form::select('habilitado', [0=>'Não',1=>'Sim'], (isset($banner)?$banner->habilitado:1),['class'=>'form-control'])}}

                                    {{--<input  type="text" class="form-control" id="descricao" name="descricao" placeholder="Descricao" value="{{isset($banner)?$banner->descricao:''}}">--}}
                                </div>
                            </div>
                            <div class="col-sm-2">

                                <div class="form-group">
                                    <label>Sequência</label>
                                    <input  type="number" class="form-control @error('sequencia') is-invalid @enderror"  name="sequencia" placeholder="Sequência" value="{{isset($banner)?$banner->sequencia:''}}">


                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="form-group">
                                    <label>Descrição</label>
                                    <input  type="text" class="form-control"  name="descricao" placeholder="Descrição" value="{{isset($banner)?$banner->texto:''}}">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>URL</label>
                                    <input  type="text" class="form-control"  name="url" placeholder="URL" value="{{isset($banner)?$banner->url:''}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Imagem (1600x800)</label>
                                    <input  type="file" class="form-control"  name="img" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        @if(isset($banner))
                            <button type="submit" class="btn btn-warning">Editar</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir">
                                Deletar
                            </button>
                            <input type="hidden" class="form-control" id="id" name="id" value="{{$banner->id}}">
                        @else
                            <button type="submit" class="btn btn-primary">Salva</button>
                        @endif

                        <a href="{{route('banner.index')}}" class="btn btn-default" style="float: right">Voltar </a>
                    </div>
                </form>
            </div>
        </div>

        @if(isset($banner))
            <div class="col-md-5">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Imagem</h3>
                    </div>
                    <div class="card card-body">
                        <img src="{{url('/imagens/banners/'.$banner->img)}}" style="height: 300px" >
                    </div>
                </div>
            </div>

        @endif

    </div>

    @if(isset($banner))
        <form class="" action="{{route('banner.excluir')}}" method="post">
            <input name="id" value="{{$banner->id}}" type="hidden">
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
