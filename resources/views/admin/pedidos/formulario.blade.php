@extends('admin.home')

@section("conteudo")


    <div class="row">

        <div class="col-md-6">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{$titulo_formulario}}</h3>
                </div>


                <form class="" action="{{isset($pedido)?route('pedido.atualizar'):route('pedido.cadastrar')}}" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    {{csrf_field()}}
                                    <label for="fornecedor">Fornecedor</label>
                                    {{Form::select('fornecedor', $fornecedores->pluck('nome','id'), (isset($pedido)?$pedido->fornecedor->id:0),['class'=>'form-control'])}}
                                    <input type="hidden" value="{{$historico_id}}" name="historico_id">
                                    <input type="hidden" value="{{$contrato_id}}" name="contrato_id">

                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="codigo">Código do Pedido</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo" value="{{isset($pedido)?$pedido->numero_pedido:''}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="desconto">Desconto</label>
                                    <input type="text" class="form-control" id="desconto" name="desconto" placeholder="Desconto" value="{{isset($pedido)?$pedido->desconto:''}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="data">Data</label>
                                    <div class="input-group date dataTempo" id="dataTempo" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" name="data" data-target=".dataTempo"  value="{{isset($pedido)?date('dd/mm/YYYY H:i',strtotime($pedido->data)):\Carbon\Carbon::now()->format('dd/mm/YYYY H:i')}}"/>
                                        <div class="input-group-append" data-target=".dataTempo" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        @if(isset($pedido))
                            <button type="submit" class="btn btn-warning">Editar</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir">
                                Deletar
                            </button>
                            <input type="hidden" class="form-control" id="id" name="pedido_id" value="{{$pedido->id}}">
                        @else
                            <button type="submit" class="btn btn-primary">Salva</button>
                        @endif

                        <a href="{{route('contrato.editar',['id'=>$contrato_id,'historico_id'=>$historico_id,'tela'=>'pedidos'])}}" class="btn btn-default" style="float: right">Voltar </a>
                    </div>
                </form>
            </div>
        </div>

        @if(isset($pedido))



            <div class="col-md-6">

                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Lista de peças</h3>
                    </div>

                    <table class="table table-bordered tabela-pecas">
                        <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width:40%">Descrição</th>
                            <th style="width:20%">V.F.</th>
                            <th style="width: 10%">QNT</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($pecas as $p)
                            <tr>
                                <td><input class="checkbox-pecas" type="checkbox" peca_id="{{$p->id}}" pedido_id="{{$pedido->id}}" {{$p->pedido_id == $pedido->id?'checked':""}}></td>
                                <td>{{$p->descricao}}</td>
                                <td>{{$p->valor_fornecedor}}</td>
                                <td>{{$p->qnt}}</td>
                            </tr>


                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function () {
                    /*$('.tabela-pecas').dataTable(

                    );*/
                });


            </script>






            <form class="" action="{{route('pedido.excluir')}}" method="post">
                <input name="pedido_id" value="{{$pedido->id}}" type="hidden">
                <input type="hidden" value="{{$historico_id}}" name="historico_id">
                <input type="hidden" value="{{$contrato_id}}" name="contrato_id">

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
