@extends('site.home')

@section('conteudo_site')
    @include('site.banner.banner')




    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="column-title">Avaliações <a style="font-size: 11px; color: #0c84ff; text-decoration-line: underline " href="{{$dados->link_avaliacao}}" target="_new">deixe sua avaliação</a></h3>

                    <div id="testimonial-slide" class="testimonial-slide">

                        @foreach($avaliacoes as $avaliacao)
                            <div class="item">
                                <div class="quote-item">
                                <span class="quote-text">
                                  {{$avaliacao->texto}}
                                </span>

                                    <div class="quote-item-footer">

                                        <div class="quote-item-info">
                                            <h3 class="quote-author">{{$avaliacao->cliente}}</h3>

                                        </div>
                                    </div>
                                </div><!-- Quote item end -->
                            </div>

                        @endforeach
                    </div>
                    <!--/ Testimonial carousel end-->
                </div><!-- Col end -->



            </div>
            <!--/ Content row end -->
        </div>
        <!--/ Container end -->
    </section><!-- Content end -->

@stop