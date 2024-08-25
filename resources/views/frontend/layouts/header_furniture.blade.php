  <!-- Header Start -->
  <header class="">
        <div class="header-top">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-xxl-3 d-xxl-block d-none">
                        <div class="top-left-header">
                            <span class="text-white">{{$settings->address ?? ''}}</span>
                        </div>
                    </div>

                    <div class="col-xxl-6 col-lg-9 d-lg-block d-none">
                        <div class="header-offer">
                            <div class="notification-slider">
                                @if(count($header_notifications)>0)
                                    @foreach($header_notifications as $notification)
                                        <div>
                                            <div class="timer-notification">
                                                {!!$notification->title!!}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <ul class="about-list right-nav-about">
                            <li class="right-nav-list text-white">
                                {{$settings->phone ?? ''}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="top-nav top-header sticky-header">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar-top">
                            <button class="navbar-toggler d-xl-none d-inline navbar-menu-button me-2" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                                <span class="navbar-toggler-icon">
                                    <i class="fa-solid fa-bars"></i>
                                </span>
                            </button>
                            <a href="{{URL::to('/')}}" class="web-logo nav-logo">
                                <img src="{{ asset('uploads/setting/'.$settings->logo_path) }}" class="img-fluid blur-up lazyload" alt="">
                            </a>

                            <div class="header-nav-middle">
                                <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                                    <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                        <div class="offcanvas-header navbar-shadow">
                                            <h5>Menu</h5>
                                            <button class="btn-close lead" type="button" data-bs-dismiss="offcanvas"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link nav-link-manual" href="{{URL::to('/')}}">Home</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link nav-link-manual" href="{{route('about_us')}}">About Us</a>
                                        </li>

                                        @if(count($product_categories)>0)
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                data-bs-toggle="dropdown">Product</a>

                                            <ul class="dropdown-menu">
                                                @foreach($product_categories as $product_category)
                                                 <li><a class="dropdown-item" href="{{route('products',$product_category->id)}}">{{$product_category->title}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endif

                                        <li class="nav-item dropdown dropdown-mega">
                                            <a class="nav-link dropdown-toggle ps-xl-2 ps-0" href="javascript:void(0)"
                                                data-bs-toggle="dropdown">Mega Menu</a>

                                            <div class="dropdown-menu dropdown-menu-2 mega_menu_dropdown">
                                                <div class="row">
                                                    <div class="dropdown-column col-xl-3">
                                                        <h5 class="dropdown-header">Daily Staples</h5>
                                                        @foreach($daily_staples as $daily_staple)
                                                         <a class="dropdown-item" href="{{route('products_detail',$daily_staple->slug)}}">{{$daily_staple->title}}</a>
                                                        @endforeach
                                                    </div>

                                                    <div class="dropdown-column col-xl-3">
                                                        <h5 class="dropdown-header">Top Save Products</h5>
                                                        @foreach($top_save_products as $top_save_product)
                                                         <a class="dropdown-item" href="{{route('products_detail',$top_save_product->slug)}}">{{$top_save_product->title}}</a>
                                                        @endforeach
                                                    </div>

                                                    <div class="dropdown-column col-xl-3">
                                                        <h5 class="dropdown-header">Recently Added Products</h5>
                                                        @foreach($recently_added_products as $recently_added_product)
                                                         <a class="dropdown-item" href="{{route('products_detail',$recently_added_product->slug)}}">{{$recently_added_product->title}}</a>
                                                        @endforeach
                                                    </div>

                                                    <div class="dropdown-column dropdown-column-img col-3"></div>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link nav-link-manual" href="{{route('blogs')}}">Blog</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link nav-link-manual" href="{{route('contact')}}">Contact</a>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                data-bs-toggle="dropdown">Seller</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{route('become_seller')}}">Become a
                                                        Seller</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{route('vender.vender_dashboard')}}">Seller
                                                        Dashboard</a>
                                                </li>                                               
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                    </div>
                                </div>
                            </div>

                            <div class="rightside-box">
                                <div class="search-full">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i data-feather="search" class="font-light"></i>
                                        </span>
                                        <input type="text" class="form-control search-type" placeholder="Search here..">
                                        <span class="input-group-text close-search">
                                            <i data-feather="x" class="font-light"></i>
                                        </span>
                                    </div>
                                </div>
                                <ul class="right-side-menu">
                                    <li class="right-side">
                                        <div class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <div class="search-box">
                                                    <i data-feather="search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="right-side">
                                        <a href="{{route('wishlist')}}" class="btn p-0 position-relative header-wishlist">
                                            <i data-feather="heart"></i>
                                            <span class="position-absolute top-0 start-100 translate-middle badge">{{App\Helper::wishlistCount() ?? 0}}
                                                </span>
                                        </a>
                                    </li>
                                    <li class="right-side">
                                        <div class="onhover-dropdown header-badge">
                                            <button type="button" class="btn p-0 position-relative header-wishlist">
                                                <i data-feather="shopping-cart"></i>
                                                <span class="position-absolute top-0 start-100 translate-middle badge">{{App\Helper::cartCount() ?? 0}}
                                                    <span class="visually-hidden">unread messages</span>
                                                </span>
                                            </button>

                                            <div class="onhover-div">
                                            <ul class="cart-list">
                                                @if(session()->get('cart'))
                                                @foreach(session()->get('cart') as $key=>$cart2)
                                                @if($key == $theme)
                                                @foreach($cart2 as $cart3)
                                                @foreach($cart3 as $cart_key=>$cart)
                                                @php $product = DB::table('products')->where('id',$cart['product_id'])->first() @endphp
                                                    <li class="product-box-contain cartli">
                                                        <div class="drop-cart">
                                                            <a href="{{route('products_detail',$product->slug)}}" class="drop-image">
                                                                <img src="{{URL::to($product->photo)}}"
                                                                    class="blur-up lazyload" alt="">
                                                            </a>

                                                            <div class="drop-contain">
                                                                <a href="{{route('products_detail',$product->slug)}}">
                                                                    <h5>{{$product->title}}</h5>
                                                                </a>
                                                                <h6><span>{{$cart['quantity']}}</span> {!! $settingss->currency_symbol ?? '' !!} {{ $cart['price'] ?? '' }}</h6>
                                                                <form action="{{route('cart_delete')}}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" value="{{$cart['product_id']}}" name="id">
                                                                    <input type="hidden" value="{{$cart['weight']}}" name="weight">
                                                                <button class="close-button close_button" type="submit">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </form>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                @endforeach
                                                @endif
                                                @endforeach
                                                @endif

                                                </ul>

                                                <div class="price-box">
                                                    <h5>Total :</h5>
                                                    <h4 class="theme-color fw-bold">{!! $settingss->currency_symbol ?? '' !!} {{ $total_cart_price ?? '' }}</h4>
                                                </div>

                                                <div class="button-group">
                                                    <a href="{{route('cart')}}" class="btn btn-sm cart-button">View Cart</a>
                                                    <a href="{{route('checkout')}}" class="btn btn-sm cart-button theme-bg-color
                                                    text-white">Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="right-side onhover-dropdown">
                                        <div class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <i data-feather="user"></i>
                                            </div>
                                            <div class="delivery-detail">
                                                <h6>Hello,</h6>
                                                <h5>My Account</h5>
                                            </div>
                                        </div>

                                        <div class="onhover-div onhover-div-login">
                                            <ul class="user-box-name">
                                                <li class="product-box-contain">
                                                    <i></i>
                                                    <a href="{{route('login')}}">Log In</a>
                                                </li>

                                                <li class="product-box-contain">
                                                    <a href="{{route('register')}}">Register</a>
                                                </li>

                                                <li class="product-box-contain">
                                                    <a href="{{route('forgot_password')}}">Forgot Password</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- mobile fix menu start -->
    <div class="mobile-menu d-md-none d-block mobile-cart">
        <ul>
            <li class="@if(Route::currentRouteName() == 'index') active @endif">
                <a href="{{URL::to('/')}}">
                    <i class="fas fa-house"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="mobile-category @if(Route::currentRouteName() == 'contact') active @endif">
                <a href="{{route('contact')}}">
                    <i class="fas fa-phone"></i>
                    <span>Contact</span>
                </a>
            </li>

            <li class="@if(Route::currentRouteName() == 'search_products') active @endif">
                <a href="{{route('search_products')}}" class="search-box">
                    <i class="fas fa-search"></i>
                    <span>Search</span>
                </a>
            </li>

            <li class="@if(Route::currentRouteName() == 'wishlist') active @endif">
                <a href="{{route('wishlist')}}" class="notifi-wishlist">
                    <i class="fas fa-heart"></i>
                    <span>My Wish</span>
                </a>
            </li>

            <li class="@if(Route::currentRouteName() == 'cart') active @endif">
                <a href="{{route('cart')}}">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Cart</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- mobile fix menu end -->

    <style>
    .mobile-menu ul li a{color:white;}
</style>