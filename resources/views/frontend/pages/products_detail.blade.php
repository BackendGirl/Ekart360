@php
 $current_theme = DB::table('themes')->where('current_theme',1)->first();
 if($current_theme->id == 1){
    $color= "#d99f46";
 }
 if($current_theme->id == 2){
    $color= "#20c997";
 }
 if($current_theme->id == 3){
    $color= "#239698";
 }
 if($current_theme->id == 4){
    $color= "#417394";
 }
@endphp

@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')

<style>
    .product-img, .product-qty{width:100% !important;}
    .product-description, .product-description *{text-align:justify; }

    .product-detail {
    position: relative;
    
    overflow: hidden;
}

.product-image img {
   
    height: auto;
    transition: transform 0.3s ease-in-out;
}

.product-detail:hover .product-image img {
    transform: scale(1.2);
    transform-origin: center;
    cursor: zoom-in;
    z-index: 1;
    position: relative;
}

span.strikethrough {
    text-decoration: line-through;
}


.star-rating {
  font-size: 30px;

  display: flex;
  align-items: center;
  flex-direction: row-reverse;
  justify-content: flex-end;
}

.star-rating input[type="radio"] {
  display: none;
}

.star-rating label {
  cursor: pointer;
  float: left;
}

.star-rating label:before {
  content: "\2606"; /* Unicode character for an outline star */
  margin: 5px;
  color: #f0c419; /* Star color */
}

.star-rating input[type="radio"]:checked ~ label:before,
.star-rating input[type="radio"]:checked ~ label ~ input[type="radio"]  {
  content: "\2605"; /* Unicode character for a solid star */
  color: #f0c419; /* Selected star color */
}



.review-submit{
    background-color: <?php echo $color; ?>;
}

.fa-heart{
font-size: 20px;
    }

.wishlistCol{
    width: 100%;
    display: flex;
    justify-content: flex-end;
    padding: 20px 0;
}

.single-line-title {
    white-space: nowrap;
}
</style>

    <!-- Include SweetAlert from a CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

 <!-- latest jquery-->
 <script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>
 <script src="js/script.js"></script>
 <script>
    document.querySelector('.product-detail').addEventListener('click', function () {
    const productImage = this.querySelector('.product-image img');
    if (productImage.style.transform === 'scale(1.2)') {
        productImage.style.transform = 'scale(1)';
    } else {
        productImage.style.transform = 'scale(1.2)';
    }
});


 </script>

<!-- Breadcrumb Section Start -->
@include('frontend.layouts.breadscrumb')
<!-- Breadcrumb Section End -->

