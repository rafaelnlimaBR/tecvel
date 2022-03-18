@extends('admin.home')

@section("conteudo")


    <div class="row">

        <div class="col-md-6">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{$titulo_formulario}}</h3>
                </div>


                <form class="" action="{{isset($cliente)?route('cliente.atualizar'):route('cliente.cadastrar')}}" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            {{csrf_field()}}
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{isset($cliente)?$cliente->nome:""}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="emai" name="email" placeholder="Email" value="{{isset($cliente)?$cliente->email:''}}">
                        </div>
                    </div>
                    <div class="card-footer">
                        @if(isset($cliente))
                            <button type="submit" class="btn btn-warning">Editar</button>
                            <button type="" class="btn btn-danger">Deletar</button>
                            <input type="hidden" class="form-control" id="id" name="id" value="{{$cliente->id}}">
                        @else
                            <button type="submit" class="btn btn-primary">Salva</button>
                        @endif

                        <a href="{{route('cliente.index')}}" class="btn btn-default" style="float: right">Voltar </a>
                    </div>
                </form>
            </div>
        </div>



    </div>
@stop
