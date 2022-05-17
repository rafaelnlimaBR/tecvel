<div class="banner-carousel banner-carousel-1 mb-0">
    @foreach($banners as $banner)
        <div class="banner-carousel-item" style="background-image:url(imagens/banners/{{$banner->img}})">
            <div class="slider-content">
                <div class="container h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-md-12 text-center">
                            <h4 class="slide-title" data-animation-in="slideInLeft">{{$banner->titulo}}</h4>
                            <h5 class="slide-sub-title" data-animation-in="slideInRight">{{$banner->texto}}</h5>
                            @if($banner->url != null)
                                <p data-animation-in="slideInLeft" data-duration-in="1.2">
                                    <a href="{{$banner->url}}" class="slider btn btn-primary">Acessar</a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @endforeach
</div>