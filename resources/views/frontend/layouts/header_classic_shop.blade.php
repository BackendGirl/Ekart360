 <!-- Header Start -->
 <header class="header-3">
        <div class="top-nav sticky-header sticky-header-2">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar-top">
                            <button class="navbar-toggler d-xl-none d-block p-0 me-3" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                                <span class="navbar-toggler-icon">
                                    <i class="fa-solid fa-bars"></i>
                                </span>
                            </button>
                            <a href="{{URL::to('/')}}" class="web-logo nav-logo">
                                <img src="{{ asset('uploads/setting/'.$settings->logo_path) }}" class="img-fluid blur-up lazyload" alt="">
                            </a>

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

                            <div class="middle-box">
                                <div class="center-box">
                                    <div class="location-box-2">
                                        <button class="btn location-button" data-bs-toggle="modal" data-bs-target="#locationModal">
                                            <i class="fa fa-map-marker text-white location_icon"></i>
                                            <span>Track Order</span>
                                        </button>
                                    </div>

                                    <form action="{{route('search_products')}}" method="get">
                                    <div class="searchbar-box-2 input-group d-xl-flex d-none">
                                        <button class="btn search-icon" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Search for products, styles,brands...">
                                        <button class="btn search-button" type="submit">Search</button>
                                    </div>
                                    </form>
                                </div>
                            </div>

                            <div class="rightside-menu support-sidemenu">
                                <div class="support-box">
                                    <div class="support-image">
                                        <img src="{{URL::to('public/frontend/bakery/assets/images/icon/support.png')}}" class="img-fluid blur-up lazyload"
                                            alt="">
                                    </div>
                                    <div class="support-number">
                                        <h2>{{$settings->phone ?? ''}}</h2>
                                        <h4>24/7 Support Center</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12 position-relative">
                    <div class="main-nav nav-left-align">
                        <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky p-0">
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

                        <div class="rightside-menu">
                            <ul class="option-list-2">
                                <li>
                                    <a href="javascript:void(0)" class="header-icon search-box search-icon">                                        
                                        <i class="fa fa-search"></i>
                                    </a>
                                </li>

                                <li class="onhover-dropdown">
                                    <a href="{{route('cart')}}" class="header-icon swap-icon">
                                        <small class="badge-number badge-light">{{App\Helper::cartCount() ?? 0}}</small>
                                        <i class="fa fa-shopping-bag"></i>
                                    </a>

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
                                </li>

                                <li>
                                    <a href="{{route('wishlist')}}" class="header-icon bag-icon">
                                        <small class="badge-number badge-light">{{App\Helper::wishlistCount() ?? 0}}</small>
                                        <i class="fa fa-heart"></i>
                                    </a>
                                </li>
                            </ul>

                            <a href="{{route('user.user_dashboard')}}" class="user-box">
                                <span class="header-icon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <div class="user-name">
                                    <h6 class="text-content">My Account</h6>
                                    @if(Auth()->user()) <h4 class="mt-1">{{Auth()->user()->first_name ?? ''}} {{Auth()->user()->last_name ?? ''}}</h4> @endif                                    
                                </div>
                            </a>

                            <a class="btn mobile-app d-xxl-flex d-none"
                                href="javascript::void(0)" data-bs-toggle="modal" data-bs-target="#deal-box2">
                                <i data-feather="zap"></i>
                                <div class="mobile-name">
                                    <h4>Deal Today</h4>
                                </div>
                            </a>
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

            <li class="mobile-category">
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deal-box2">
                    <i data-feather="zap"></i>
                    <span>Deal</span>
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
            header .navbar-expand-xl .dropdown:hover .dropdown-menu-2 {
                -webkit-transform: unset;
                transform: unset;
            }
    </style>

<style>
    .mobile-menu ul li a{color:white;}
    .fa-bars{-webkit-text-fill-color: white;}
</style>