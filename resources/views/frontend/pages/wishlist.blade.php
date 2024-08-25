@extends('frontend.layouts.master') 
@section('title', $title)
@section('main-content')


<!-- Breadcrumb Section Start -->
@include('frontend.layouts.breadscrumb')
<!-- Breadcrumb Section End -->

<!-- Wishlist Section Start -->
<section class="wishlist-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row g-sm-3 g-2">

        @if(session()->get('wishlist'))
         @foreach(session()->get('wishlist') as $key=>$wishlist2)
         @if($key == $theme)
          @foreach($wishlist2 as $wishlist3)
          @foreach($wishlist3 as $wishlist)
           @php $product = DB::table('products')->where('id',$wishlist['product_id'])->first() @endphp
            <div class="col-xxl-2 col-lg-3 col-md-4 col-6 product-box-contain">
                <div class="product-box-3 h-100">
                    <div class="product-header">
                        <div class="product-image">
                            <a href="{{route('products_detail',$product->slug)}}">
                                <img src="{{URL::to($product->photo)}}" class="img-fluid blur-up lazyload"
                                    alt="">
                            </a>

                            <form action="{{route('wishlist_delete')}}" method="post">
                               @csrf
                               <input type="hidden" name="id" value="{{$product->id}}">
                                <input type="hidden" name="weight" value="{{$wishlist['weight']}}">
                            <div class="product-header-top">
                                <button class="btn wishlist-button close_button">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            </form>

                        </div>
                    </div>
                    <div class="product-footer">
                        <div class="product-detail">
                            <a href="{{route('products_detail',$product->slug)}}">
                                <h5 class="name">{{$product->title}}</h5>
                            </a>
                            <h6 class="unit mt-1">Weight : {{$wishlist['weight']}}</h6>
                            <h6 class="unit mt-1">Quantity : {{$wishlist['quantity'] ?? ''}}</h6>
                            <h5 class="price">
                                <span class="theme-color">{!! $settings->currency_symbol ?? '' !!} {{ $wishlist['price'] ?? '' }}</span>
                                <del>{!! $settings->currency_symbol ?? '' !!} {{ $wishlist['mrp'] ?? '' }}</del>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endforeach
            @endif
           @endforeach
          @endif
        </div>
        
        <div class="row flaot-end">
            <div class="col-md-8"></div>            
            <div class="col-md-4">
                <div class="summery-box p-sticky">
                    <div class="summery-header">
                        <h3>Wishlist Total</h3>
                    </div>

                    <div class="summery-contain">
                        <ul>
                            <li>
                                <h4>Subtotal</h4>
                                <h4 class="price">{!! $settings->currency_symbol ?? '' !!} {{App\Helper::totalWishlistPrice() ?? ''}}</h4>
                            </li>
                        </ul>
                    </div>

                    <ul class="summery-total">
                        <li class="list-total border-top-0">
                            <h4>Total</h4>
                            <h4 class="price theme-color">{!! $settings->currency_symbol ?? '' !!} {{App\Helper::totalWishlistPrice() ?? ''}}</h4>
                        </li>
                    </ul>

                    <div class="button-group cart-button">
                        <ul>
                            <li>
                                <form action="{{route('checkout')}}" method="post"> @csrf <input type="hidden" value="from_wishlist" name="checkout"><button class="btn btn-animation proceed-btn fw-bold" type="submit">Process To Checkout</button></form>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>            
        </div>

    </div>
</section>
<!-- Wishlist Section End -->

@endsection