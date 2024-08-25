@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')

<style>
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

<!-- latest jquery-->
<script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<!-- <script>
      const heartNone = document.querySelectorAll(".clickedHeart ");
                                                     heartNone.forEach((element)=>{

                                                        console.log(heartNone)
                                                        element.style.display = "none";
                                                     })

</script> -->

<!-- Breadcrumb Section Start -->
@include('frontend.layouts.breadscrumb')
<!-- Breadcrumb Section End -->

@if(count($product_banners)>0)
<!-- Poster Section Start -->
<section>
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="slider-1 slider-animate product-wrapper no-arrow">
                    @foreach($product_banners as $product_banner)
                    <div>
                        <div class="banner-contain-2 hover-effect">
                            <img src="{{URL::to($product_banner->photo)}}" class="bg-img rounded-3 blur-up lazyload" alt="">
                            <div class="banner-detail p-center-right position-relative shop-banner ms-auto banner-small">
                                <div>
                                    <h2>{{$product_banner->title ?? ''}}</h2>
                                    <h3>{{$product_banner->sub_title ?? ''}}</h3>
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
<!-- Poster Section End -->
@endif

<!-- Shop Section Start -->
<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-custome-3">
                <div class="left-box wow fadeInUp">
                    <div class="shop-left-sidebar">
                        <div class="back-button">
                            <h3><i class="fa-solid fa-arrow-left"></i> Back</h3>
                        </div>
                        <div class="accordion custome-accordion" id="accordionExample">
                        @if(count($categories)>0)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span>Categories</span>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne">
                                    <div class="accordion-body">

                                        <ul class="category-list custom-padding custom-height">
                                            @foreach($categories as $category)
                                            <li class="cursor">
                                                <div class="form-check ps-0 m-0 category-list-box">
                                                    <!-- <input class="checkbox_animated" type="checkbox" id="fruit"> -->
                                                    <a href="{{route('products',$category->id)}}">
                                                    <label class="form-check-label" for="">
                                                        <span class="name">{{$category->title}}</span>
                                                        <span class="number">({{$category->products}})</span>
                                                    </label>
                                                    </a>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSix">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        <span>Rating</span>
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse show"
                                    aria-labelledby="headingSix">
                                    <div class="accordion-body">
                                        <ul class="category-list custom-padding">

                                            <li>
                                                <div class="form-check ps-0 m-0 category-list-box">
                                                    <input class="checkbox_animated checkboxstar5" type="checkbox" value="star5" checked>
                                                    <div class="form-check-label">
                                                        <ul class="rating">
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                        </ul>
                                                        <span class="text-content">(5 Star)</span>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check ps-0 m-0 category-list-box">
                                                    <input class="checkbox_animated checkboxstar4" type="checkbox" value="star4" checked>
                                                    <div class="form-check-label">
                                                        <ul class="rating">
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star"></i>
                                                            </li>
                                                        </ul>
                                                        <span class="text-content">(4 Star)</span>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check ps-0 m-0 category-list-box">
                                                    <input class="checkbox_animated checkboxstar3" type="checkbox" value="star3" checked>
                                                    <div class="form-check-label">
                                                        <ul class="rating">
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star"></i>
                                                            </li>
                                                        </ul>
                                                        <span class="text-content">(3 Star)</span>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check ps-0 m-0 category-list-box">
                                                    <input class="checkbox_animated checkboxstar2" type="checkbox" value="star2" checked>
                                                    <div class="form-check-label">
                                                        <ul class="rating">
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star"></i>
                                                            </li>
                                                        </ul>
                                                        <span class="text-content">(2 Star)</span>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check ps-0 m-0 category-list-box">
                                                    <input class="checkbox_animated checkboxstar1" type="checkbox" value="star1" checked>
                                                    <div class="form-check-label">
                                                        <ul class="rating">
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star"></i>
                                                            </li>
                                                        </ul>
                                                        <span class="text-content">(1 Star)</span>
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
            </div>

            <div class="col-custome-9">
                <div class="show-button">
                    <div class="filter-button-group mt-0">
                        <div class="filter-button d-inline-block d-lg-none">
                            <a><i class="fa-solid fa-filter"></i> Filter Menu</a>
                        </div>
                    </div>

                    <div class="top-filter-menu">

                        <div class="grid-option d-none d-md-block">
                            <ul>
                                <li class="three-grid">
                                    <a href="javascript:void(0)">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/grid-3.svg"
                                            class="blur-up lazyload" alt="">
                                    </a>
                                </li>
                                <li class="grid-btn d-xxl-inline-block d-none active">
                                    <a href="javascript:void(0)">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/grid-4.svg"
                                            class="blur-up lazyload d-lg-inline-block d-none" alt="">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/grid.svg"
                                            class="blur-up lazyload img-fluid d-lg-none d-inline-block" alt="">
                                    </a>
                                </li>
                                <li class="list-btn">
                                    <a href="javascript:void(0)">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/list.svg"
                                            class="blur-up lazyload" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                @if(count($products)>0)
                <div
                    class="row row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">

                    @foreach($products as $product)
                    @php $product_price=DB::table('product_price')->where('product_id',$product->id)->first(); @endphp
                    @php $product_weights=DB::table('product_price')->where('product_id',$product->id)->get(); @endphp
                    <div class="star{{$product->rating}} card">
                    <a href="{{route('products_detail',$product->slug)}}">
                    @if(!empty($product_price->quantity) && !empty($product_price->price))
                                                <li  data-bs-placement="top" title="Wishlist" class="wishlistCol">
                                                    <a class="notifi-wishlist wishlist{{$product->id}} myWishlistId{{$product->id ?? ''}}" style="cursor:pointer;">
                                                    <i class="fa-regular fa-heart wishlistIconPop{{$product->id}}"></i>
                                                        <!-- <i class="fa-solid fa-heart clickedHeart wishlistIcon{{$product->id}}"></i> -->
                                                    </a>
                                                    <form action="{{route('add-to-cart')}}" method="post" id="wishlist{{$product->id}}">
                                                                    @csrf
                                                        <input class="hidden_slug{{$product->id}}" type="hidden" name="slug" value="{{$product->slug ?? ''}}">
                                                        <input class="hidden_weight{{$product->id}}" type="hidden" name="weight" value="{{$product_price->quantity ?? ''}}">
                                                        <input class="hidden_price{{$product->id}}" type="hidden" name="price" value="{{$product_price->price ?? ''}}">
                                                        <input class="hidden_mrp{{$product->id}}" type="hidden" name="mrp" value="{{$product_price->mrp ?? ''}}">
                                                        <input class="hidden_quant{{$product->id}}" type="hidden" name="quant" value="1">
                                                        <input class="hidden_wishlist_btn{{$product->id}}" type="hidden" name="wishlist_btn" value="wishlist_btn">
                                                    </form>
                                                </li>

                                                <script>

                                                     

                                                   
                                                    $(document).ready(function() {  
                                                                $(".wishlist{{$product->id}}").click(function(){ 
                                                                    const slug = $('.hidden_slug{{$product->id}}').val();
                                                                    const weight = $('.hidden_weight{{$product->id}}').val();
                                                                    const price = $('.hidden_price{{$product->id}}').val();
                                                                    const mrp = $('.hidden_mrp{{$product->id}}').val();
                                                                    const quant = $('.hidden_quant{{$product->id}}').val();
                                                                    const wishlist_btn = $('.hidden_wishlist_btn{{$product->id}}').val();

                                                                    const myWishListIcon = $(".wishlistIconPop{{$product->id}}");

                                                                                                                        
                                                                    myWishListIcon.removeClass("fa-regular");
                                                                    myWishListIcon.addClass("fa-solid");

                                                                    myWishListIcon.css("color", "red");


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

                                                                                        
                                                                                        Swal.fire({
                                                                                        icon: 'success',
                                                                                        title: 'Product added to your wishlist!',
                                                                                        showConfirmButton: true,
                                                                                        timer: 60000, // 60 seconds (in milliseconds)
                                                                                    }); 
                                                                                       
                                                                                       
                                                                                    }
                                                                                }
                                                                            });  
                                                                    // }
                                                                });   
                                                            } )
                                                   
                                                </script>
                                                @endif
                        <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.05s">
                            <div class="product-header">
                                <div class="product-image">
                                    
                                        <img src="{{URL::to($product->photo)}}"
                                            class="img-fluid blur-up lazyload" alt="">
                          



                                </div>
                            </div>

                            <div class="product-footer">
                                <div class="product-detail">
                                    <span class="span-name">{{$product->category_title ?? ''}}</span>
                                    <a href="{{route('products_detail',$product->slug)}}">
                                        <h5 class="name single-line-title">{{$product->title}}</h5>
                                    </a>
                                    <p class="text-content mt-1 mb-2 product-content">Feta taleggio croque monsieur
                                        swiss manchego cheesecake dolcelatte jarlsberg. Hard cheese danish fontina
                                        boursin melted cheese fondue.</p>
                                    <div class="product-rating mt-2">
                                        <ul class="rating">
                                        @for($rat = 1; $rat <= $product->rating; $rat++)
                                            <li><i data-feather="star" class="fill"></i></li>
                                        @endfor
                                        </ul>
                                        <span>({{$product->rating ?? ''}})</span>
                                    </div>
                                    <div style="float:left">
                                        <h6 class="unit">{{ $product_price->quantity ?? '' }}</h6>
                                        <h5 class="price"><span class="theme-color">{!! $settings->currency_symbol ?? '' !!} {{ $product_price->price ?? '' }}</span> <del>{!! $settings->currency_symbol ?? '' !!} {{ $product_price->mrp ?? '' }}</del>
                                        </h5>
                                    </div>
                                    <div style="float:right">
                                        <ul class="product-option" >
                                            <!-- <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view{{$product->id}}">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                    </li> -->

                                                <!-- <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="{{route('compare',$product->slug)}}">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li> -->

                                                

                                                @if(!empty($product_price->quantity) && !empty($product_price->price))
                                                <li >
                                                    <a class="notifi-wishlist cart{{$product->id}} myCartId{{$product->id ?? ''}}" style="cursor:pointer;">
                                                        <i data-feather="shopping-cart"></i>
                                                    </a>
                                                    <form action="{{route('add-to-cart')}}" method="post" id="cart{{$product->id}}">
                                                                    @csrf
                                                        <input class="hidden_slug{{$product->id}}" type="hidden" name="slug" value="{{$product->slug ?? ''}}">
                                                        <input class="hidden_weight{{$product->id}}" type="hidden" name="weight" value="{{$product_price->quantity ?? ''}}">
                                                        <input class="hidden_price{{$product->id}}" type="hidden" name="price" value="{{$product_price->price ?? ''}}">
                                                        <input class="hidden_mrp{{$product->id}}" type="hidden" name="mrp" value="{{$product_price->mrp ?? ''}}">
                                                        <input class="hidden_quant{{$product->id}}" type="hidden" name="quant" value="1">
                                                        <input class="hidden_cart_btn{{$product->id}}" type="hidden" name="cart_btn" value="cart_btn">
                                                    </form>
                                                </li>

                                      
                                        

                                                      <script>

                                               
                                                 

                                                            $(document).ready(function() {  
                                                                $(".cart{{$product->id}}").click(function(){ 
                                                                    const slug = $('.hidden_slug{{$product->id}}').val();
                                                                    const weight = $('.hidden_weight{{$product->id}}').val();
                                                                    const price = $('.hidden_price{{$product->id}}').val();
                                                                    const mrp = $('.hidden_mrp{{$product->id}}').val();
                                                                    const quant = $('.hidden_quant{{$product->id}}').val();
                                                                    const cart_btn = $('.hidden_cart_btn{{$product->id}}').val();

                                                                    
                                                                    
                                                                    // if (review_title != '' && review_message != '' && rating != '') {
                                                                        $.ajax({
                                                                            type:"GET",
                                                                                url: "{{route('add-to-cart')}}",
                                                                                data: {slug: slug,
                                                                                    weight: weight,
                                                                                    price: price,
                                                                                    mrp: mrp,
                                                                                    quant: quant,
                                                                                    cart_btn: cart_btn
                                                                                },      
                                                                                success: function(data){
                                                                                    // console.log(data);
                                                                                    if (data == 200) {

                                                                                        toastr.success('Product added to cart!', 'Success', { timeOut: 1000 }); 

                                                                                        // const cartOpt = document.querySelector(".myCartId{{$product->id ?? ''}}");
                                                                                   
                                                                                        // cartOpt.style.background = "#000";

                                                                                    }
                                                                                }
                                                                            });  
                                                                    // }
                                                                });    
                                                            })
                                                        </script>
                                                @endif
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>

                        </div>
                    </div>

                      <!-- Quick View Modal Box Start -->
                        <div class="modal fade theme-modal view-modal" id="view{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                                <div class="modal-content">
                                    <div class="modal-header p-0">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-sm-4 g-2">
                                            <div class="col-lg-6">
                                                <div class="slider-image">
                                                    <img src="{{URL::to($product->photo)}}" class="img-fluid blur-up lazyload"
                                                        alt="">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="right-sidebar-modal">
                                                    <h4 class="title-name">{{$product->title}}</h4>
                                                    <h4 class="price">{!! $settings->currency_symbol ?? '' !!} <span class="daily_staples_title2{{$product->id}}">{{ $product_price->price ?? '' }}</span></h4>
                                                    <div class="product-rating">
                                                        <ul class="rating">
                                                        @for($rat = 1; $rat <= $product->rating; $rat++)
                                                            <li><i data-feather="star" class="fill"></i></li>
                                                        @endfor
                                                        </ul>
                                                    </div>

                                                    <div class="product-detail">
                                                        <h4>Product Details :</h4>
                                                        <p>{!! str_limit(strip_tags($product->description), 160, ' ...') !!}</p>
                                                    </div>

                                                    <ul class="brand-list">
                                                        <li>
                                                            <div class="brand-box">
                                                                <h5>Product Code:</h5>
                                                                <h6>{{$product->slug ?? ''}}</h6>
                                                            </div>
                                                        </li>
                                                    </ul>

                                                    <div class="select-size">
                                                        <h4>Product Weight:</h4>
                                                        <select class="form-select select-form-size daily_staples_weight{{$product->id}}">
                                                            @if(count($product_weights)>0)
                                                            @foreach($product_weights as $product_weight)
                                                            <option value="{{$product_weight->quantity}}" @if($product_price->id == $product_weight->id) selected @endif data-daily_staples_price="{{$product_weight->price}}" data-daily_staples_mrp="{{$product_weight->mrp}}">{{$product_weight->quantity}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>

                                                    <div class="modal-button">
                                                            <form action="{{route('add-to-cart')}}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="slug" value="{{$product->slug}}" class="product_slug">
                                                                <input type="hidden" name="weight" class="daily_staples_product_weight{{$product->id}}" value="{{$product_price->quantity ?? ''}}">
                                                                <input type="hidden" name="price" class="daily_staples_product_price{{$product->id}}" value="{{$product_price->price ?? ''}}">
                                                                <input type="hidden" name="mrp" class="daily_staples_product_mrp{{$product->id}}" value="{{$product_price->mrp ?? ''}}">
                                                                <input type="hidden" name="quant" value="1">
                                                                @if(count($product_weights)>0)
                                                                <div class="note-box product-packege">                            
                                                                    <button name="cart_btn" value="cart_btn" type="submit" class="btn btn-md add-cart-button icon">Add To Cart</button>
                                                                </div>
                                                                @endif
                                                            </form>

                                                            <a href="{{route('products_detail',$product->slug)}}">
                                                                <button class="btn theme-bg-color view-button icon text-white fw-bold btn-md">View More Details</button>
                                                            </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Quick View Modal Box End -->

                        <script>
                            $(document).ready(function(){ 
                                $(".daily_staples_weight{{$product->id}}").change(function() {
                                    var daily_staples_weight = $('option:selected', this).val(); 
                                    var daily_staples_price = $('option:selected', this).attr("data-daily_staples_price");            
                                    var daily_staples_mrp = $('option:selected', this).attr("data-daily_staples_mrp");                        
                                    $('.daily_staples_title2{{$product->id}}').text(daily_staples_price);
                                    $('.daily_staples_product_weight{{$product->id}}').val(daily_staples_weight);
                                    $('.daily_staples_product_price{{$product->id}}').val(daily_staples_price);
                                    $('.daily_staples_product_mrp{{$product->id}}').val(daily_staples_mrp);

                                });
                            })
                        </script>
                        
                    @endforeach
                    </a>
                </div>
                @endif

                <nav class="custome-pagination pagination justify-content-center">
                    {{$products->links()}}
                </nav>

            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

<style>
    .cursor, .cursor *{
        cursor:pointer;
    }
</style>

<script>
    $(document).ready(function(){         
        if ($('.checkboxstar1').prop('checked')) {
            $('.star1').show();
        }else{
              $('.star1').hide();
        }
        if ($('.checkboxstar2').prop('checked')) {
            $('.star2').show();
        }else{
              $('.star2').hide();
        }
        if ($('.checkboxstar3').prop('checked')) {
            $('.star3').show();
        }else{
              $('.star3').hide();
        }    
        if ($('.checkboxstar4').prop('checked')) {
            $('.star4').show();
        }else{
              $('.star4').hide();
        }   
        if ($('.checkboxstar5').prop('checked')) {
            $('.star5').show();
        }else{
              $('.star5').hide();
        }
        $('.checkboxstar1').click(function(){
            if ($('.checkboxstar1').prop('checked')) {
                if ('star1' == $(this).val()) {$('.star1').show();}else{$('.star1').hide();}
            }else{
                $('.star1').hide();
            }
        });
        $('.checkboxstar2').click(function(){
            if ($('.checkboxstar2').prop('checked')) {
                if ('star2' == $(this).val()) {$('.star2').show();}else{$('.star2').hide();}
            }else{
                $('.star2').hide();
            }
        });
        $('.checkboxstar3').click(function(){
            if ($('.checkboxstar3').prop('checked')) {
                if ('star3' == $(this).val()) {$('.star3').show();}else{$('.star3').hide();}
            }else{
                $('.star3').hide();
            }
        });
        $('.checkboxstar4').click(function(){
            if ($('.checkboxstar4').prop('checked')) { 
                if ('star4' == $(this).val()) { 
                    $('.star4').show();
                }else{
                    $('.star4').hide();
                }
            }else{
                $('.star4').hide();
            }
        });
        $('.checkboxstar5').click(function(){
            if ($('.checkboxstar5').prop('checked')) {
                if ('star5' == $(this).val()) {$('.star5').show();}else{$('.star5').hide();}
            }else{
                $('.star5').hide();
            }
        });        
    });
</script>

@endsection