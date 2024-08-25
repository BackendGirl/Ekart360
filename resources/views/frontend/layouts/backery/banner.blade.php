<section class="home-section home-section-ratio pt-2">
        <div class="container-fluid-lg">
            <div class="row g-4">

                <div class="col-xxl-3 col-lg-4 col-sm-6 ratio_180 d-sm-block d-none">
                    <div class="home-contain rounded">
                        <div class="h-100">
                            <img src="{{URL::to($banner->left_photo)}}" class="bg-img blur-up lazyload" alt="">
                        </div>
                        <div class="home-detail p-top-left home-p-medium">
                            <div>
                                <h6 class="text-danger mb-2 fw-bold">Fresh & Delicious</h6>
                                <h2 class="theme-color fw-bold">{{$banner->left_title ?? ''}}</h2>
                                <p class="text-content d-md-block d-none">{{$banner->left_sub_title ?? ''}}</p>
                                <!-- <a href="shop-left-sidebar.html" class="shop-button">Shop Now <i
                                        class="fa-solid fa-right-long ms-2"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-8 order-xxl-0 ratio_87">
                    <div class="home-contain rounded">
                        <div class="h-100">
                            <img src="{{URL::to($banner->center_photo)}}" class="bg-img blur-up lazyload" alt="">
                        </div>
                        <div class="home-detail p-center-left home-p-sm">
                            <div>
                                <h6 class="text-danger mb-2 fw-bold">Fresh & Delicious</h6>
                                <h1 class="w-75 text-uppercase name-title poster-2 my-2">
                                    <span class="name-2">{{$banner->center_title ?? ''}}</span>
                                </h1>
                                <p class="w-50">{{$banner->center_sub_title ?? ''}}</p>
                                <!-- <button onclick="location.href = 'shop-left-sidebar.html';"
                                    class="btn text-white mt-xxl-4 mt-2 home-button mend-auto theme-bg-color">
                                    Shop Now <i class="fa-solid fa-right-long icon ms-2"></i></button> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-4 col-sm-6 ratio_180 custom-ratio d-xxl-block d-lg-none d-sm-block d-none">
                    <div class="home-contain rounded">
                        <img src="{{URL::to($banner->right_photo)}}" class="bg-img blur-up lazyload" alt="">
                        <div class="home-detail p-top-left home-p-medium">
                            <div>
                                <h6 class="text-danger mb-2 fw-bold">Fresh & Delicious</h6>
                                <h2 class="theme-color fw-bold">{{$banner->right_title ?? ''}}</h2>
                                <p class="text-content d-md-block d-none">{{$banner->right_sub_title ?? ''}}</p>
                                <!-- <a href="shop-left-sidebar.html" class="shop-button">Shop Now <i
                                        class="fa-solid fa-right-long ms-2"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>