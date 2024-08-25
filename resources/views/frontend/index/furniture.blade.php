@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')

   <!-- Home Section Start -->
    @include('frontend.layouts.furniture.banner')
   <!-- Home Section End -->

    <!-- Service Section Start -->
    <section class="service-section">
        <div class="container-fluid-lg">
            <div class="row g-3 row-cols-xxl-5 row-cols-lg-3 row-cols-md-2">
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/svg/service-icon-4.svg#shipping"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>Free Shipping</h3>
                            <h6 class="text-content">Free Shipping world wide</h6>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/svg/service-icon-4.svg#service"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>24 x 7 Service</h3>
                            <h6 class="text-content">Online Service For 24 x 7</h6>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/svg/service-icon-4.svg#pay"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>Online Pay</h3>
                            <h6 class="text-content">Online Payment Avaible</h6>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/svg/service-icon-4.svg#offer"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>Festival Offer</h3>
                            <h6 class="text-content">Super Sale Upto 50% off</h6>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/svg/service-icon-4.svg#return"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>100% Original</h3>
                            <h6 class="text-content">100% Money Back</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service Section End -->

    <!-- Product Section Start -->   
    @include('frontend.layouts.furniture.top_save_today')
    <!-- Product Section End -->

     <!-- Banner Section Start -->
     @include('frontend.layouts.sale_banners')    
    <!-- Banner Section End -->

    <!-- Best Seller Section Start -->    
    @include('frontend.layouts.furniture.best_saller')
    <!-- Best Seller Section End -->

    <!-- Newsletter Section Start -->    
    @include('frontend.layouts.furniture.news_letter')
    <!-- Newsletter Section End -->
   
    @endsection