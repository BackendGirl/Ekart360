@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')

    <!-- Home Section Start -->    
         @include('frontend.layouts.backery.banner')
    <!-- Home Section End -->

    <!-- Category Section Start -->
          @include('frontend.layouts.backery.product_category_section') 
    <!-- Category Section End -->

    <!-- Discount Section Start -->
    @include('frontend.index.offers')  
    <!-- Discount Section End -->

    <!-- Product Section Start -->
    <section>
        <div class="container-fluid-lg">
            <div class="row g-3">
                <div class="col-xxl-12 col-xl-12">
                    
                @include('frontend.layouts.backery.top_save_today')

                @include('frontend.layouts.backery.all_kinds_of_cake')

                @include('frontend.layouts.backery.your_daily_staples')

                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Banner Section Start -->
    @include('frontend.layouts.sale_banners')    
    <!-- Banner Section End -->

    <!-- Top Selling Section Start -->
    <section class="top-selling-section">
        <div class="container-fluid-lg">
            <div class="slider-4-1">
             
            @include('frontend.layouts.top_saling')
            @include('frontend.layouts.tranding_products')
            @include('frontend.layouts.recently_added')
            @include('frontend.layouts.top_rated')

            </div>
        </div>
    </section>
    <!-- Top Selling Section End -->

    @include('frontend.layouts.newsletter')
   
    @endsection
    

