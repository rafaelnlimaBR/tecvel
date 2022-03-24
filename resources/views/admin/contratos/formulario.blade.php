@extends('admin.home')

@section("conteudo")




    <div class="col-12 col-sm-12">
        <div class="card card-secondary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                    <li class="pt-2 px-3"><h3 class="card-title">{{isset($contrato)?$contrato->status->last()->nome:$titulo_formulario}}</h3></li>
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Dados</a>
                    </li>
                    @if(isset($contrato))
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Settings</a>
                    </li>
                    @endif
                </ul>

            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                        <div class="row">
                            <div class="col-sm-6">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Cliente <a class="" data-toggle="modal" data-target="#modalCliente"> Novo</a></label>
                                    {{ Form::select('cliente', (isset($contrato)?[$contrato->cliente->id=>$contrato->cliente->nome]:[null=>"Selecione um Cliente"]), null ,['class'=>'form-control clientes_select2']) }}
                                    <input type="hidden" name="tipo_contrato" value="{{isset($tipo_contrato)?$tipo_contrato:''}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Veiculo <a class="" data-toggle="modal" data-target="#modalVeiculo"> Novo</a></label>
                                    {{ Form::select('veiculo', (isset($contrato)?[$contrato->veiculo->id=>$contrato->veiculo->placa]:[0=>"Selecione um Veiculo"]), null ,['class'=>'form-control veiculo_select2']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Defeito</label>
                                    <textarea  class="form-control" id="defeito" name="defeito"  value="{{isset($contrato)?$contrato->defeito:""}}">
                                         {{isset($contrato)?$contrato->defeito:""}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Observações</label>
                                    <textarea  class="form-control" id="obs" name="obs"  value="{{isset($contrato)?$contrato->obs:""}}">
                                        {{isset($contrato)?$contrato->obs:""}}
                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary">Criar</button>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                        Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>







    <!-- Modal -->
    <div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.clientes.includes.form',['modal'=>1])
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalVeiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.veiculos.includes.form',['modal'=>1])
                </div>

            </div>
        </div>
    </div>
@stop