<!-- Product Left Sidebar Start -->
<section class="product-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                <div class="row g-4">
                    <div class="col-xl-6 wow fadeInUp">
                        <div class="product-left-box">
                            <div class="row g-2">
                                <div class="col-xxl-10 col-lg-12 col-md-10 order-xxl-2 order-lg-1 order-md-2">
                                    <div class="product-main-2 no-arrow">                                      
                                    <div>
                                        <div class="slider-image">
                                            <div class="product-detail">
                                                <div class="product-image">
                                                    <img src="{{URL::to($product->photo)}}"
                                                        data-zoom-image="{{URL::to($product->photo)}}"
                                                        class="img-fluid image_zoom_cls-0 blur-up lazyload product-img" alt="">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    @foreach($multi_photos as $key=>$multi_photo)
                                        <div>
                                            <div class="slider-image">
                                                <img src="{{URL::to($multi_photo)}}"
                                                    data-zoom-image="{{URL::to($multi_photo)}}"
                                                    class="img-fluid image_zoom_cls-{{$key}} blur-up lazyload product-img" alt="">
                                            </div>
                                        </div>
                                    @endforeach


                                    </div>
                                </div>

                                <div class="col-xxl-2 col-lg-12 col-md-2 order-xxl-1 order-lg-2 order-md-1">
                                    <div class="left-slider-image-2 left-slider no-arrow slick-top">
                                    <div>
                                        <div class="sidebar-image">
                                            <img src="{{URL::to($product->photo)}}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>
                                    </div>
                                    @foreach($multi_photos as $key=>$multi_photo)
                                        <div>
                                            <div class="sidebar-image">
                                                <img src="{{URL::to($multi_photo)}}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </div>
                                        </div>
                                    @endforeach
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                    
                        <div class="right-box-contain">
                        <div class="row g-4 col-12">
                        
                            <div class="col-md-6">
                            @if($discount > 0)<h6 class="offer-top">{{$discount}}% Off</h6>@endif
                            <h2 class="name">{{$product->title}}</h2>
                            <div class="price-rating">
                                <h3 class="theme-color price"> 
                                    <span>{!! $settings->currency_symbol ?? '' !!} </span>
                                    <span class="rate" >{{ $product_prices[0]->price ?? '' }}</span>       
                                    <span class="text-content strikethrough " >{!! $settings->currency_symbol ?? '' !!} 
                                        <span class="mrp strikethrough" >{{ $product_prices[0]->mrp ?? '' }}</span>
                                    </span> 
                                    <span
                                        class="offer theme-color">@if($discount > 0)({{$discount}}% off)@endif</span></h3>
                                <div class="product-rating custom-rate">
                                    <ul class="rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <li>
                                                <i data-feather="star"
                                                    @if($i <= $rating_sum) class="fill" @endif></i>
                                            </li>
                                        @endfor
                                    </ul>
                                    <span class="review">{{$rating_sum}} Customer Review</span>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <li  data-bs-placement="top" title="Wishlist" class="wishlistCol">
                            <a class="notifi-wishlist wishlist{{$product->id}} myWishlistId{{$product->id ?? ''}}" style="cursor:pointer;">
                                                    <i class="fa-regular fa-heart wishlistIconPop{{$product->id}}"></i>
                                                        <!-- <i class="fa-solid fa-heart clickedHeart wishlistIcon{{$product->id}}"></i> -->
                                                    </a>
                                                    <form action="{{route('add-to-cart')}}" method="post" id="wishlist{{$product->id}}">
                                                                    @csrf
                                                        <input class="hidden_slug{{$product->id}}" type="hidden" name="slug" value="{{$product->slug ?? ''}}">
                                                        <input class="hidden_weight{{$product->id}}" type="hidden" name="weight" value="{{$product_prices[0]->quantity}}">
                                                        <input class="hidden_price{{$product->id}}" type="hidden" name="price" value="{{$product_prices[0]->price}}">
                                                        <input class="hidden_mrp{{$product->id}}" type="hidden" name="mrp" value="{{$product_prices[0]->mrp}}">
                                                        <input class="hidden_quant{{$product->id}}" type="hidden" name="quant" value="1">
                                                        <input class="hidden_wishlist_btn{{$product->id}}" type="hidden" name="wishlist_btn" value="wishlist_btn">
                                                    </form>
                                                </li>
                                            </div>

                                                <script>

                                                     

                                                   
                                                    $(document).ready(function() {  
                                                                $(".wishlist{{$product->id}}").click(function(){ 
                                                                    const slug = $('.hidden_slug{{$product->id}}').val();
                                                                    const weight = $('.hidden_weight{{$product->id}}').val();
                                                                    const price = $('.hidden_price{{$product->id}}').val();
                                                                    const mrp = $('.hidden_mrp{{$product->id}}').val();
                                                                    const quant = $('.hidden_quant{{$product->id}}').val();
                                                                    const wishlist_btn = $('.hidden_wishlist_btn{{$product->id}}').val();

                                                                    Swal.fire({
                                                                        icon: 'success',
                                                                        title: 'Product added to your wishlist!',
                                                                        showConfirmButton: true,
                                                                        timer: 60000, // 60 seconds (in milliseconds)
                                                                    });                                                    
                                                                    
                                                                    $.ajax({
                                                                            type:"GET",
                                                                                url: "{{route('add-to-cart')}}",
                                                                                data: {slug: slug,
                                                                                    weight: weight,
                                                                                    price: price,
                                                                                    mrp: mrp,
                                                                                    quant: quant,
                                                                                    wishlist_btn: wishlist_btn
                                                                                },      
                                                                                success: function(data){
                                                                                   
                                                                                    if (data == 200) {

                                                                                        
                                                                                        const myWishListIcon = $(".wishlistIconPop{{$product->id}}");

                                                                                        
                                                                                        myWishListIcon.removeClass("fa-regular");
                                                                                        myWishListIcon.addClass("fa-solid");

                                                                                        myWishListIcon.css("color", "red");
                                                                                       
                                                                                    }
                                                                                }
                                                                            });  
                                                                    // }
                                                                });   
                                                            } )
                                                   
                                                </script>
                        </div>
                            <div class="procuct-contain">
                                <p>Lollipop cake chocolate chocolate cake dessert jujubes. Shortbread sugar plum
                                    dessert
                                    powder cookie sweet brownie. Cake cookie apple pie dessert sugar plum muffin
                                    cheesecake.
                                </p>
                            </div>

                            @if(count($product_prices)>0)
                            <div class="product-packege">
                                <div class="product-title">
                                    <h4>Weight</h4>
                                </div>
                                <ul class="select-packege">
                                    @foreach($product_prices as $key=>$product_price)
                                    <li>
                                        <a href="javascript:void(0)" class="@if($key==0) active @endif change_product_price{{$key}}">{{$product_price->quantity}}</a>
                                    </li>

                                    <script>
                                        $(document).ready(function() { 
                                            $(".change_product_price{{$key}}").click(function(){
                                                var weight = $(this).text();
                                                var price = {{$product_price->price}};
                                                var mrp = {{$product_price->mrp}};
                                                $('.rate').text(price);
                                                $('.mrp').text(mrp);
                                                $('.product_weight').val(weight);
                                                $('.product_price').val(price);
                                                $('.product_mrp').val(mrp);
                                            })
                                            
                                        })
                                        </script>
                                        
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            {{--<div class="time deal-timer product-deal-timer mx-md-0 mx-auto" id="clockdiv-1"
                                data-hours="1" data-minutes="2" data-seconds="3">
                                <div class="product-title">
                                    <h4>Hurry up! Sales Ends In</h4>
                                </div>
                                <ul>
                                    <li>
                                        <div class="counter d-block">
                                            <div class="days d-block">
                                                <h5></h5>
                                            </div>
                                            <h6>Days</h6>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="counter d-block">
                                            <div class="hours d-block">
                                                <h5></h5>
                                            </div>
                                            <h6>Hours</h6>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="counter d-block">
                                            <div class="minutes d-block">
                                                <h5></h5>
                                            </div>
                                            <h6>Min</h6>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="counter d-block">
                                            <div class="seconds d-block">
                                                <h5></h5>
                                            </div>
                                            <h6>Sec</h6>
                                        </div>
                                    </li>
                                </ul>
                            </div>--}}

                            <form action="{{route('add-to-cart')}}" method="POST">
                                @csrf
                                <input type="hidden" name="slug" value="{{$product->slug}}" class="product_slug">
                                <input type="hidden" name="weight" class="product_weight" value="{{$product_prices[0]->quantity}}">
                                <input type="hidden" name="price" class="product_price" value="{{$product_prices[0]->price}}">
                                <input type="hidden" name="mrp" class="product_mrp" value="{{$product_prices[0]->mrp}}">
                            <div class="note-box product-packege">                            
                                <div class="cart_qty qty-box product-qty">
                                    <div class="input-group">
                                        <button type="button" class="qty-right-plus" data-type="plus" data-field="" onClick="handlePlus()">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                        <input class="form-control input-number qty-input" type="number" name="quant"
                                            value="0">
                                        <button type="button" class="qty-left-minus" data-type="minus" data-field="" onClick="handleMinus()">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>

                                <button name="cart_btn" value="cart_btn" type="submit" class="btn btn-md bg-dark cart-button text-white w-100">Add To Cart</button>
                                <!-- <button name="wishlist_btn" value="wishlist_btn" type="submit" class="btn btn-md bg-dark cart-button text-white w-100">Add To Wishlist</button> -->
                                <button name="buy_btn" value="buy_btn" type="submit" class="btn btn-md bg-dark cart-button text-white w-100">Buy Now</button>
                            </div>
                            </form>

                        </div>
                    </div>

                    <div class="col-12">
                        <div class="product-section-box">
                            <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description" type="button" role="tab"
                                        aria-controls="description" aria-selected="true">Description</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info"
                                        type="button" role="tab" aria-controls="info" aria-selected="false">Additional
                                        info</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="care-tab" data-bs-toggle="tab" data-bs-target="#care"
                                        type="button" role="tab" aria-controls="care" aria-selected="false">Care
                                        Instuctions</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                        data-bs-target="#review" type="button" role="tab" aria-controls="review"
                                        aria-selected="false">Review</button>
                                </li>
                            </ul>

                            <div class="tab-content custom-tab" id="myTabContent">

                                <div class="tab-pane fade show active" id="description" role="tabpanel"
                                    aria-labelledby="description-tab">
                                    <div class="product-description">
                                       {!!$product->description!!}
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                                    <div class="table-responsive">
                                      {!!$product->additional_info!!}
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="care" role="tabpanel" aria-labelledby="care-tab">
                                    <div class="information-box">
                                      {!!$product->care_instruction!!}
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                    <div class="review-box">
                                        <div class="row g-4">
                                            <div class="col-xl-6">
                                                <div class="review-title">
                                                    <h4 class="fw-500">Customer reviews</h4>
                                                </div>

                                                <div class="d-flex">
                                                    <div class="product-rating">
                                                        <ul class="rating">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <li>
                                                                    <i data-feather="star"
                                                                        @if($i <= $rating_sum) class="fill" @endif></i>
                                                                </li>
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                    <h6 class="ms-3">{{$rating_sum}} Out Of 5</h6>
                                                </div>

                                                <div class="rating-box">
                                                    <ul>
                                                        <li>
                                                            <div class="rating-list">
                                                                <h5>5 Star</h5>
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                        style="width: {{$rating_five}}%" aria-valuenow="100"
                                                                        aria-valuemin="0" aria-valuemax="100">
                                                                        {{$rating_five}}%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="rating-list">
                                                                <h5>4 Star</h5>
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                        style="width: {{$rating_four}}%" aria-valuenow="100"
                                                                        aria-valuemin="0" aria-valuemax="100">
                                                                        {{$rating_four}}%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="rating-list">
                                                                <h5>3 Star</h5>
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                        style="width: {{$rating_three}}%" aria-valuenow="100"
                                                                        aria-valuemin="0" aria-valuemax="100">
                                                                        {{$rating_three}}%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="rating-list">
                                                                <h5>2 Star</h5>
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                        style="width: {{$rating_two}}%" aria-valuenow="100"
                                                                        aria-valuemin="0" aria-valuemax="100">
                                                                        {{$rating_two}}%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="rating-list">
                                                                <h5>1 Star</h5>
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                        style="width: {{$rating_one}}%" aria-valuenow="100"
                                                                        aria-valuemin="0" aria-valuemax="100">
                                                                        {{$rating_one}}%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xl-6">
                                                <div class="review-title">
                                                    <h4 class="fw-500">
                                                        Add a review
                                                        @if(empty(Auth()->user()) && empty(Auth()->user()->id))
                                                         <span class="text-danger" style="font-size:13px;">( * Please login or register first for post your review.)</span>
                                                         @endif
                                                    </h4>
                                                </div>

                                                <form @if(Auth()->user() && Auth()->user()->id) action="{{route('save_customer_review')}}" method="post" enctype="multipart/form-data" @endif>
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                <div class="row g-4">                                                                                                     
                                                  <!-- <div class="col-md-6">
                                                        <div class="form-floating theme-form-floating">
                                                            <input type="text" class="form-control" id="review_title"
                                                                placeholder="Give your review a title" name="review_title">
                                                            <label for="review_title">Review Title</label>
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="col-md-6">
                                                        <div class="form-floating theme-form-floating">
                                                            <select name="rating" class="form-control" id="rating">
                                                                <option value="5">5</option>
                                                                <option value="4">4</option>
                                                                <option value="3">3</option>
                                                                <option value="2">2</option>
                                                                <option value="1">1</option>
                                                            </select>
                                                            <label for="rating">Rating</label>
                                                        </div>
                                                    </div> -->
                                                    <div class="star-rating">
                                                        <input type="radio" id="star5" name="rating" value="5">
                                                        <label for="star5" ></label>
                                                        <input type="radio" id="star4" name="rating" value="4">
                                                        <label for="star4"></label>
                                                        <input type="radio" id="star3" name="rating" value="3">
                                                        <label for="star3"></label>
                                                        <input type="radio" id="star2" name="rating" value="2">
                                                        <label for="star2"></label>
                                                        <input type="radio" id="star1" name="rating" value="1">
                                                        <label for="star1"></label>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-floating theme-form-floating">
                                                            <textarea class="form-control"
                                                                placeholder="Leave a comment here"
                                                                id="review_message" name="review_message" style="height: 150px"></textarea>
                                                            <label for="review_message">Write Your
                                                                Comment</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-floating theme-form-floating">
                                                          <button class="form-control review-submit" @if(Auth()->user() && Auth()->user()->id) type="submit" @else type="button" @endif id="comment_btn2">submit</button>
                                                        </div>
                                                    </div>
                                                  
                                                </div>
                                                </form>

                                            </div>

                                            @if(count($customer_reviews)>0)
                                            <div class="col-12">
                                                <div class="review-title">
                                                    <h4 class="fw-500">Customer questions & answers</h4>
                                                </div>

                                                <div class="review-people">
                                                    <ul class="review-list">                                                        
                                                        @foreach($customer_reviews as $customer_review)
                                                        <li>
                                                            <div class="people-box">
                                                                <div>
                                                                    <div class="people-image">
                                                                        @if($customer_review->photo)
                                                                        <img src="{{URL::to($customer_review->photo)}}"
                                                                            class="img-fluid blur-up lazyload" alt="">
                                                                        @else
                                                                        <img src="{{URL::to('public/frontend/user.jpg')}}"
                                                                            class="img-fluid blur-up lazyload" alt="">
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="people-comment">
                                                                    <a class="name" href="javascript:void(0)">{{$customer_review->first_name}}</a>
                                                                    <div class="date-time">
                                                                        <h6 class="text-content">{{$customer_review->created_at}}</h6>

                                                                        <div class="product-rating">
                                                                            <ul class="rating">
                                                                                @for($i = 1; $i <= 5; $i++)
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                        @if($i <= $customer_review->rating) class="fill" @endif></i>
                                                                                </li>
                                                                                @endfor
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <div class="reply">
                                                                        <p> <b>{{$customer_review->first_name}}</b> <br>{{$customer_review->message}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>                                                        
                                                        @endforeach                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                <div class="right-sidebar-box">
                    
                    <!-- Trending Product -->
                    <div class="pt-25">
                        <div class="category-menu">
                            <h3>Trending Products</h3>

                            <ul class="product-list product-right-sidebar border-0 p-0">
                                @foreach($tranding_products as $tranding_product)
                                <li>
                                    <div class="offer-product">
                                        <a href="{{route('products_detail',$tranding_product->slug)}}" class="offer-image">
                                            <img src="{{URL::to($tranding_product->photo)}}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>

                                        <div class="offer-detail">
                                            <div>
                                                <a href="{{route('products_detail',$tranding_product->slug)}}">
                                                    <h6 class="name">{{$tranding_product->title}}</h6>
                                                </a>
                                                <span>{{ $product_prices[0]->quantity ?? '' }}</span>
                                                <h6 class="price theme-color">{!! $settings->currency_symbol ?? '' !!} {{ $product_prices[0]->price ?? '' }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Banner Section -->
                    {{--<div class="ratio_156 pt-25">
                        <div class="home-contain">
                            <img src="../assets/images/vegetable/banner/8.jpg" class="bg-img blur-up lazyload" alt="">
                            <div class="home-detail p-top-left home-p-medium">
                                <div>
                                    <h6 class="text-yellow home-banner">Seafood</h6>
                                    <h3 class="text-uppercase fw-normal"><span
                                            class="theme-color fw-bold">Freshes</span> Products</h3>
                                    <h3 class="fw-light">every hour</h3>
                                    <button onclick="location.href = 'shop-left-sidebar.html';"
                                        class="btn btn-animation btn-md fw-bold mend-auto">Shop Now <i
                                            class="fa-solid fa-arrow-right icon"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Product Left Sidebar End -->

<!-- Releted Product Section Start -->
<section class="product-list-section section-b-space">
    <div class="container-fluid-lg">
        <div class="title">
            <h2>Related Products</h2>
            <span class="title-leaf">
                <svg class="icon-width">
                    <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                </svg>
            </span>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="slider-6_1 product-wrapper">
                    @foreach($related_products as $related_product)
                    <div>
                        <div class="product-box-3 wow fadeInUp">
                            <div class="product-header">
                                <div class="product-image">
                                    <a href="{{route('products_detail',$related_product->slug)}}">
                                        <img src="{{URL::to($related_product->photo)}}"
                                            class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="product-footer">
                                <div class="product-detail">
                                    <span class="span-name">Cake</span>
                                    <a href="{{route('products_detail',$related_product->slug)}}">
                                        <h5 class="name single-line-title">{{$related_product->title}}</h5>
                                    </a>
                                    <div class="product-rating mt-2">
                                        <ul class="rating">
                                            @for($rat = 1; $rat <= $related_product->rating; $rat++)
                                                <li><i data-feather="star" class="fill"></i></li>
                                            @endfor
                                        </ul>
                                        <span>({{$related_product->rating}})</span>
                                    </div>
                                    <h6 class="unit">{{$product_prices[0]->price}}</h6>
                                    <h5 class="price"><span class="theme-color">{!! $settings->currency_symbol ?? '' !!} {{ $product_prices[0]->price ?? '' }}</span> <del>{!! $settings->currency_symbol ?? '' !!} {{ $product_prices[0]->mrp ?? '' }}</del>
                                    </h5>
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
<!-- Releted Product Section End -->

<script>
    $(document).ready(function() {  
        $("#comment_btn").click(function(){ 
            var review_title = $("#review_title").val();
            var review_message= $("#review_message").val();
            var rating= $("#rating").val();
            
            if (review_title != '' && review_message != '' && rating != '') {
                $.ajax({
                    type:"GET",
                        url: "{{route('save_customer_review')}}",
                        data: {review_title: review_title,
                            review_message: review_message,
                            rating: rating},      
                        success: function(data){
                            alert(data);
                        }
                    });  
            }
        });    
    })


    let valInput = document.querySelector(".qty-input");
    let count = 1;
    valInput.value = count;
    
    const handlePlus = () => {
        valInput.value = count++;
    }

    const handleMinus = () => {        
        valInput.value = count--;
        if (count <= 0){
            valInput.value = 2;
            count = 1;
        }
    }

 </script>

@endsection


<style>
    @media only screen and (min-width: 1200px) and (max-width: 1500px){
        .product-section .right-box-contain .note-box{
            flex-wrap: wrap !important;
        }
    }
</style>