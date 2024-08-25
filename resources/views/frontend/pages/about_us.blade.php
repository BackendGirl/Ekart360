@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')


<!-- Breadcrumb Section Start -->
@includeIf('frontend.layouts.breadscrumb')
<!-- Breadcrumb Section End -->

<!-- Fresh Vegetable Section Start -->
<section class="fresh-vegetable-section section-lg-space">
    <div class="container-fluid-lg">
        <div class="row gx-xl-5 gy-xl-0 g-3 ratio_148_1">
            <div class="col-xl-6 col-12">
                <div class="row g-sm-4 g-2">

                @if($about_us->photos != null && $about_us->photos !='')
                 @foreach(explode(',', $about_us->photos) as $key=>$subphotos)                       
                    @php $catid = trim($subphotos,'[]"'); @endphp  
                    @if($catid != '' && strlen($catid) > 1)
                     @php $img =  str_replace("\\", '', $catid) @endphp
                        <div class="@if($photos_count == 1) col-12 @elseif($photos_count == 2) col-6 @else col-4 @endif ">
                            <div class="fresh-image-2">
                                <div>
                                    <img src="{{URL::to($img)}}" class="bg-img blur-up lazyload">
                                </div>
                            </div>
                        </div>                        
                     @endif                               
                    @endforeach    
                @endif                      

                </div>
            </div>

            <div class="col-xl-6 col-12">
                <div class="fresh-contain p-center-left">
                    <div>
                        <div class="review-title">
                            <h4>About Us</h4>
                            <h2>{{$about_us->title}}</h2>
                        </div>

                        <div class="delivery-list">
                            {!!$about_us->description!!}

                            <ul class="delivery-box">
                                <li>
                                    <div class="delivery-box">
                                        <div class="delivery-icon">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/3/delivery.svg"
                                                class="blur-up lazyload" alt="">
                                        </div>

                                        <div class="delivery-detail">
                                            <h5 class="text">Free delivery for all orders</h5>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="delivery-box">
                                        <div class="delivery-icon">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/3/leaf.svg"
                                                class="blur-up lazyload" alt="">
                                        </div>

                                        <div class="delivery-detail">
                                            <h5 class="text">Only fresh foods</h5>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="delivery-box">
                                        <div class="delivery-icon">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/3/delivery.svg"
                                                class="blur-up lazyload" alt="">
                                        </div>

                                        <div class="delivery-detail">
                                            <h5 class="text">Free delivery for all orders</h5>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="delivery-box">
                                        <div class="delivery-icon">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/3/leaf.svg"
                                                class="blur-up lazyload" alt="">
                                        </div>

                                        <div class="delivery-detail">
                                            <h5 class="text">Only fresh foods</h5>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Fresh Vegetable Section End -->

<!-- Client Section Start -->
<section class="client-section section-lg-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="about-us-title text-center">
                    <h4>What We Do</h4>
                    <h2 class="center">We are Trusted by Clients</h2>
                </div>

                <div class="slider-3_1 product-wrapper">
                    <div>
                        <div class="clint-contain">
                            <div class="client-icon">
                                <img src="https://themes.pixelstrap.com/fastkart/assets/svg/3/work.svg"
                                    class="blur-up lazyload" alt="">
                            </div>
                            <h2>10</h2>
                            <h4>Business Years</h4>
                            <p>A coffee shop is a small business that sells coffee, pastries, and other morning
                                goods. There are many different types of coffee shops around the world.</p>
                        </div>
                    </div>

                    <div>
                        <div class="clint-contain">
                            <div class="client-icon">
                                <img src="https://themes.pixelstrap.com/fastkart/assets/svg/3/buy.svg"
                                    class="blur-up lazyload" alt="">
                            </div>
                            <h2>80 K+</h2>
                            <h4>Products Sales</h4>
                            <p>Some coffee shops have a seating area, while some just have a spot to order and then
                                go somewhere else to sit down. The coffee shop that I am going to.</p>
                        </div>
                    </div>

                    <div>
                        <div class="clint-contain">
                            <div class="client-icon">
                                <img src="https://themes.pixelstrap.com/fastkart/assets/svg/3/user.svg"
                                    class="blur-up lazyload" alt="">
                            </div>
                            <h2>90%</h2>
                            <h4>Happy Customers</h4>
                            <p>My goal for this coffee shop is to be able to get a coffee and get on with my day.
                                It's a Thursday morning and I am rushing between meetings.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Client Section End -->

<!-- Team Section Start -->
@include('frontend.layouts.team_members')
<!-- Team Section End -->

<!-- Review Section Start -->
@include('frontend.layouts.testimonials')
<!-- Review Section End -->

<!-- Blog Section Start -->
@include('frontend.layouts.latest_blogs')
<!-- Blog Section End -->

@endsection