<section class="home-section pt-2 ratio_50">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xl-9 col-lg-8 ratio_50_1">
                    <div class="home-contain furniture-contain-2">
                        <img src="{{URL::to($banner->center_photo)}}" class="bg-img blur-up lazyload" alt="">
                        <div class="home-detail p-top-left mend-auto w-100">
                            <div>
                                <h1 class="text-uppercase poster-1 text-content furniture-heading">{{$banner->center_title ?? ''}}<span class="daily">{{$banner->center_sub_title ?? ''}}</span></h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 d-lg-inline-block d-none">
                    <div class="home-contain h-100 home-furniture">
                        <img src="{{URL::to($banner->right_photo)}}" class="bg-img blur-up lazyload" alt="">
                        <div class="home-detail p-top-left home-p-sm feature-detail mend-auto">
                            <div>
                                <h2 class="mt-0 theme-color text-kaushan fw-normal">{{$banner->right_title ?? ''}}</h2>
                                <h3 class="furniture-content">{{$banner->right_sub_title ?? ''}}</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>