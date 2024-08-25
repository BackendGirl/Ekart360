<section class="home-section pt-2">
    <div class="container-fluid-lg">
        <div class="row g-4">
            <div class="col-xl-9 col-lg-8">
                <div class="home-contain h-100">
                    <img src="{{URL::to($banner->center_photo)}}" class="bg-img blur-up lazyload" alt="">
                    <div class="home-detail p-center-left w-75 position-relative mend-auto">
                        <div>
                            <h1 class="w-75 text-uppercase poster-1"><span
                                    class="daily">{{$banner->center_title ?? ''}}</span></h1>
                            <p class="w-58 d-none d-sm-block">{{$banner->center_sub_title ?? ''}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 d-lg-inline-block d-none ratio_156">
                <div class="home-contain h-100">
                    <img src="{{URL::to($banner->right_photo)}}" class="bg-img blur-up lazyload" alt="">
                    <div class="home-detail p-top-left home-p-sm w-75">
                        <div>
                            <h3 class="theme-color">{{$banner->right_title ?? ''}}</h3>
                            <h5 class="text-content">{{$banner->right_sub_title ?? ''}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>