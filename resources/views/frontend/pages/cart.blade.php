@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')


<!-- Breadcrumb Section Start -->
@include('frontend.layouts.breadscrumb')
<!-- Breadcrumb Section End -->

<!-- Cart Section Start -->
<section class="cart-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row g-sm-5 g-3">
            <div class="col-xxl-9">
                <div class="cart-table">
                    <div class="table-responsive-xl">
                        <table class="table">
                            <tbody>
                            @if(session()->get('cart'))
							 @foreach(session()->get('cart') as $key=>$cart2)
                             @if($key == $theme)
                             @foreach($cart2 as $cart3)
							  @foreach($cart3 as $cart)
							   @php $product = DB::table('products')->where('id',$cart['product_id'])->where('theme',$theme)->first() @endphp
                               @if(!empty($product))
                                <tr class="product-box-contain">
                                    <td class="product-detail">
                                        <div class="product border-0">
                                            <a href="{{route('products_detail',$product->slug)}}" class="product-image">
                                                <img src="{{URl::to($product->photo)}}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>
                                            <div class="product-detail">
                                                <ul>
                                                    <li class="name">
                                                        <a href="{{route('products_detail',$product->slug)}}">{{$product->title}}</a>
                                                    </li>

                                                    <li class="text-content"><span class="text-title show">Weight</span><span class="text-title hide">Wt</span> - {{$cart['weight']}}</li>
                                                    <li class="text-content"><span class="text-title show">Quantity</span><span class="text-title hide">Qt</span> - {{$cart['quantity']}}</li>
                                                    <li class="text-content"><span class="text-title hide">Price - {!! $settings->currency_symbol ?? '' !!} {{ $cart['price'] ?? '' }}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="price show">
                                        <h4 class="table-title text-content">Price</h4>
                                        <h5>{!! $settings->currency_symbol ?? '' !!} {{ $cart['price'] ?? '' }}<del class="text-content">{!! $settings->currency_symbol ?? '' !!} {{ $cart['mrp'] ?? '' }}</del></h5>
                                        @if(!empty($cart['mrp']))<h6 class="theme-color">You Save : {!! $settings->currency_symbol ?? '' !!} {{$cart['mrp'] - $cart['price'] }}</h6>@endif
                                    </td>

                                    <td class="price show">
                                        <h4 class="table-title text-content">Qty</h4>
                                        <h5>{{ $cart['quantity'] ?? '' }}</h5>
                                    </td>

                                    <td class="subtotal show">
                                        <h4 class="table-title text-content">Total</h4>
                                        <h5>{!! $settings->currency_symbol ?? '' !!} {{$cart['price'] * $cart['quantity']}}</h5>
                                    </td>

                                    <td class="save-remove">
                                        <h4 class="table-title text-content">Action</h4>   
                                        <form action="{{route('add-to-cart')}}" method="post">
                                            @csrf                                    
                                            <input type="hidden" name="slug" value="{{$product->slug}}">
                                            <input type="hidden" name="weight" value="{{$cart['quantity']}}">
                                            <input type="hidden" name="price" value="{{$cart['price']}}">
                                            <input type="hidden" name="mrp" value="{{$cart['mrp'] ?? ''}}">
                                            <input type="hidden" name="quant" value="1">
                                            <button class="save notifi-wishlist add_to_wishlist" style="border:none;background:transparent;" type="submit" name="wishlist_btn" value="wishlist_btn"><i data-feather="heart"></i></button>
                                        </form>
                                        <form action="{{route('cart_delete')}}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$cart['product_id']}}" name="id">
                                            <input type="hidden" value="{{$cart['weight']}}" name="weight">                                            
                                            <button class="remove close_button" style="border:none;background:transparent;" type="submit"><i data-feather="trash"></i></button>                                        
                                    </td>
                                    </form>
                                </tr>
                                @endif
                                @endforeach
                                @endforeach
                                @endif
                               @endforeach
                              @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3">
                <div class="summery-box p-sticky">
                    <div class="summery-header">
                        <h3>Cart Total</h3>
                    </div>

                    <div class="summery-contain">
                        {{--<div class="coupon-cart">
                            <h6 class="text-content mb-2">Coupon Apply</h6>
                            <div class="mb-3 coupon-box input-group">
                                <input type="email" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Coupon Code Here...">
                                <button class="btn-apply">Apply</button>
                            </div>
                        </div>--}}
                        <ul>
                            <li>
                                <h4>Subtotal</h4>
                                <h4 class="price">{!! $settings->currency_symbol ?? '' !!} {{App\Helper::totalCartPrice() ?? ''}}</h4>
                            </li>
                        </ul>
                    </div>

                    <ul class="summery-total">
                        <li class="list-total border-top-0">
                            <h4>Total</h4>
                            <h4 class="price theme-color">{!! $settings->currency_symbol ?? '' !!} {{App\Helper::totalCartPrice() ?? ''}}</h4>
                        </li>
                    </ul>

                    <div class="button-group cart-button">
                        <ul>
                            <li>
                                <form action="{{route('checkout')}}" method="post"> @csrf <input type="hidden" value="from_cart" name="checkout"><button class="btn btn-animation proceed-btn fw-bold" type="submit">Process To Checkout</button></form>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Cart Section End -->

<style>
    @media (orientation: portrait) {
        .show {
            display:none;
        }
        .hide {
            display:inline-block;
        }
    }
    @media (orientation: landscape) {
        .show {
            display:inline-block;
        }
        .hide {
            display:none;
        }
    }

    .cart-table table tbody tr td.product-detail .product .product-detail ul li:nth-child(n+4)
    {
        display:block;
    }
</style>

@endsection
