<form class="" action="{{isset($cliente)?route('cliente.atualizar'):route('cliente.cadastrar')}}" method="post">

    <div class="card-body">
        <div class="form-group">
            {{csrf_field()}}
            <input type="hidden" name="modal" value="{{isset($modal)?1:0}}">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{isset($cliente)?$cliente->nome:""}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="emai" name="email" placeholder="Email" value="{{isset($cliente)?$cliente->email:''}}">
        </div>
        <div class="row">
            <div class="col-sm-6">

                <div class="form-group">
                    <label>Whatsapp</label>
                    <input type="text" class="form-control telefone" name="telefone01" placeholder="Numero" value="{{isset($cliente)?$cliente->telefone01:''}}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="text" name="telefone02" class="form-control telefone" placeholder="Numero" value="{{isset($cliente)?$cliente->telefone02:''}}">
                </div>
            </div>


        </div>
    </div>
    <div class="card-footer">
        @if(isset($cliente))
            <button type="submit" class="btn btn-warning">Editar</button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir">
                Deletar
            </button>
            <input type="hidden" class="form-control" id="id" name="id" value="{{$cliente->id}}">
        @else
            <button type="submit" class="btn btn-primary">Salva</button>
        @endif
        @if(!isset($modal))
        <a href="{{route('cliente.index')}}" class="btn btn-default" style="float: right">Voltar </a>
        @endif
    </div>
</form>
