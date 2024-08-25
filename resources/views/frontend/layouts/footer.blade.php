@php
 $current_theme = DB::table('themes')->where('current_theme',1)->first();
 if($current_theme->id == 1){
    $color= "#d99f46";
 }
 if($current_theme->id == 2){
    $color= "#0e947a";
 }
 if($current_theme->id == 3){
    $color= "#239698";
 }
 if($current_theme->id == 4){
    $color= "#417394";
 }
@endphp
<style>
    .service-box{
        background-color:<?php echo $color; ?>;
        padding: 10px;
    }
    .service-image{
        background-color:#FFFFFF;
        padding: 10px;
    }
    .service-contain .service-box .service-detail h5 {
    font-weight: 500;
    color: #fff;
}
</style>

<link rel="stylesheet" href="{{ asset('dashboard/plugins/toastr/css/toastr.min.css') }}">
 <!-- Footer Section Start -->
 <footer class="section-t-space">
     <div class="container-fluid-lg">
         <div class="service-section">
             <div class="row g-3">
                 <div class="col-12">
                     <div class="service-contain">
                         <div class="service-box">
                             <div class="service-image">
                                 <img src="https://themes.pixelstrap.com/fastkart/assets/svg/product.svg"
                                     class="blur-up lazyload" alt="">
                             </div>

                             <div class="service-detail">
                                 <h5>Every Fresh Products</h5>
                             </div>
                         </div>

                         <div class="service-box">
                             <div class="service-image">
                                 <img src="https://themes.pixelstrap.com/fastkart/assets/svg/delivery.svg"
                                     class="blur-up lazyload" alt="">
                             </div>

                             <div class="service-detail">
                                 <h5>Free Delivery For Order Over ₹1000</h5>
                             </div>
                         </div>

                         <div class="service-box">
                             <div class="service-image">
                                 <img src="https://themes.pixelstrap.com/fastkart/assets/svg/discount.svg"
                                     class="blur-up lazyload" alt="">
                             </div>

                             <div class="service-detail">
                                 <h5>Daily Mega Discounts</h5>
                             </div>
                         </div>

                         <div class="service-box">
                             <div class="service-image">
                                 <img src="https://themes.pixelstrap.com/fastkart/assets/svg/market.svg"
                                     class="blur-up lazyload" alt="">
                             </div>

                             <div class="service-detail">
                                 <h5>Best Price On The Market</h5>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div class="main-footer section-b-space section-t-space">
             <div class="row g-md-4 g-3">
                 <div class="col-xl-3 col-lg-4 col-sm-6">
                     <div class="footer-logo">
                         <div class="theme-logo">
                             <a href="{{URL::to('/')}}">
                                 <img src="{{ asset('uploads/setting/'.$settings->logo_path) }}" class="blur-up lazyload" alt="">
                             </a>
                         </div>

                         <div class="footer-logo-contain">
                             <p>
                               {!! strip_tags($setting->site_description) !!}
                             </p>

                             <ul class="address">
                                 <li>
                                     <i data-feather="home"></i>
                                     <a href="javascript:void(0)">{{$settings->address ?? ''}}</a>
                                 </li>
                                 <li>
                                     <i data-feather="mail"></i>
                                     <a href="javascript:void(0)">{{$settings->email ?? ''}}</a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>

                 <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                     <div class="footer-title">
                         <h4>Categories</h4>
                     </div>

                     <div class="footer-contain">
                         <ul>
                         @if(count($product_categories_footer)>0)
                            @foreach($product_categories_footer as $product_category_footer)
                             <li>
                                 <a href="{{route('products',$product_category_footer->id)}}" class="text-content">{{$product_category_footer->title}}</a>
                             </li>
                             @endforeach
                             @endif
                         </ul>
                     </div>
                 </div>

                 <div class="col-xl col-lg-2 col-sm-3">
                     <div class="footer-title">
                         <h4>Useful Links</h4>
                     </div>

                     <div class="footer-contain">
                         <ul>
                             <li>
                                 <a href="{{URL::to('/')}}" class="text-content">Home</a>
                             </li>
                             <li>
                                 <a href="{{route('about_us')}}" class="text-content">About Us</a>
                             </li>
                             <li>
                                 <a href="{{route('blogs')}}" class="text-content">Blog</a>
                             </li>
                             <li>
                                 <a href="{{route('contact')}}" class="text-content">Contact Us</a>
                             </li>
                         </ul>
                     </div>
                 </div>

                 <div class="col-xl-2 col-sm-3">
                     <div class="footer-title">
                         <h4>Help Center</h4>
                     </div>

                     <div class="footer-contain">
                         <ul>
                            <li>
                                <a href="{{route('user.user_dashboard')}}" class="text-content">Your Account</a>
                            </li>
                            <li>
                                <a href="{{route('user.user_dashboard')}}" class="text-content">Track Orders</a>
                            </li>
                            <li>
                                <a href="{{route('wishlist')}}" class="text-content">Your Wishlist</a>
                            </li>
                            <li>
                                <a href="{{route('faq')}}" class="text-content">FAQs</a>
                            </li>
                         </ul>
                     </div>
                 </div>

                 <div class="col-xl-3 col-lg-4 col-sm-6">
                     <div class="footer-title">
                         <h4>Contact Us</h4>
                     </div>

                     <div class="footer-contact">
                         <ul>
                             <li>
                                 <div class="footer-number">
                                     <i data-feather="phone"></i>
                                     <div class="contact-number">
                                         <h6 class="text-content">Hotline 24/7 :</h6>
                                         <h5>{{$settings->phone ?? ''}}</h5>
                                     </div>
                                 </div>
                             </li>

                             <li>
                                 <div class="footer-number">
                                     <i data-feather="mail"></i>
                                     <div class="contact-number">
                                         <h6 class="text-content">Email Address :</h6>
                                         <h5>{{$settings->email ?? ''}}</h5>
                                     </div>
                                 </div>
                             </li>

                             <li class="social-app mb-0">
                                 <h5 class="mb-2 text-content">Download App :</h5>
                                 <ul>
                                     <li class="mb-0">
                                         <a href="javascript::void(0)" target="_blank">
                                             <img src="https://themes.pixelstrap.com/fastkart/assets/images/playstore.svg"
                                                 class="blur-up lazyload" alt="">
                                         </a>
                                     </li>
                                     <li class="mb-0">
                                         <a href="javascript::void(0)" target="_blank">
                                             <img src="https://themes.pixelstrap.com/fastkart/assets/images/appstore.svg"
                                                 class="blur-up lazyload" alt="">
                                         </a>
                                     </li>
                                 </ul>
                             </li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>

         <div class="sub-footer section-small-space">
             <div class="reserve">
                 <h6 class="text-content">©2022 {{$settings->title ?? 'Fastkart'}} All rights reserved</h6>
             </div>

             <div class="payment">
                 <img src="../assets/images/payment/1.png" class="blur-up lazyload" alt="">
             </div>

             <div class="social-link">
                 <h6 class="text-content">Stay connected :</h6>
                 <ul>
                     <li>
                         <a href="https://www.facebook.com/" target="_blank">
                             <i class="fa-brands fa-facebook-f"></i>
                         </a>
                     </li>
                     <li>
                         <a href="https://twitter.com/" target="_blank">
                             <i class="fa-brands fa-twitter"></i>
                         </a>
                     </li>
                     <li>
                         <a href="https://www.instagram.com/" target="_blank">
                             <i class="fa-brands fa-instagram"></i>
                         </a>
                     </li>
                     <li>
                         <a href="https://in.pinterest.com/" target="_blank">
                             <i class="fa-brands fa-pinterest-p"></i>
                         </a>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </footer>
 <!-- Footer Section End -->

 <!-- Location Modal Start -->
 <div class="modal location-modal fade theme-modal" id="locationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Track your order</h5>
                 <p class="mt-1 text-content">Enter your order number here.</p>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                     <i class="fa-solid fa-xmark"></i>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="location-list">
                     <div class="search-input">
                         <input type="search" class="form-control" placeholder="Enter order number" id="order_number">
                         <i class="fa-solid fa-magnifying-glass"></i>
                     </div>
                     <div class="track_order_div mt-3 text-danger"></div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Location Modal End -->

 <!-- Deal Box Modal Start -->
 <div class="modal fade theme-modal deal-modal" id="deal-box" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
         <div class="modal-content">
             <div class="modal-header">
                 <div>
                     <h5 class="modal-title w-100" id="deal_today">Deal Today</h5>
                     <p class="mt-1 text-content">Recommended deals for you.</p>
                 </div>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                     <i class="fa-solid fa-xmark"></i>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="deal-offer-box">
                     <ul class="deal-offer-list">
                        @if(count($deals)>0)
                        @foreach($deals as $deal)
                        @php $product_price=DB::table('product_price')->where('product_id',$deal->id)->first(); @endphp
                         <li class="list-1">
                             <div class="deal-offer-contain">
                                 <a href="{{route('products_detail',$deal->slug)}}" class="deal-image">
                                     <img src="{{URL::to($deal->photo)}}" class="blur-up lazyload"
                                         alt="">
                                 </a>

                                 <a href="{{route('products_detail',$deal->slug)}}" class="deal-contain">
                                     <h5>{{$deal->title}}</h5>
                                     <h6>{!! $settings->currency_symbol ?? '' !!} {{ $product_price->price ?? '' }} <del>{!! $settings->currency_symbol ?? '' !!} {{ $product_price->mrp ?? '' }}</del> <span>{{ $product_price->quantity ?? '' }}</span></h6>
                                 </a>
                             </div>
                         </li>
                         @endforeach
                         @else
                         <h4>No deal available for this moment.</h4>
                         @endif
                     </ul>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Deal Box Modal End -->

 <!-- Add to cart Modal Start -->
 <div class="add-cart-box">
     <div class="add-iamge">
         <img src="../assets/images/cake/pro/1.jpg" class="img-fluid blur-up lazyload" alt="">
     </div>

     <div class="add-contain">
         <h6>Added to Cart</h6>
     </div>
 </div>
 <!-- Add to cart Modal End -->

 <!-- Tap to top start -->
 <div class="theme-option">
     <div class="back-to-top">
         <a id="back-to-top" href="#">
             <i class="fas fa-chevron-up"></i>
         </a>
     </div>
 </div>
 <!-- Tap to top end -->

 <!-- Bg overlay Start -->
 <div class="bg-overlay"></div>
 <!-- Bg overlay End -->

 <!-- latest jquery-->
 <script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>

 <!-- jquery ui-->
 <script src="{{URL::to('public/frontend/bakery/assets/js/jquery-ui.min.js')}}"></script>

 <!-- sidebar open js -->
 <script src="{{URL::to('public/frontend/bakery/assets/js/filter-sidebar.js')}}"></script>

 <!-- Bootstrap js-->
 <script src="{{URL::to('public/frontend/bakery/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
 <script src="{{URL::to('public/frontend/bakery/assets/js/bootstrap/popper.min.js')}}"></script>

 <!-- feather icon js-->
 <script src="{{URL::to('public/frontend/bakery/assets/js/feather/feather.min.js')}}"></script>
 <script src="{{URL::to('public/frontend/bakery/assets/js/feather/feather-icon.js')}}"></script>

 <!-- Lazyload Js -->
 <script src="{{URL::to('public/frontend/bakery/assets/js/lazysizes.min.js')}}"></script>

 <!-- Slick js-->
 <script src="{{URL::to('public/frontend/bakery/assets/js/slick/slick.js')}}"></script>
 <script src="{{URL::to('public/frontend/bakery/assets/js/slick/custom_slick.js')}}"></script>
 <script src="{{URL::to('public/frontend/bakery/assets/js/bootstrap/bootstrap-notify.min.js')}}"></script>

 <!-- Auto Height Js -->
 <script src="{{URL::to('public/frontend/bakery/assets/js/auto-height.js')}}"></script>

 <!-- Timer Js -->
 <script src="{{URL::to('public/frontend/bakery/assets/js/timer1.js')}}"></script>

 <!-- Fly Cart Js -->
 <script src="{{URL::to('public/frontend/bakery/assets/js/fly-cart.js')}}"></script>

 <!-- Quantity js -->
 <script src="{{URL::to('public/frontend/bakery/assets/js/quantity-2.js')}}"></script>

 <!-- WOW js -->
 <script src="{{URL::to('public/frontend/bakery/assets/js/wow.min.js')}}"></script>
 <script src="{{URL::to('public/frontend/bakery/assets/js/custom-wow.js')}}"></script>

 <!-- script js -->
 <script src="{{URL::to('public/frontend/bakery/assets/js/script.js')}}"></script>

 <!-- thme setting js -->
 <script src="{{URL::to('public/frontend/bakery/assets/js/theme-setting.js')}}"></script>

 <script>
