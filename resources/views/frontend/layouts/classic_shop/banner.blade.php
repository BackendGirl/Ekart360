<section class="home-section-2 home-section-bg pt-0 overflow-hidden">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="slider-animate">
                        <div>
                            <div class="home-contain rounded-0 p-0">
                                <img src="{{URL::to($banner->center_photo)}}"
                                    class="img-fluid bg-img blur-up lazyload" alt="">
                                <div class="home-detail home-big-space p-center-left home-overlay position-relative">
                                    <div class="container-fluid-lg">
                                        <div>
                                            <h1 class="heding-2">{{$banner->center_title ?? ''}}</h1>
                                            <h2 class="content-2">{{$banner->center_sub_title ?? ''}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>