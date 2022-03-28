
<form class="" action="{{isset($servico)?route('servico.atualizar'):route('servico.cadastrar')}}" method="post" id="form-modal-servicos" name="{{$modal == 1?"modal-adicionar-servico":""}}">
    <div class="card-body">
        <div class="form-group">
            {{csrf_field()}}
            <input type="hidden" name="modal" value="{{$modal}}">
            <label for="descricao">Descricao</label>
            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descricao" value="{{isset($servico)?$servico->descricao:""}}">
            <p class="error">{{ $errors->first('descricao', ":message") }}</p>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="text" class="form-control dinheiro" id="valor" name="valor" placeholder="Valor" value="{{isset($servico)?$servico->valor:''}}">
            <p class="error">{{ $errors->first('valor', ":message") }}</p>
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

        @if($modal == 0)
                <a href="{{route('servico.index')}}" class="btn btn-default" style="float: right">Voltar </a>
        @endif
    </div>
</form>
