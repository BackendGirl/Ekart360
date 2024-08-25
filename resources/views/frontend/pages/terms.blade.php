@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')


<!-- Breadcrumb Section Start -->
@include('frontend.layouts.breadscrumb')
<!-- Breadcrumb Section End -->

<!-- Cart Section Start -->
<section class="cart-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row g-sm-5 g-3 text-center">
           <div class="col-md-3"></div>
           <div class="col-md-6"><img src="https://static.wixstatic.com/media/ea6ac8_08a05b026f654bcdaa60a5164a0da1d0~mv2.jpg/v1/fill/w_640,h_360,al_c,q_80,usm_0.66_1.00_0.01,enc_auto/ea6ac8_08a05b026f654bcdaa60a5164a0da1d0~mv2.jpg" style="width:600px;"></div>
           <div class="col-md-3"></div>
        </div>
    </div>
</section>
<!-- Cart Section End -->

@endsection
