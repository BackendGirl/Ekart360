<link rel="stylesheet" href="{{ asset('dashboard/plugins/toastr/css/toastr.min.css') }}">
 <!-- Footer Start -->
 <footer class="section-t-space footer-section-2 footer-color-2">
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
                                        <p>Email Us: {{$settings->email ?? ''}}</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="sub-footer sub-footer-lite section-b-space section-t-space">
                <div class="left-footer">
                    <p class="light-text">2022 Copyright By {{$settings->title}}</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

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
        <div class="modal fade theme-modal deal-modal" id="deal-box2" tabindex="-1" aria-labelledby="exampleModalLabel"
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

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <!-- latest jquery-->
    <script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>

    <!-- jquery ui-->
    <script src="{{URL::to('public/frontend/bakery/assets/js/jquery-ui.min.js')}}"></script>

    <!-- Bootstrap js-->
    <script src="{{URL::to('public/frontend/bakery/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{URL::to('public/frontend/bakery/assets/js/bootstrap/bootstrap-notify.min.js')}}"></script>
    <script src="{{URL::to('public/frontend/bakery/assets/js/bootstrap/popper.min.js')}}"></script>

    <!-- feather icon js-->
    <script src="{{URL::to('public/frontend/bakery/assets/js/feather/feather.min.js')}}"></script>
    <script src="{{URL::to('public/frontend/bakery/assets/js/feather/feather-icon.js')}}"></script>

    <!-- Lazyload Js -->
    <script src="{{URL::to('public/frontend/bakery/assets/js/lazysizes.min.js')}}"></script>

    <!-- Slick js-->
    <script src="{{URL::to('public/frontend/bakery/assets/js/slick/slick.js')}}"></script>
    <script src="{{URL::to('public/frontend/bakery/assets/js/slick/slick-animation.min.js')}}"></script>
    <script src="{{URL::to('public/frontend/bakery/assets/js/custom-slick-animated.js')}}"></script>
    <script src="{{URL::to('public/frontend/bakery/assets/js/slick/custom_slick.js')}}"></script>

    <!-- Range slider js -->
    <script src="{{URL::to('public/frontend/bakery/assets/js/ion.rangeSlider.min.js')}}"></script>

    <!-- Auto Height Js -->
    <script src="{{URL::to('public/frontend/bakery/assets/js/auto-height.js')}}"></script>

    <!-- Lazyload Js -->
    <script src="{{URL::to('public/frontend/bakery/assets/js/lazysizes.min.js')}}"></script>

    <!-- Quantity js -->
    <script src="{{URL::to('public/frontend/bakery/assets/js/quantity-2.js')}}"></script>

    <!-- Fly Cart Js -->
    <script src="{{URL::to('public/frontend/bakery/assets/js/fly-cart.js')}}"></script>

    <!-- Timer Js -->
    <script src="{{URL::to('public/frontend/bakery/assets/js/timer1.js')}}"></script>
    <script src="{{URL::to('public/frontend/bakery/assets/js/timer2.js')}}"></script>

    <!-- Copy clipboard Js -->
    <script src="{{URL::to('public/frontend/bakery/assets/js/clipboard.min.js')}}"></script>
    <script src="{{URL::to('public/frontend/bakery/assets/js/copy-clipboard.js')}}"></script>

    <!-- WOW js -->
    <script src="{{URL::to('public/frontend/bakery/assets/js/wow.min.js')}}"></script>
    <script src="{{URL::to('public/frontend/bakery/assets/js/custom-wow.js')}}"></script>

    <!-- script js -->
    <script src="{{URL::to('public/frontend/bakery/assets/js/script.js')}}"></script>

    <!-- thme setting js -->
    <script src="{{URL::to('public/frontend/bakery/assets/js/theme-setting.js')}}"></script>
    <script src="https://kit.fontawesome.com/8762af7154.js" crossorigin="anonymous"></script>

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