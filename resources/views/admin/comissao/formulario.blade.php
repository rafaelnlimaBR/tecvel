@extends('admin.home')

@section("conteudo")


    <div class="row">






            <div class="col-12 col-sm-6">
                <div class="card card-secondary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{request()->exists('tela')?request()->get('tela') == "dados"?"active":"":"active"}}" id="custom-tabs-one-dados-tab" data-toggle="pill" href="#custom-tabs-one-dados" role="tab" aria-controls="custom-tabs-one-dados" aria-selected="true">Dados</a>
                            </li>
                            @if(isset($comissao))
                            <li class="nav-item">
                                <a class="nav-link {{request()->exists('tela')?request()->get('tela') == "pagamentos"?"active":"":""}}" id="custom-tabs-one-pagamentos-tab" data-toggle="pill" href="#custom-tabs-one-pagamentos" role="tab" aria-controls="custom-tabs-one-pagamentos" aria-selected="false">Pagamentos</a>
                            </li>
                            @endif

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade {{request()->exists('tela')?request()->get('tela') == "dados"?"show active":"":"show active"}}" id="custom-tabs-one-dados" role="tabpanel" aria-labelledby="custom-tabs-one-dados-tab">
                                <form class="" action="{{isset($comissao)?route('comissao.atualizar'):route('comissao.cadastrar')}}" method="post">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    {{csrf_field()}}
                                                    <label for="fornecedor">Fornecedor</label>
                                                    {{Form::select('fornecedor', $fornecedores->pluck('nome','id'), (isset($comissao)?$comissao->fornecedor->id:0),['class'=>'form-control  select-fornecedor'])}}
                                                    <input type="hidden" value="{{$historico_id}}" name="historico_id">
                                                    <input type="hidden" value="{{$contrato_id}}" name="contrato_id">

                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="valor">Valor</label>
                                                    <input type="text"  class="form-control dinheiro @error('valor') is-invalid @enderror" id="valor" name="valor" placeholder="Valor" value="{{isset($comissao)?$comissao->valor:''}}">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="data">Data</label>
                                                    <div class="input-group date dataTempo" id="dataTempo" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input @error('data') is-invalid @enderror" name="data" data-target=".dataTempo"  value="{{isset($comissao)?date('dd/mm/YYYY H:i',strtotime($comissao->data)):\Carbon\Carbon::now()->format('dd/mm/YYYY H:i')}}"/>
                                                        <div class="input-group-append" data-target=".dataTempo" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="descricao">Descrição</label>
                                                    <textarea class="form-control" name="descricao" >{{isset($comissao)?$comissao->descricao:''}}</textarea>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="obs">Observações</label>
                                                    <textarea class="form-control" name="obs" >{{isset($comissao)?$comissao->obs:''}}</textarea>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        @if(isset($comissao))
                                            <button type="submit" class="btn btn-warning">Editar</button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir">
                                                Deletar
                                            </button>
                                            <input type="hidden" class="form-control" id="id" name="comissao_id" value="{{$comissao->id}}">
                                        @else
                                            <button type="submit" class="btn btn-primary">Salva</button>
                                        @endif

                                        <a href="{{route('contrato.editar',['id'=>$contrato_id,'historico_id'=>$historico_id,'tela'=>'comissoes'])}}" class="btn btn-default" style="float: right">Voltar </a>
                                    </div>
                                </form>
                            </div>
                            @if(isset($comissao))
                            <div class="tab-pane fade {{request()->exists('tela')?request()->get('tela') == "pagamentos"?"show active":"":""}}" id="custom-tabs-one-pagamentos" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">

                                <div class="card-header">
                                    <a href="{{route('comissao.novo.pagamento',['id'=>$contrato_id,'historico_id'=>$historico_id,'comissao_id'=>$comissao->id])}}" class="btn btn-primary">Pagar</a>
                                </div>
                                @include('admin.comissao.includes.tabelaPagamentos')
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>



        @if(isset($comissao))











            <form class="" action="{{route('comissao.excluir')}}" method="post">
                <input name="comissao_id" value="{{$comissao->id}}" type="hidden">
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
<script type="text/javascript">
    $('.select-fornecedor').change(function () {
        var id =    $(this).val();

        $.ajax({
            type: "get",
            url: '{{route('fornecedor.descontoAjax')}}',
            data: {'fornecedor_id':id},
            success: function( data )
            {
                $('#desconto').val(data.desconto);
            }
        });
    })

</script>

@stop
