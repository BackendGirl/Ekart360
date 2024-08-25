@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')


<!-- Breadcrumb Section Start -->
@include('frontend.layouts.breadscrumb')
<!-- Breadcrumb Section End -->


<!-- Checkout section Start -->
<section class="checkout-section-2 section-b-space">
    <div class="container-fluid-lg">
    <form action="{{route('order')}}" method="post">
            @csrf
        <div class="row g-sm-4 g-3">         
            <div class="col-lg-8">
                <div class="left-sidebar-checkout">
                    <div class="checkout-detail-box">
                        <ul>
                            <input type="hidden" value="{{$buy}}" name="buy">
                            <li>
                                <div class="checkout-icon">
                                    <lord-icon target=".nav-item" src="https://cdn.lordicon.com/ggihhudh.json"
                                        trigger="loop-on-hover"
                                        colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a" class="lord-icon">
                                    </lord-icon>
                                </div>
                                <div class="checkout-box">
                                    <div class="checkout-title">
                                        <h4>Delivery Address <span class="text-danger">*</span></h4>
                                    </div>

                                    <div class="checkout-detail">
                                        <div class="row g-4">
                                            @if(count($user_addresses)>0)
                                            @foreach($user_addresses as $user_address)
                                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                                <div class="delivery-address-box">
                                                    <div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="user_address" value="{{$user_address->id}}"
                                                                id="flexRadioDefault1" @if($user_address->default_address == 1) checked @endif>
                                                        </div>

                                                        <div class="label">
                                                            <label>{{$user_address->address_type}}</label>
                                                        </div>

                                                        <ul class="delivery-address-detail">
                                                            <li>
                                                                <h4 class="fw-500">{{$user_address->name}}</h4>
                                                            </li>

                                                            <li>
                                                                {{$user_address->address}},
                                                                {{$user_address->pin_code}},
                                                            </li>

                                                            <li>
                                                                <h6 class="text-content"><span class="text-title">Pin Code:</span> {{$user_address->pin_code}}</h6>
                                                            </li>

                                                            <li>
                                                                <h6 class="text-content mb-0"><span
                                                                        class="text-title">Phone
                                                                        :</span> {{$user_address->phone}}</h6>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif

                                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                                <div class="delivery-address-box">
                                                    <form action="">
                                                        <label for="address" class="form-label">Address : </label>
                                                        <textarea name="address" id="address" class="form-control" name="address"></textarea>
                                                        <br>
                                                        <label for="pin_code" class="form-label">Pin Code : </label>
                                                        <input type="text" id="pin_code" name="pin_code" class="form-control">
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="checkout-icon">
                                    <lord-icon target=".nav-item" src="https://cdn.lordicon.com/oaflahpk.json"
                                        trigger="loop-on-hover" colors="primary:#0baf9a" class="lord-icon">
                                    </lord-icon>
                                </div>
                                <div class="checkout-box">
                                    <div class="checkout-title">
                                        <h4>Delivery Option <span class="text-danger">*</span></h4>
                                    </div>

                                    <div class="checkout-detail">
                                        <div class="row g-4">
                                            <div class="col-xxl-6">
                                                <div class="delivery-option">
                                                    <div class="delivery-category">
                                                        <div class="shipment-detail">
                                                            <div class="form-check custom-form-check hide-check-box">
                                                                <input class="form-check-input" type="radio"
                                                                    name="delivery_option" value="standard_delivery" id="standard">
                                                                <label class="form-check-label" for="standard">Standard
                                                                    Delivery Option</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-6">
                                                <div class="delivery-option">
                                                    <div class="delivery-category">
                                                        <div class="shipment-detail">
                                                            <div
                                                                class="form-check mb-0 custom-form-check show-box-checked">
                                                                <input class="form-check-input" type="radio"
                                                                    name="delivery_option" value="future_delivery" id="future">
                                                                <label class="form-check-label" for="future">Future
                                                                    Delivery Option</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 future-box">
                                                <div class="future-option">
                                                    <div class="row g-md-0 gy-4">
                                                        <div class="col-md-6">
                                                            <div class="delivery-items">
                                                                <div>
                                                                    <h5 class="items text-content"><span>{{$total_products ?? ''}}
                                                                            Items</span>@
                                                                            {!! $settings->currency_symbol ?? '' !!} {{ $total ?? '' }}</h5>
                                                                    <h5 class="charge text-content">Delivery Charge
                                                                    {!! $settings->currency_symbol ?? '' !!} 150
                                                                        <button type="button" class="btn p-0"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="top"
                                                                            title="Extra Charge">
                                                                            <i class="fa-solid fa-circle-exclamation"></i>
                                                                        </button>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <form class="form-floating theme-form-floating date-box">
                                                                <input type="date" class="form-control" name="future_delivery_date">
                                                                <label>Select Date <span class="text-danger">*</span></label>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="checkout-icon">
                                    <lord-icon target=".nav-item" src="https://cdn.lordicon.com/qmcsqnle.json"
                                        trigger="loop-on-hover" colors="primary:#0baf9a,secondary:#0baf9a"
                                        class="lord-icon">
                                    </lord-icon>
                                </div>
                                <div class="checkout-box">
                                    <div class="checkout-title">
                                        <h4>Payment Option <span class="text-danger">*</span></h4>
                                    </div>

                                    <div class="checkout-detail">
                                        <div class="accordion accordion-flush custom-accordion"
                                            id="accordionFlushExample">

                                            <div class="accordion-item">
                                                <div class="accordion-header" id="flush-headingFour">
                                                    <div class="accordion-button collapsed" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseFour">
                                                        <div class="custom-form-check form-check mb-0">
                                                            <label class="form-check-label" for="cash"><input
                                                                    class="form-check-input mt-0" type="radio"
                                                                    name="payment_option" value="cod" id="cash"> Cash
                                                                On Delivery</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <div class="accordion-header" id="flush-headingFour">
                                                    <div class="accordion-button collapsed" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseFour">
                                                        <div class="custom-form-check form-check mb-0">
                                                            <label class="form-check-label" for="gateway"><input
                                                                    class="form-check-input mt-0" type="radio"
                                                                    name="payment_option" value="gateway" id="gateway"> Payment Gateway (Razorpay)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="right-side-summery-box">
                    <div class="summery-box-2">
                        <div class="summery-header">
                            <h3>Order Summery</h3>
                        </div>

                        <ul class="summery-contain">
                            @if(session()->get('checkout_products'))
                            @foreach(session()->get('checkout_products') as $key=>$checkout_products2)
                            @if($key == $theme)
                            @foreach($checkout_products2 as $checkout_products3)
                            @foreach($checkout_products3 as $checkout_products)
                            @php $product = DB::table('products')->where('id',$checkout_products['product_id'])->first(); @endphp
                            <li>
                                <img src="{{URL::to($product->photo)}}"
                                    class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                <h4>{{$product->title}} @if($checkout_products['weight'])
                                    ({{$checkout_products['weight']}}) @endif <span>X
                                        {{ $checkout_products['quantity'] ?? '' }}</span></h4>
                                <h4 class="price">{!! $settings->currency_symbol ?? '' !!}
                                    {{ $checkout_products['price'] ?? '' }}</h4>
                            </li>
                            @endforeach
                            @endforeach
                            @endif
                            @endforeach
                            @endif

                        </ul>

                        <ul class="summery-total">
                            <li>
                                <h4>Subtotal</h4>
                                <h4 class="price">{!! $settings->currency_symbol ?? '' !!} {{ $sub_total ?? '' }}</h4>
                            </li>

                            <li>
                                <h4>Shipping</h4>
                                <h4 class="price">{!! $settings->currency_symbol ?? '' !!} {{ $shipping ?? '' }}</h4>
                            </li>

                            <li>
                                <h4>Tax</h4>
                                <h4 class="price">{!! $settings->currency_symbol ?? '' !!} {{ $tax ?? '' }}</h4>
                            </li>

                            <li class="list-total">
                                <h4>Total</h4>
                                <h4 class="price">{!! $settings->currency_symbol ?? '' !!} {{ $total ?? '' }}</h4>
                            </li>
                        </ul>
                    </div>

                    <button class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold" type="submit">Place Order</button>
                </div>
            </div>
        </div>
        </form>

    </div>
</section>
<!-- Checkout section End -->

<style>
    .checkout-section-2 .left-sidebar-checkout .checkout-detail-box>ul>li .checkout-box .checkout-detail .custom-accordion .accordion-item .accordion-header .accordion-button::before{
        all:unset;
    }
</style>
@endsection