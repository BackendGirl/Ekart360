@if(count($offers)>0)
    @foreach($offers as $offer)
    <section>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="banner-contain hover-effect">
                        <img src="{{URL::to($offer->photo)}}" class="bg-img blur-up lazyload" alt="">
                        <div class="banner-details p-center p-sm-4 p-3 text-white text-center">
                            <div>
                                <h3 class="lh-base fw-bold text-white">
                                    {{$offer->title ?? ''}}
                                </h3>
                                <h6 class="coupon-code code-2">Use Code : {{$offer->code ?? ''}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
    @endif