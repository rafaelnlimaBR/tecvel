@extends('admin.home')

@section("conteudo")


    <div class="row">

        <div class="col-md-6">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{$titulo_formulario}}</h3>
                </div>


                <form class="" action="{{isset($fornecedor)?route('fornecedor.atualizar'):route('fornecedor.cadastrar')}}" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input  type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{isset($fornecedor)?$fornecedor->nome:''}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Endereço</label>
                                <input type="text" name="endereco" class="form-control" placeholder="Endereço" value="{{isset($fornecedor)?$fornecedor->endereco:''}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input type="text" class="form-control" name="telefone01" placeholder="Telefone" value="{{isset($fornecedor)?$fornecedor->telefone01:''}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control" name="telefone02" placeholder="Telefone" value="{{isset($fornecedor)?$fornecedor->telefone02:''}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        @if(isset($fornecedor))
                            <button type="submit" class="btn btn-warning">Editar</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir">
                                Deletar
                            </button>
                            <input type="hidden" class="form-control" id="id" name="id" value="{{$fornecedor->id}}">
                        @else
                            <button type="submit" class="btn btn-primary">Salva</button>
                        @endif

                        <a href="{{route('fornecedor.index')}}" class="btn btn-default" style="float: right">Voltar </a>
                    </div>
                </form>
            </div>
        </div>



    </div>

    @if(isset($fornecedor))
        <form class="" action="{{route('fornecedor.excluir')}}" method="post">
            <input name="id" value="{{$fornecedor->id}}" type="hidden">
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
