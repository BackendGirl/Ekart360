<link rel="stylesheet" href="{{ asset('dashboard/plugins/toastr/css/toastr.min.css') }}">
    <!-- Footer Section Start -->
    <footer class="section-t-space footer-section-2 footer-color-3">
        <div class="container-fluid-lg">
        <div class="main-footer">
                <div class="row g-md-4 gy-sm-5">
                    <div class="col-xxl-3 col-xl-4 col-sm-6">
                        <a href="{{URL::to('/')}}" class="foot-logo theme-logo">
                            <img src="{{ asset('uploads/setting/'.$settings->logo_path) }}" class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <p class="information-text information-text-2">{!! strip_tags($setting->site_description) !!}</p>
                        <ul class="social-icon">
                            <li class="light-bg">
                                <a href="https://www.facebook.com/" class="footer-link-color">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li class="light-bg">
                                <a href="https://accounts.google.com/signin/v2/identifier?flowName=GlifWebSignIn&amp;flowEntry=ServiceLogin"
                                    class="footer-link-color">
                                    <i class="fab fa-google"></i>
                                </a>
                            </li>
                            <li class="light-bg">
                                <a href="https://twitter.com/i/flow/login" class="footer-link-color">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li class="light-bg">
                                <a href="https://www.instagram.com/" class="footer-link-color">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li class="light-bg">
                                <a href="https://in.pinterest.com/" class="footer-link-color">
                                    <i class="fab fa-pinterest-p"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-xxl-2 col-xl-4 col-sm-6">
                        <div class="footer-title">
                            <h4 class="text-white">About Fastkart</h4>
                        </div>
                        <ul class="footer-list footer-contact footer-list-light">
                            <li>
                                <a href="{{route('about_us')}}" class="light-text">About Us</a>
                            </li>
                            <li>
                                <a href="{{route('contact')}}" class="light-text">Contact Us</a>
                            </li>
                            <li>
                                <a href="{{route('terms')}}" class="light-text">Terms & Coditions</a>
                            </li>
                            <li>
                                <a href="{{route('blogs')}}" class="light-text">Latest Blog</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-xxl-2 col-xl-4 col-sm-6">
                        <div class="footer-title">
                            <h4 class="text-white">Useful Link</h4>
                        </div>
                        <ul class="footer-list footer-list-light footer-contact">
                            <li>
                                <a href="{{route('user.user_dashboard')}}" class="light-text">Your Account</a>
                            </li>
                            <li>
                                <a href="{{route('user.user_dashboard')}}" class="light-text">Track Orders</a>
                            </li>
                            <li>
                                <a href="{{route('wishlist')}}" class="light-text">Your Wishlist</a>
                            </li>
                            <li>
                                <a href="{{route('faq')}}" class="light-text">FAQs</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-xxl-2 col-xl-4 col-sm-6">
                        <div class="footer-title">
                            <h4 class="text-white">Categories</h4>
                        </div>
                        <ul class="footer-list footer-list-light footer-contact">
                            @if(count($product_categories_footer)>0)
                            @foreach($product_categories_footer as $product_category_footer)
                            <li>
                                <a href="{{route('products',$product_category_footer->id)}}" class="light-text">{{$product_category_footer->title ?? ''}}</a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="col-xxl-3 col-xl-4 col-sm-6">
                        <div class="footer-title">
                            <h4 class="text-white">Store infomation</h4>
                        </div>
                        <ul class="footer-address footer-contact">
                            <li>
                                <a href="javascript:void(0)" class="light-text">
                                    <div class="inform-box flex-start-box">
                                        <i data-feather="map-pin"></i>
                                        <p>{{$settings->address ?? ''}}</p>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)" class="light-text">
                                    <div class="inform-box">
                                        <i data-feather="phone"></i>
                                        <p>Call us: {{$settings->phone ?? ''}}</p>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)" class="light-text">
                                    <div class="inform-box">
                                        <i data-feather="mail"></i>
                                        <p>Email Us: {{$settings->support ?? ''}}</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="sub-footer sub-footer-lite section-b-space section-t-space">
                <div class="left-footer">
                    <p class="light-text">2022 Copyright By Themeforest Powered By Pixelstrap</p>
                </div>

                <ul class="payment-box">
                    <li>
                        <img src="../assets/images/icon/paymant/visa.png" class="blur-up lazyload" alt="">
                    </li>
                    <li>
                        <img src="../assets/images/icon/paymant/discover.png" alt="" class="blur-up lazyload">
                    </li>
                    <li>
                        <img src="../assets/images/icon/paymant/american.png" alt="" class="blur-up lazyload">
                    </li>
                    <li>
                        <img src="../assets/images/icon/paymant/master-card.png" alt="" class="blur-up lazyload">
                    </li>
                    <li>
                        <img src="../assets/images/icon/paymant/giro-pay.png" alt="" class="blur-up lazyload">
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

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