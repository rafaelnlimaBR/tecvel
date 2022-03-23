@extends('admin.home')

@section("conteudo")


    <div class="row">

        <div class="col-md-6">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{$titulo_formulario}}</h3>
                </div>


                <form class="" action="{{isset($servico)?route('servico.atualizar'):route('servico.cadastrar')}}" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            {{csrf_field()}}
                            <label for="descricao">Descricao</label>
                            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descricao" value="{{isset($servico)?$servico->descricao:""}}">
                        </div>
                        <div class="form-group">
                            <label for="valor">Valor</label>
                            <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor" value="{{isset($servico)?$servico->valor:''}}">
                        </div>
                    </div>
                    <div class="card-footer">
                        @if(isset($servico))
                            <button type="submit" class="btn btn-warning">Editar</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir">
                                Deletar
                            </button>
                            <input type="hidden" class="form-control" id="id" name="id" value="{{$servico->id}}">
                        @else
                            <button type="submit" class="btn btn-primary">Salva</button>
                        @endif

                        <a href="{{route('servico.index')}}" class="btn btn-default" style="float: right">Voltar </a>
                    </div>
                </form>
            </div>
        </div>



    </div>

    @if(isset($servico))
        <form class="" action="{{route('servico.excluir')}}" method="post">
            <input name="id" value="{{$servico->id}}" type="hidden">
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
@stop
