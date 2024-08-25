<!-- latest jquery-->
<script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>

<section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-9 col-xl-8">
                    @if(count($top_save_today)>0)
                    <div class="title title-flex">
                        <div>
                            <h2>Top Save Today</h2>
                            <span class="title-leaf">
                                <svg class="icon-width">
                                    <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="section-b-space">
                        <div class="row row-cols-xxl-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-sm-4 g-3 no-arrow">
                            @foreach($top_save_today as $top_save)
                                @php $product_price=DB::table('product_price')->where('product_id',$top_save->id)->first(); @endphp
                                @php $product_weights=DB::table('product_price')->where('product_id',$top_save->id)->get(); @endphp
                            <div>
                                <div class="product-box product-white-bg wow fadeIn">
                                    <div class="product-image">
                                        <a href="{{route('products_detail',$top_save->slug)}}">
                                            <img src="{{URL::to($top_save->photo)}}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>
                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view{{$top_save->id}}">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>

                                            @if(!empty($product_price->quantity) && !empty($product_price->price))
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Cart">
                                                <a class="notifi-wishlist cart{{$top_save->id}}" style="cursor:pointer;">
                                                    <i data-feather="shopping-bag"></i>
                                                </a>
                                                <form action="{{route('add-to-cart')}}" method="post" id="cart{{$top_save->id}}">
                                                                @csrf
                                                    <input type="hidden" name="slug" value="{{$top_save->slug ?? ''}}">
                                                    <input type="hidden" name="weight" value="{{$product_price->quantity ?? ''}}">
                                                    <input type="hidden" name="price" value="{{$product_price->price ?? ''}}">
                                                    <input type="hidden" name="mrp" value="{{$product_price->mrp ?? ''}}">
                                                    <input type="hidden" name="quant" value="1">
                                                    <input type="hidden" name="cart_btn" value="cart_btn">
                                                </form>
                                            </li>

                                            <script>
                                                $(document).ready(function(){ 
                                                    $(".cart{{$top_save->id}}").click(function() {
                                                        $('#cart{{$top_save->id}}').submit();
                                                    });
                                                })
                                            </script>
                                            @endif

                                            @if(!empty($product_price->quantity) && !empty($product_price->price))
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                <a class="notifi-wishlist wishlist{{$top_save->id}}" style="cursor:pointer;">
                                                    <i data-feather="heart"></i>
                                                </a>
                                                <form action="{{route('add-to-cart')}}" method="post" id="wishlist{{$top_save->id}}">
                                                                @csrf
                                                    <input type="hidden" name="slug" value="{{$top_save->slug ?? ''}}">
                                                    <input type="hidden" name="weight" value="{{$product_price->quantity ?? ''}}">
                                                    <input type="hidden" name="price" value="{{$product_price->price ?? ''}}">
                                                    <input type="hidden" name="mrp" value="{{$product_price->mrp ?? ''}}">
                                                    <input type="hidden" name="quant" value="1">
                                                    <input type="hidden" name="wishlist_btn" value="wishlist_btn">
                                                </form>
                                            </li>

                                            <script>
                                                $(document).ready(function(){ 
                                                    $(".wishlist{{$top_save->id}}").click(function() {
                                                        $('#wishlist{{$top_save->id}}').submit();
                                                    });
                                                })
                                            </script>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="product-detail position-relative">
                                        <a href="{{route('products_detail',$top_save->slug)}}">
                                            <h6 class="name">{{$top_save->title ?? ''}}
                                            </h6>
                                        </a>

                                        <h6 class="sold weight text-content fw-normal">{{ $product_price->weight ?? '' }}</h6>

                                        <h6 class="price theme-color">{!! $settings->currency_symbol ?? '' !!} {{ $product_price->price ?? '' }}</h6>

                                    </div>
                                </div>
                            </div>
                            <!-- Quick View Modal Box Start -->
                                <div class="modal fade theme-modal view-modal" id="view{{$top_save->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                                        <div class="modal-content">
                                            <div class="modal-header p-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-sm-4 g-2">
                                                    <div class="col-lg-6">
                                                        <div class="slider-image text-center">
                                                            <img src="{{URL::to($top_save->photo)}}" class="img-fluid blur-up lazyload"
                                                                alt="">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="right-sidebar-modal">
                                                            <h4 class="title-name">{{$top_save->title}}</h4>
                                                            <h4 class="price">{!! $settings->currency_symbol ?? '' !!} <span class="daily_staples_title2{{$top_save->id}}">{{ $product_price->price ?? '' }}</span></h4>
                                                            <div class="product-rating">
                                                                <ul class="rating">
                                                                @for($k = 1; $k <= 5; $k++)
                                                                    <li>
                                                                        <i data-feather="star"
                                                                            @if($k <= $top_save->rating) class="fill" @endif></i>
                                                                    </li>
                                                                @endfor
                                                                </ul>
                                                            </div>

                                                            <div class="product-detail">
                                                                <h4>Product Details :</h4>
                                                                <p>{!! str_limit(strip_tags($top_save->description), 160, ' ...') !!}</p>
                                                            </div>

                                                            <ul class="brand-list">
                                                                <li>
                                                                    <div class="brand-box">
                                                                        <h5>Product Code:</h5>
                                                                        <h6>{{$top_save->slug ?? ''}}</h6>
                                                                    </div>
                                                                </li>
                                                            </ul>

                                                            <div class="select-size">
                                                                <h4>Product Weight:</h4>
                                                                <select class="form-select select-form-size daily_staples_weight{{$top_save->id}}">
                                                                    @if(count($product_weights)>0)
                                                                    @foreach($product_weights as $product_weight)
                                                                    <option value="{{$product_weight->quantity}}" @if($product_price->id == $product_weight->id) selected @endif data-daily_staples_price="{{$product_weight->price}}" data-daily_staples_mrp="{{$product_weight->mrp}}">{{$product_weight->quantity}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>

                                                            <div class="modal-button">
                                                                    <form action="{{route('add-to-cart')}}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="slug" value="{{$top_save->slug}}" class="product_slug">
                                                                        <input type="hidden" name="weight" class="daily_staples_product_weight{{$top_save->id}}" value="{{$product_price->quantity ?? ''}}">
                                                                        <input type="hidden" name="price" class="daily_staples_product_price{{$top_save->id}}" value="{{$product_price->price ?? ''}}">
                                                                        <input type="hidden" name="mrp" class="daily_staples_product_mrp{{$top_save->id}}" value="{{$product_price->mrp ?? ''}}">
                                                                        <input type="hidden" name="quant" value="1">
                                                                        @if(count($product_weights)>0)
                                                                        <div class="note-box product-packege">                            
                                                                            <button name="cart_btn" value="cart_btn" type="submit" class="btn btn-md add-cart-button icon">Add To Cart</button>
                                                                        </div>
                                                                        @endif
                                                                    </form>

                                                                    <a href="{{route('products_detail',$top_save->slug)}}">
                                                                        <button class="btn theme-bg-color view-button icon text-white fw-bold btn-md">View More Details</button>
                                                                    </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Quick View Modal Box End -->

                                <script>
                                    $(document).ready(function(){ 
                                        $(".daily_staples_weight{{$top_save->id}}").change(function() {
                                            var daily_staples_weight = $('option:selected', this).val(); 
                                            var daily_staples_price = $('option:selected', this).attr("data-daily_staples_price");            
                                            var daily_staples_mrp = $('option:selected', this).attr("data-daily_staples_mrp");                        
                                            $('.daily_staples_title2{{$top_save->id}}').text(daily_staples_price);
                                            $('.daily_staples_product_weight{{$top_save->id}}').val(daily_staples_weight);
                                            $('.daily_staples_product_price{{$top_save->id}}').val(daily_staples_price);
                                            $('.daily_staples_product_mrp{{$top_save->id}}').val(daily_staples_mrp);

                                        });
                                    })
                                </script>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @include('frontend.layouts.furniture.shop_by_category')

                      <!-- Discount Section Start -->
                    @include('frontend.index.offers')  
                    <!-- Discount Section End -->

                    @include('frontend.layouts.furniture.food_cupboards')

                </div>

                <div class="col-xxl-3 col-xl-4 d-none d-xl-block">
                    <div class="p-sticky">
                        @if(count($product_categories2)>0)
                        <div class="category-menu">
                            <h3>Shop By Product</h3>
                            <ul class="border-bottom-0">
                                @foreach($product_categories2 as $product_category)
                                <li>
                                    <div class="category-list">
                                        <img src="{{URL::to($product_category->photo)}}"
                                            class="blur-up lazyload" alt="">
                                        <h5>
                                            <a href="{{route('products',$product_category->id)}}">{{$product_category->title ?? ''}}</a>
                                        </h5>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="section-t-space">
                            <div class="category-menu">
                                <h3>Trending Products</h3>

                                <ul class="product-list border-0 p-0 d-block">
                                    @foreach($trending_products as $trending_product)
                                    @php $product_price=DB::table('product_price')->where('product_id',$trending_product->id)->first(); @endphp
                                    <li>
                                        <div class="offer-product">
                                            <a href="{{route('products_detail',$trending_product->slug)}}" class="offer-image">
                                                <img src="{{URL::to($trending_product->photo)}}" class="blur-up lazyload"
                                                    alt="">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="{{route('products_detail',$trending_product->slug)}}" class="text-title">
                                                        <h6 class="name">{{$trending_product->title ?? ''}}</h6>
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
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>