<div class="row">
    <div class="col-md-12 contato">
        <h3 class="column-title">Entre em contato</h3>
        @if (isset($alerta))
            <h6 style="color: {{$alerta['tipo']=='erro'?'red':'green'}}" id="msg-comentario">{{$alerta['mensagem']}}</h6>
        @endif
        <!-- contact form works with formspree.io  -->
        <!-- contact form activation doc: https://docs.themefisher.com/constra/contact-form/ -->
        <form id="contact-form" name="contato-form" action="{{route('site.contato.cadastrar')}}" method="post" role="form" >
            <div class="error-container"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control form-control-name @error('nome') is-invalid @enderror" name="nome" id="name" placeholder="" type="text" value="{{old('nome')}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control form-control-email @error('email') is-invalid @enderror" name="email" id="email" placeholder="" type="email" value="{{old('email')}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Whatsapp</label>
                        <input class="form-control form-control-subject telefone @error('whatsapp') is-invalid @enderror" name="whatsapp" id="subject" placeholder="" value="{{old('whatsapp')}}" >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Mensagem</label>
                <textarea class="form-control form-control-message @error('mensagem') is-invalid @enderror" name="mensagem" id="message" placeholder="" rows="10" >{{old('mensagem')}}</textarea>
            </div>
            <div class="text-right"><br>
                <button class="btn btn-primary solid blank" name="botao-cadastrar-contato" type="submit">Enviar Mensagem</button>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.telefone').mask("(99)999999999");
            $("form[name='contato-form']").submit(function () {

                $("button[name=botao-cadastrar-contato]").attr("disabled", "true");
                $("button[name=botao-cadastrar-contato]").html('Enviando');


                var dados   = $(this).serialize();
                var rota    =   this.action;

                $.ajax({
                    type: "POST",
                    url: rota,
                    data: dados,
                    success: function( data )
                    {


                        if('erro' in data){
                            console.log(data.erro);
                            $('.form-contato').html(data.form);
                        }else{

                            $('.form-contato').html(data.form);
                        }
                        $("button[name=botao-cadastrar-contato]").prop( "disabled", false );
                        $("button[name=botao-cadastrar-contato]").html('Enviar Mensagem');
                    },
                    error:function (data,e) {
                        console.log(data);
                    }
                });
                return false;


            });
        });


    </script>
</div><!-- Content row -->