
            <form>
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
                                <input type="hidden" value="{{isset($status_id)?$status_id:""}}" name="status_id">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
