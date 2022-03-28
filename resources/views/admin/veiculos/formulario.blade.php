@extends('admin.home')

@section("conteudo")


    <div class="row">

        <div class="col-md-6">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{$titulo_formulario}}</h3>
                </div>


                @include('admin.veiculos.includes.form',['modal'=>0])
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
