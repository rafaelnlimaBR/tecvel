@extends('site.home')

@section('conteudo_site')
    @include('site.banner.banner')


    <section id="main-container" class="main-container">
        <div class="container">
            @yield('conteudo_site')

        </div><!-- Container end -->
    </section><!-- Main container end -->



@stop