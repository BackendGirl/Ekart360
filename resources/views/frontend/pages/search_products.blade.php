@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')

<!-- latest jquery-->
<script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>

<!-- Breadcrumb Section Start -->
@include('frontend.layouts.breadscrumb')
<!-- Breadcrumb Section End -->

<!-- Search Bar Section Start -->
<section class="search-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-6 col-xl-8 mx-auto">
                <div class="title d-block text-center">
                    <h2>Search for products</h2>
                    <span class="title-leaf">
                        <svg class="icon-width">
                            <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                        </svg>
                    </span>
                </div>

                <div class="search-box">
                <form action="{{route('search_products')}}" method="get">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder=""
                            aria-label="Example text with button addon" value="{{$last_search}}">
                        <button class="btn theme-bg-color text-white m-0" type="submit"
                            id="button-addon1">Search</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Search Bar Section End -->

<!-- Product Section Start -->
<section class="section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <!-- <div class="col-12"> -->
                <!-- <div class="search-product product-wrapper"> -->

                @if(count($products)>0)
                @foreach($products as $product)
                @php $product_price = DB::table('product_price')->where('product_id',$product->id)->first(); @endphp
                    <div class="col-md-3 mb-3">
                        <div class="product-box-3 h-100">
                            <div class="product-header">
                                <div class="product-image">
                                    <a href="{{route('products_detail',$product->slug)}}">
                                        <img src="{{URL::to($product->photo)}}"
                                            class="img-fluid blur-up lazyload" alt="">
                                    </a>

                                    <ul class="product-option">
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view{{$product->id}}">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>

                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                            <a href="{{route('compare',$product->slug)}}">
                                                <i data-feather="refresh-cw"></i>
                                            </a>
                                        </li>

                                        @if(!empty($product_price->quantity) && !empty($product_price->price))
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                            <a class="notifi-wishlist wishlist{{$product->id}}"
                                                style="cursor:pointer;">
                                                <i data-feather="heart"></i>
                                            </a>
                                            <form action="{{route('add-to-cart')}}" method="post"
                                                id="wishlist{{$product->id}}">
                                                @csrf
                                                <input type="hidden" name="slug"
                                                    value="{{$product->slug ?? ''}}">
                                                <input type="hidden" name="weight" value="{{$product_price->quantity ?? ''}}">
                                                <input type="hidden" name="price" value="{{$product_price->price ?? ''}}">
                                                <input type="hidden" name="mrp" value="{{$product_price->mrp ?? ''}}">
                                                <input type="hidden" name="quant" value="1">
                                                <input type="hidden" name="wishlist_btn" value="wishlist_btn">
                                            </form>
                                        </li>

                                        <script>
                                        $(document).ready(function() {
                                            $(".wishlist{{$product->id}}").click(function() {
                                                $('#wishlist{{$product->id}}').submit();
                                            });
                                        })
                                        </script>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="product-footer">
                                <div class="product-detail">
                                    <a href="{{route('products_detail',$product->slug)}}">
                                        <h5 class="name">{{$product->title ?? ''}}</h5>
                                    </a>
                                    <div class="product-rating mt-2">
                                        <ul class="rating">
                                        @for($rat = 1; $rat <= 5; $rat++)
                                        <li><i data-feather="star" @if($rat <= $product->rating) class="fill" @endif></i></li>
                                        @endfor
                                        </ul>
                                        <span>({{$product->rating ?? ''}})</span>
                                    </div>
                                    <h6 class="unit">{{$product_price->quantity}}</h6>
                                    <h5 class="price"><span class="theme-color">{!! $settings->currency_symbol ?? '' !!} {{ $product_price->price ?? '' }}</span> <del>{!! $settings->currency_symbol ?? '' !!} {{ $product_price->mrp ?? '' }}</del>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>                 
                @endforeach
                @else
                <h3 class="text-center">No product found.</h3>
                @endif

                </div>
            <!-- </div> -->
        <!-- </div> -->
    </div>
</section>
<!-- Product Section End -->


@if(count($products)>0)
@foreach($products as $product)
@php $product_price = DB::table('product_price')->where('product_id',$product->id)->first(); @endphp
@php $product_weights=DB::table('product_price')->where('product_id',$product->id)->get();
    @endphp
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
                            <div class="slider-image text-center">
                                <img src="{{URL::to($product->photo)}}" class="img-fluid blur-up lazyload"
                                    alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-sidebar-modal">
                                <h4 class="title-name">{{$product->title}}</h4>
                                <h4 class="price">{!! $settings->currency_symbol ?? '' !!} {{ $product_price->price ?? '' }}</h4>
                                <div class="product-rating">
                                    <ul class="rating">
                                       @for($rat = 1; $rat <= 5; $rat++)
                                        <li><i data-feather="star" @if($rat <= $product->rating) class="fill" @endif></i></li>
                                        @endfor
                                    </ul>
                                </div>

                                <div class="product-detail">
                                    <h4>Product Details :</h4>
                                    <p>{!! str_limit(strip_tags($product->description), 160, '...') !!}</p>
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
                                    <select
                                        class="form-select select-form-size top_save_products_weight{{$product->id}}">
                                        @if(count($product_weights)>0)
                                        @foreach($product_weights as $product_weight)
                                        <option value="{{$product_weight->quantity}}" @if($product_price->id ==
                                            $product_weight->id) selected @endif
                                            data-top_save_products_price="{{$product_weight->price}}"
                                            data-top_save_products_mrp="{{$product_weight->mrp}}">{{$product_weight->quantity}}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="modal-button">
                                    <form action="{{route('add-to-cart')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="slug"
                                            value="{{$product->slug}}" class="product_slug">
                                        <input type="hidden" name="weight"
                                            class="top_save_products_product_weight{{$product->id}}"
                                            value="{{$product_price->quantity ?? ''}}">
                                        <input type="hidden" name="price"
                                            class="top_save_products_product_price{{$product->id}}"
                                            value="{{$product_price->price ?? ''}}">
                                        <input type="hidden" name="mrp"
                                            class="top_save_products_product_mrp{{$product->id}}"
                                            value="{{$product_price->mrp ?? ''}}">
                                        <input type="hidden" name="quant" value="1">
                                        @if(count($product_weights)>0)
                                        <div class="note-box product-packege">
                                            <button name="cart_btn" value="cart_btn" type="submit"
                                                class="btn btn-md add-cart-button icon">Add To Cart</button>
                                        </div>
                                        @endif
                                    </form>

                                    <a href="{{route('products_detail',$product->slug)}}">
                                        <button
                                            class="btn theme-bg-color view-button icon text-white fw-bold btn-md">View
                                            More Details</button>
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
    $(document).ready(function() {
        $(".top_save_products_weight{{$product->id}}").change(function() {
            var top_save_products_weight = $('option:selected', this).val();
            var top_save_products_price = $('option:selected', this).attr(
                "data-top_save_products_price");
            var top_save_products_mrp = $('option:selected', this).attr("data-top_save_products_mrp");
            $('.top_save_products_title2{{$product->id}}').text(
                top_save_products_price);
            $('.top_save_products_product_weight{{$product->id}}').val(
                top_save_products_weight);
            $('.top_save_products_product_price{{$product->id}}').val(
                top_save_products_price);
            $('.top_save_products_product_mrp{{$product->id}}').val(
                top_save_products_mrp);

        });
    })
    </script>
@endforeach
@endif

@endsection