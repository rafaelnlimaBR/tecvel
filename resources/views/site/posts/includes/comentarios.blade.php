<div id="comentarios">
    <div class="comments-form border-box">
        <h3 class="title-normal">Adicionar Comentário</h3>
        @if (isset($alerta))
            <p style="color: green">Adicionado com sucesso</p>
        @endif
        <form role="form" name="postar-comentario" method="post" action="{{route('site.postagem.comentar')}}">
            <div class="row">
                {{csrf_field()}}
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="message" class="w-100"><textarea class="form-control required-field" id="message" placeholder="Seu Comentario" rows="10" name="comentario"></textarea></label>
                    </div>
                </div><!-- Col 12 end -->

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name"  class="w-100"><input class="form-control" name="nome" id="name" placeholder="Nome Completo" type="text"  required></label>
                    </div>
                </div><!-- Col 4 end -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name"  class="w-100"><input class="form-control" name="whatsapp" placeholder="Whatsapp" type="text"  required ></label>
                    </div>
                </div><!-- Col 4 end -->

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email" class="w-100"><input class="form-control" name="email" id="email" placeholder="Seu Email" type="text" requiredp></label>
                    </div>
                </div>



            </div><!-- Form row end -->
            <div class="clearfix">
                <button class="btn btn-primary" id="postar" type="submit" aria-label="post-comment">Postar Comentário</button>
            </div>
        </form><!-- Form end -->
    </div><!-- Comments form end -->
<div id="comments" class="comments-area">
    <h3 class="comments-heading">{{$post->comentarios->count()}} Comentários</h3>

    <ul class="comments-list">
        <li>
            @foreach($post->comentarios()->habilitados(1)->orderBy('data', 'DESC')->get() as $c)
                <div class="comment d-flex">
                    {{--<img loading="lazy" class="comment-avatar" alt="author" src="images/news/avator1.png">--}}
                    <div class="comment-body">
                        <div class="meta-data">
                            <span class="comment-author mr-3">{{$c->autor->nome}}</span>
                            <span class="comment-date float-right">{{date('d/m/Y H:m', strtotime($c->data))}}</span>
                        </div>
                        <div class="comment-content">
                            <p>{{$c->texto}}</p>
                        </div>
                        {{-- <div class="text-left">
                             <a class="comment-reply font-weight-bold" href="#">Reply</a>
                         </div>--}}
                    </div>
                </div><!-- Comments end -->

                @foreach($c->respostas()->habilitados(1)->orderBy('data','DESC')->get() as $r)

                    <ul class="comments-reply">
                        <li>
                            <div class="comment d-flex">
                                {{--<img loading="lazy" class="comment-avatar" alt="author" src="images/news/avator2.png">--}}
                                <div class="comment-body">
                                    <div class="meta-data">
                                        <span class="comment-author mr-3">{{$dados->nome_empresa}}</span>
                                        <span class="comment-date float-right">{{date('d/m/Y H:m', strtotime($c->data))}}</span>
                                    </div>
                                    <div class="comment-content">
                                        <p>{{$r->texto}}</p>
                                    </div>

                                </div>
                            </div><!-- Comments end -->
                        </li>
                    </ul><!-- comments-reply end -->
                @endforeach

            @endforeach



        </li><!-- Comments-list li end -->
    </ul><!-- Comments-list ul end -->
</div><!-- Post comment end -->


</div>
<script type="text/javascript">

    $("form[name='postar-comentario']").submit(function () {
        var dados   = $(this).serialize();
        var rota    =   this.action;

        $.ajax({
            type: "POST",
            url: rota,
            data: dados,
            success: function( data )
            {
                if('erro' in data){
                    console.log(data);
                }else{
                    console.log(data);
                    $('#comentarios').html(data.comentarios);
                }
            },
            error:function (data,e) {
                console.log(data);
            }
        });
        return false;


    });

</script>