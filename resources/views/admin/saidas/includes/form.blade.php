<form class="" action="{{isset($veiculo)?route('veiculo.atualizar'):route('veiculo.cadastrar')}}" method="post" name="form-veiculo" id="form-veiculo">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                {{csrf_field()}}
                <input type="hidden" name="modal" value="{{$modal}}">
                <div class="form-group">
                    <label>Placa</label>
                    <input  type="text" class="form-control placa" id="placa" name="placa" placeholder="Placa" value="{{isset($veiculo)?$veiculo->placa:''}}">
                    <p class="error">{{ $errors->first('placa', ":message") }}</p>
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
