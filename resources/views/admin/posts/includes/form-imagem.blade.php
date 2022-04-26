@extends('admin.home')

@section("conteudo")
    <div class="row">

        <div class="col-md-12">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{$titulo_formulario}}</h3>
                </div>

                <form class="" action="{{isset($imagem)?route('post.imagem.atualizar'):route('post.imagem.cadastrar')}}" method="post" files="true" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Título</label>
                                    <input  type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" placeholder="Título" value="{{isset($imagem)?$imagem->titulo:''}}" >
                                    <input type="hidden" value="{{$post}}" name="post_id">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Alt</label>
                                    <input  type="text" class="form-control @error('alt') is-invalid @enderror"  name="alt" placeholder="Alt" value="{{isset($imagem)?$imagem->alt:''}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Descrição</label>
                                <textarea type="number" name="descricao" class="form-control " placeholder="Descrição" value="">{{isset($imagem)?$imagem->descricao:''}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <label>Sequência</label>
                                <input type="number" name="sequencia" class="form-control" placeholder="Sequência" value="{{isset($imagem)?$imagem->sequencia:'1'}}">
                            </div>
                            <div class="col-ms-10">
                                <label>Imagem</label>
                                <input type="file" name="img" class="form-control @error('img') is-invalid @enderror"  value="{{isset($imagem)?$imagem->img:''}}">
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        @if(isset($imagem))
                            <button type="submit" class="btn btn-warning">Editar</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir">
                                Deletar
                            </button>
                            <input type="hidden" class="form-control" name="imagem_id" value="{{$imagem->id}}">
                        @else
                            <button type="submit" class="btn btn-primary">Salva</button>
                        @endif

                        <a href="{{route('post.editar',['id'=>$post])}}" class="btn btn-default" style="float: right">Voltar </a>
                    </div>
                </form>


            </div>
        </div>



    </div>

    @if(isset($imagem))
        <form class="" action="{{route('post.imagem.excluir')}}" method="post">
            <input name="imagem_id" value="{{$imagem->id}}" type="hidden">
            {{csrf_field()}}
            <div class="modal fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="excluir">Confirmação de exclusão</h5>
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

@endsection