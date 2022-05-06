@extends('site.home')

@section('conteudo_site')
<section id="main-container" class="main-container">
    <div class="container">

        <div class="row text-center">
            <div class="col-12">
                <h2 class="section-title">Tecvel - Eletrônica Automotiva</h2>
                <h3 class="section-sub-title">Nossa Localização</h3>
            </div>
        </div>
        <!--/ Title row end -->

        <div class="row">
            <div class="col-md-4">
                <div class="ts-service-box-bg text-center h-100">
      <span class="ts-service-icon icon-round">
        <i class="fas fa-map-marker-alt mr-0"></i>
      </span>
                    <div class="ts-service-box-content">
                        <h4>Visite nossa loja</h4>
                        <p>{{$dados->endereco}}</p>
                    </div>
                </div>
            </div><!-- Col 1 end -->

            <div class="col-md-4">
                <div class="ts-service-box-bg text-center h-100">
      <span class="ts-service-icon icon-round">
        <i class="fa fa-envelope mr-0"></i>
      </span>
                    <div class="ts-service-box-content">
                        <h4>Nosso Email</h4>
                        <p>{{$dados->email}}</p>
                    </div>
                </div>
            </div><!-- Col 2 end -->

            <div class="col-md-4">
                <div class="ts-service-box-bg text-center h-100">
      <span class="ts-service-icon icon-round">
        <i class="fa fa-phone-square mr-0"></i>
      </span>
                    <div class="ts-service-box-content">
                        <h4>Nosso Telefone</h4>
                        <p>{{$dados->telefone_movel." / ".$dados->telefone_fixo}}</p>
                    </div>
                </div>
            </div><!-- Col 3 end -->

        </div><!-- 1st row end -->

        <div class="gap-60"></div>

        <div class="google-map">

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.3569846333558!2d-38.52061608571059!3d-3.7321347442354322!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7c748571eaff129%3A0x9b9fca91feddd3d4!2sTecvel%20-%20Eletr%C3%B4nica%20Automotiva%20e%20Oficina!5e0!3m2!1spt-BR!2sbr!4v1651771434771!5m2!1spt-BR!2sbr" width="900" height="450" style="border:0; width: 100%" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="gap-40"></div>
        <div class="form-contato">
            @include('site.contato.includes.contato-form')
        </div>

    </div><!-- Conatiner end -->
</section><!-- Main container end -->


@stop