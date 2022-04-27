@extends('admin.home')

@section("conteudo")


    <div class="row">






            <div class="col-12 col-sm-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">{{$titulo_formulario}}</h3>
                    </div>
                    <form method="post" action="{{isset($categoria)?route('categoria.atualizar'):route('categoria.cadastrar')}}">
                    <div class="card-body">

                            <div class="row">
                                <div class="col-sm-12">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" placeholder="Nome da categoria" value="{{isset($categoria)?$categoria->nome:""}}">
                                    </div>
                                </div>

                            </div>


                    </div>
                        <div class="card-footer">
                            @if(isset($categoria))
                                <button type="submit" class="btn btn-warning">Editar</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir">
                                    Deletar
                                </button>
                                <input type="hidden" class="form-control" id="id" name="id" value="{{$categoria->id}}">
                            @else
                                <button type="submit" class="btn btn-primary">Salva</button>
                            @endif

                            <a href="{{route('categoria.index')}}" class="btn btn-default" style="float: right">Voltar </a>
                        </div>
                    </form>
                </div>
            </div>



        @if(isset($categoria))











            <form class="" action="{{route('categoria.excluir')}}" method="post">
                <input name="id" value="{{$categoria->id}}" type="hidden">

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

    </div>

@stop
