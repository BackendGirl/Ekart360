@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')

<!-- Home Section Start -->    
@include('frontend.layouts.organic.banner')
<!-- Home Section End -->

<!-- Category Section Start -->
@include('frontend.layouts.organic.product_category_section') 
<!-- Category Section End -->


<!-- Discount Section Start -->
@include('frontend.index.offers') 
<!-- Discount Section End -->

<!-- Product Section Start -->
@include('frontend.layouts.organic.fruits_and_vagitables') 
<!-- Product Section End -->

 <!-- Banner Section Start -->
 @include('frontend.layouts.sale_banners')    
 <!-- Banner Section End -->

<!-- Product Section Start -->
@include('frontend.layouts.organic.breakfast_and_dairy') 
<!-- Product Section End -->

<!-- Product Section Start -->
@if(count($deals)>0)
<section>
    <div class="container-fluid-lg">
    <div class="title">
            <h2>Deal Today</h2>
            <span class="title-leaf">
                <svg class="icon-width">
                    <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                </svg>
            </span>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="slider-4-1 ratio_65 no-arrow product-wrapper">
                    @foreach($deals as $deal)
                    <div>
                        <div class="product-slider wow fadeInUp">
                            <a href="{{route('products_detail',$deal->slug)}}" class="product-slider-image">
                                <img src="{{URL::to($deal->photo)}}" class="w-100 blur-up lazyload rounded-3"
                                    alt="">
                            </a>

                            <div class="product-slider-detail">
                                <div>
                                    <a href="{{route('products_detail',$deal->slug)}}" class="d-block">
                                        <h3 class="text-title">{{$deal->title ?? ''}}</h3>
                                    </a>
                                    <div class="product-rating">
                                        <ul class="rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <li>
                                                    <i data-feather="star"
                                                        @if($i <= $deal->rating) class="fill" @endif></i>
                                                </li>
                                            @endfor
                                        </ul>
                                    </div>
                                    <br><br>
                                    <a href="{{route('products_detail',$deal->slug)}}">
                                    <button 
                                        class="btn btn-animation product-button btn-sm">Shop Now <i
                                            class="fa-solid fa-arrow-right icon"></i></button>
                                            </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- Product Section End -->

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

<!-- Blog Section Start -->
@include('frontend.layouts.organic.featured_blogs') 
<!-- Blog Section End -->

<!-- Newsletter Section Start -->
@include('frontend.layouts.newsletter')
<!-- Newsletter Section End -->

@endsection