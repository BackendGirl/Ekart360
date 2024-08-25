@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')

    <!-- Home Section Start -->    
         @include('frontend.layouts.classic_shop.banner')
    <!-- Home Section End -->

    <!-- Category Section Start -->
          @include('frontend.layouts.classic_shop.shop_by_category')
    <!-- Category Section End -->

    <!-- Product Fruit & Vegetables Section Start -->
          @include('frontend.layouts.classic_shop.fruits_and_vagitables')
    <!-- Product Fruit & Vegetables Section End -->

    <!-- Deal Section Start -->
          @include('frontend.layouts.classic_shop.top_saling_items')
    <!-- Deal Section End -->

       <!-- Discount Section Start -->
       @include('frontend.index.offers')  
    <!-- Discount Section End -->

    <!-- Product Breakfast & Dairy Section Start -->
          @include('frontend.layouts.classic_shop.breakfast_and_dairy')
    <!-- Product Breakfast & Dairy Section End -->

    <!-- Product Chemist Store Section Start -->
    @include('frontend.layouts.classic_shop.chemist_store')
    <!-- Product Chemist Store Section End -->

     <!-- Banner Section Start -->
     @include('frontend.layouts.sale_banners')    
    <!-- Banner Section End -->

    <!-- Product Drinks Section Start -->
          @include('frontend.layouts.classic_shop.drinks')
    <!-- Product Drinks Section End -->

    <!-- Product Grocery & Staples Section Start -->    
          @include('frontend.layouts.classic_shop.gocery_and_staples')
    <!-- Product Grocery & Staples Section End -->

    <!-- Product Personal Care Section Start -->    
          @include('frontend.layouts.classic_shop.personal_care')
    <!-- Product Personal Care Section End -->

    <!-- Product Kitchen & Dining Needs Section Start -->    
          @include('frontend.layouts.classic_shop.kitchen_and_dining')
    <!-- Product Kitchen & Dining Needs Section End -->

    <!-- Blog Section Start -->    
          @include('frontend.layouts.classic_shop.blog')
    <!-- Blog Section End -->
   
    @endsection