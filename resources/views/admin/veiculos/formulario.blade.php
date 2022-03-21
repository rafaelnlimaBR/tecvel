@extends('admin.home')

@section("conteudo")


    <div class="row">

        <div class="col-md-6">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{$titulo_formulario}}</h3>
                </div>


                <form class="" action="{{isset($veiculo)?route('veiculo.atualizar'):route('veiculo.cadastrar')}}" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Placa</label>
                                    <input  type="text" class="form-control placa" id="placa" name="placa" placeholder="Placa" value="{{isset($veiculo)?$veiculo->placa:''}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Modelo</label>
                                <input type="text" name="modelo" class="form-control" placeholder="Modelo" value="{{isset($veiculo)?$veiculo->modelo:''}}">

                            </div>


                        </div>
                        <div class="row">
                            <div class="col-sm-4">

                                <div class="form-group">
                                    <label>Cor</label>
                                    <input type="text" class="form-control" name="cor" placeholder="cor" value="{{isset($veiculo)?$veiculo->cor:''}}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Modelo/Ano</label>
                                        <input type="text" class="form-control mod_ano" name="mod_ano" placeholder="Modelo e Ano" value="{{isset($veiculo)?$veiculo->mod_ano:''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Montadora</label>
                                    <input type="text" name="montadora" class="form-control" placeholder="Montadora" value="{{isset($veiculo)?$veiculo->montadora:''}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        @if(isset($veiculo))
                            <button type="submit" class="btn btn-warning">Editar</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir">
                                Deletar
                            </button>
                            <input type="hidden" class="form-control" id="id" name="id" value="{{$veiculo->id}}">
                        @else
                            <button type="submit" class="btn btn-primary">Salva</button>
                        @endif

                        <a href="{{route('veiculo.index')}}" class="btn btn-default" style="float: right">Voltar </a>
                    </div>
                </form>
            </div>
        </div>



    </div>

    @if(isset($veiculo))
        <form class="" action="{{route('veiculo.excluir')}}" method="post">
            <input name="id" value="{{$veiculo->id}}" type="hidden">
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