setTimeout(function() {
    $('.alert2').slideUp();
}, 4000);
 </script>


<!-- Lordicon Js -->
<script src="{{URL::to('public/frontend/bakery/assets/js/lusqsztk.js')}}"></script>

<!-- Delivery Option js -->
<script src="{{URL::to('public/frontend/bakery/assets/js/delivery-option.js')}}"></script>

<!-- Quantity js -->
<script src="{{URL::to('public/frontend/bakery/assets/js/quantity.js')}}"></script>

  <!-- toastr Js -->
  <script src="{{ asset('dashboard/plugins/toastr/js/toastr.min.js') }}"></script>
    <!-- Toastr message display -->
    @toastr_render

    <script type="text/javascript">
        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr["error"]("{{ $error }}");
            @endforeach
        @endif

        @if(session::has('api_response_success'))
            toastr["success"]("{{ session::get('api_response_success') }}");
        @endif


    @if(session::has('api_response_error'))
           toastr["error"]("{{ session::get('api_response_error') }}");
    @endif

    </script>

    <style>
/**====== Toastr css ======**/
.toast-success {
  color: #fff;
  background-color: #1de9b6;
  border-color: #1de9b6;
}
.toast-error {
  color: #fff;
  background-color: #f44236;
  border-color: #f44236;
}
/**====== Toastr css end ======**/

    </style>

<script src="https://kit.fontawesome.com/8762af7154.js" crossorigin="anonymous"></script>

<script>
    $("#order_number").keyup(function(){
        var order_number = $(this).val();
        if (order_number != '') {
                $.ajax({
                    type:"GET",
                        url: "{{route('track_order')}}",
                        data: {order_number: order_number},      
                        success: function(data){
                            $('.track_order_div').html(data);
                        }
                    });  
            }
    });
</script>