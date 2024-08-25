@if(count($sale_banners)>0)
    @foreach($sale_banners as $sale_banner)
    <section>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="home-contain hover-effect">
                        <img src="{{URL::to($sale_banner->photo)}}" class="bg-img blur-up lazyload" alt="">
                        <div class="home-detail p-center position-relative text-center">
                            <div>
                                <h3 class="text-danger text-uppercase fw-bold mb-0">
                                    {{$sale_banner->title ?? ''}}
                                </h3>
                                <h2 class="theme-color text-pacifico fw-normal mb-0 super-sale text-center">
                                    {{$sale_banner->sub_title1 ?? ''}}
                                </h2>
                                <h2 class="home-name text-uppercase">{{$sale_banner->sub_title2 ?? ''}}</h2>
                                <h3 class="text-pacifico fw-normal text-content text-center">
                                    {{URL::to('/')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
    @endif