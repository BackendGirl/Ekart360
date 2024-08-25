<section>
        <div class="container-fluid-lg">
            <div class="title d-block">
                <div>
                    <h2>Our best Seller</h2>
                    <span class="title-leaf">
                        <svg class="icon-width">
                            <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                        </svg>
                    </span>
                    <p>A virtual assistant collects the products from your list</p>
                </div>
            </div>
            <div class="banner-slider product-wrapper wow fadeInUp">

            @if(count($best_seller1)>0)
                <div>
                    <ul class="product-list">
                        @foreach($best_seller1 as $bs1)
                        @php $product_price=DB::table('product_price')->where('product_id',$bs1->id)->first(); @endphp
                        <li>
                            <div class="offer-product">
                                <a href="{{route('products_detail',$bs1->slug)}}" class="offer-image">
                                    <img src="{{URL::to($bs1->photo)}}" class="blur-up lazyload" alt="">
                                </a>

                                <div class="offer-detail">
                                    <div>
                                        <a href="{{route('products_detail',$bs1->slug)}}" class="text-title">
                                            <h6 class="name">Gloss Dinnerware Dish</h6>
                                        </a>
                                        <span>{{ $product_price->weight ?? '' }}</span>
                                        <h6 class="price theme-color">{!! $settings->currency_symbol ?? '' !!} {{ $product_price->price ?? '' }}</h6>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(count($best_seller2)>0)
                <div>
                    <ul class="product-list">
                       @foreach($best_seller2 as $bs2)
                       @php $product_price=DB::table('product_price')->where('product_id',$bs2->id)->first(); @endphp
                        <li>
                            <div class="offer-product">
                                <a href="{{route('products_detail',$bs2->slug)}}" class="offer-image">
                                    <img src="{{URL::to($bs2->photo)}}" class="blur-up lazyload" alt="">
                                </a>

                                <div class="offer-detail">
                                    <div>
                                        <a href="{{route('products_detail',$bs2->slug)}}" class="text-title">
                                            <h6 class="name">Gloss Dinnerware Dish</h6>
                                        </a>
                                        <span>{{ $product_price->weight ?? '' }}</span>
                                        <h6 class="price theme-color">{!! $settings->currency_symbol ?? '' !!} {{ $product_price->price ?? '' }}</h6>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach                        
                    </ul>
                </div>
                @endif

                @if(count($best_seller3)>0)
                <div>
                    <ul class="product-list">
                        @foreach($best_seller3 as $bs3)
                        @php $product_price=DB::table('product_price')->where('product_id',$bs3->id)->first(); @endphp
                        <li>
                            <div class="offer-product">
                                <a href="{{route('products_detail',$bs3->slug)}}" class="offer-image">
                                    <img src="{{URL::to($bs3->photo)}}" class="blur-up lazyload" alt="">
                                </a>

                                <div class="offer-detail">
                                    <div>
                                        <a href="{{route('products_detail',$bs3->slug)}}" class="text-title">
                                            <h6 class="name">Gloss Dinnerware Dish</h6>
                                        </a>
                                        <span>{{ $product_price->weight ?? '' }}</span>
                                        <h6 class="price theme-color">{!! $settings->currency_symbol ?? '' !!} {{ $product_price->price ?? '' }}</h6>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach                        
                    </ul>
                </div>
                @endif

                @if(count($best_seller4)>0)
                <div>
                    <ul class="product-list">
                        @foreach($best_seller4 as $bs4)
                        @php $product_price=DB::table('product_price')->where('product_id',$bs4->id)->first(); @endphp
                        <li>
                            <div class="offer-product">
                                <a href="{{route('products_detail',$bs4->slug)}}" class="offer-image">
                                    <img src="{{URL::to($bs4->photo)}}" class="blur-up lazyload" alt="">
                                </a>

                                <div class="offer-detail">
                                    <div>
                                        <a href="{{route('products_detail',$bs4->slug)}}" class="text-title">
                                            <h6 class="name">Gloss Dinnerware Dish</h6>
                                        </a>
                                        <span>{{ $product_price->weight ?? '' }}</span>
                                        <h6 class="price theme-color">{!! $settings->currency_symbol ?? '' !!} {{ $product_price->price ?? '' }}</h6>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

            </div>
        </div>
    </section>