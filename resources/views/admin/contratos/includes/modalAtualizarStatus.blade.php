

<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('contrato.atualizar.status')}}" method="post">
                {{csrf_field()}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$titulo}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="form-group">
                                <label>Data</label>
                                <div class="input-group date dataTempo" id="dataTempo2" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="data" data-target="#dataTempo2"  value="{{\Carbon\Carbon::now()->format('dd/mm/YYYY H:i')}}"/>
                                    <div class="input-group-append" data-target="#dataTempo2" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                {{--<input  type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{isset($fornecedor)?$fornecedor->nome:''}}">--}}
                                {{--<input  type="text" class="form-control" id="descricao" name="descricao" placeholder="Descricao" value="{{isset($status)?$status->descricao:''}}">--}}
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Observações</label>
                                <textarea  class="form-control" id="obs" name="obs"  value=""></textarea>
                                <input type="text" value="{{isset($status_id)?$status_id:""}}" name="status_id" id="status_id">
                                <input type="hidden" value="{{isset($contrato_id)?$contrato_id:""}}" name="contrato_id">
                                <input type="hidden" value="{{isset($historico)?$historico->id:""}}" name="historico_id">
                                <input type="text" value="{{isset($historico)?$historico->tipo->id:""}}" name="tipo_id">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Atualizar Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
