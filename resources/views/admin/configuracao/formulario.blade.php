@extends('admin.home')

@section("conteudo")
    <div class="row">

        <div class="col-12 col-sm-12">
            <div class="card card-secondary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#dados" role="tab" aria-controls="dados" aria-selected="true">Dados da Empresa</a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#confi" role="tab" aria-controls="confi" aria-selected="false">Configuração</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-home-tab" data-toggle="pill" href="#horarios" role="tab" aria-controls="teste02" aria-selected="false">Informações</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-home-tab" data-toggle="pill" href="#teste02" role="tab" aria-controls="teste02" aria-selected="false">Teste02</a>
                        </li>
                    </ul>
                </div>
                <form enctype="multipart/form-data" method="post" action="{{route('configuracao.atualizar')}}" files="true">
                <div class="card-body">

                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade active show" id="dados" role="tabpanel" aria-labelledby="dados">


                            <div class="row">
                                <div class="col-sm-3">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="hidden" value="{{$conf->id}}" name="id">
                                        <input  type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{$conf->nome_empresa}}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>CNPJ</label>
                                        <input  type="text" class="form-control" id="cpnj" name="cnpj" placeholder="CNPJ" value="{{$conf->cnpj}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Endereço</label>
                                    <input type="text" name="endereco" class="form-control" placeholder="Endereço" value="{{$conf->endereco}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">

                                    <div class="form-group">
                                        <label>Telefone Fixo</label>
                                        <input type="text" class="form-control telefone" name="telefone_fixo" placeholder="Telefone" value="{{$conf->telefone_fixo}}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Telefone Movel</label>
                                            <input type="text" class="form-control telefone" name="telefone_movel" placeholder="Telefone" value="{{$conf->telefone_movel}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="email" value="{{$conf->email}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Descrição</label>
                                            <textarea class="form-control @error('descrica') is-invalid @enderror" name="descricao" >{{$conf->descricao}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Tags</label>
                                            <textarea class="form-control @error('tags') is-invalid @enderror" name="tags" >{{$conf->tags}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Instagran</label>
                                            <input type="text" class="form-control" name="instagran" value="{{$conf->instagran}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Facebook</label>
                                            <input type="text" class="form-control" name="facebook"  value="{{$conf->facebook}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Link de Avaliação do google</label>
                                            <input type="text" class="form-control" name="avaliacao"  value="{{$conf->link_avaliacao}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Logo</label>
                                            <input type="file" class="form-control" name="logo_empresa"  >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <img style="height: 100px" src="{{\Illuminate\Support\Facades\URL::asset('/imagens')."/".$conf->logo}}" name="{{str_replace(" ", "_", $conf->nome_empresa)}}" id="{{str_replace(" ", "_", $conf->nome_empresa)}}" >
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="confi" role="tabpanel" aria-labelledby="confi">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Aberto</label>
                                        {{Form::select('aberto', $status->pluck('nome','id'), $conf->aberto,['class'=>'form-control'])}}

                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Concluido</label>
                                        {{Form::select('concluido', $status->pluck('nome','id'), $conf->concluido,['class'=>'form-control'])}}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Não Autorizado</label>
                                        {{Form::select('nao_autorizado', $status->pluck('nome','id'), $conf->nao_autorizado,['class'=>'form-control'])}}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Retorno</label>
                                        {{Form::select('retorno', $status->pluck('nome','id'), $conf->retorno,['class'=>'form-control'])}}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Autorizado</label>
                                        {{Form::select('autorizado', $status->pluck('nome','id'), $conf->autorizado,['class'=>'form-control'])}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Orçamento</label>
                                        {{Form::select('orcamento_id', $tipos->pluck('descricao','id'), $conf->orcamento,['class'=>'form-control'])}}

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Ordem de Serviço</label>
                                        {{Form::select('os_id', $tipos->pluck('descricao','id'), $conf->ordem_servico,['class'=>'form-control'])}}
                                    </div>
                                </div>
                                <div class="col-sm-6">

                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="horarios" role="tabpanel" aria-labelledby="horarios">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Horários de funcionamento</label>
                                            <textarea type="text" class="form-control editor-texto @error('horarios') is-invalid @enderror" id="editor-texto"  name="horarios" placeholder="">{{isset($conf)?$conf->horario_funcionamento:''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Sobre Nós</label>
                                            <textarea type="text" class="form-control editor-texto @error('sobre_nos') is-invalid @enderror" id="editor-texto"  name="sobre_nos" placeholder="">{{isset($conf)?$conf->sobre_nos:''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="teste02" role="tabpanel" aria-labelledby="teste02">
                            teste
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Atualizar</button>

                    <a href="{{route('home')}}" class="btn btn-default" style="float: right">Voltar </a>
                </div>
                </form>
            </div>
        </div>
{{--        </form>--}}
    </div>




@stop
