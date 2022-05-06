@extends('admin.home')

@section("conteudo")


    <div class="row">
            <div class="col-12 col-sm-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">{{$titulo_formulario}}</h3>
                    </div>
                    <form method="post" action="">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Cliente</label>
                                    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{isset($contato)?$contato->cliente->nome:""}}" disabled="true">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Whatsapp</label>
                                    <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp" value="{{isset($contato)?$contato->cliente->telefone01:""}}" disabled="true">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Mensagem</label>

                                    <textarea disabled="true" name="mensagem" class="form-control">{{isset($contato)?$contato->mensagem:""}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <a href="https://wa.me/55{{$contato->cliente->telefone01}}/?text={{urlencode($msg_whatsapp)}}" target="_new" class="btn" style="background-color: green; color: white">Responder no Whatsapp</a>
                                    {{--<a href="whatsapp://send?text=0a‎Hello%0aWorld`;" target="_new" class="form-control">Responder no Whatsapp</a>--}}
                                </div>
                            </div>
                        </div>



                    </div>
                        <div class="card-footer">
                            @if(isset($contato))
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir">
                                    Deletar
                                </button>

                            @endif

                            <a href="{{route('contato.index')}}" class="btn btn-default" style="float: right">Voltar </a>
                        </div>
                    </form>
                </div>
            </div>



        @if(isset($contato))

            <form class="" action="{{route('contato.excluir')}}" method="post">
                <input name="id" value="{{$contato->id}}" type="hidden">

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
