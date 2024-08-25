@if(count($top_salling_items) > 0)
<!-- latest jquery-->
<script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>

<section class="product-section product-section-3">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Top Selling Items</h2>
            </div>
            <div class="row g-sm-4 g-3">
                
                <div class="col-xxl-12 col-lg-12 order-lg-1">
                    <div class="slider-5_2 img-slider">

                @php $stop_salling_item = floor(count($top_salling_items)/6); $stop_salling_item2 = 0;$stop_salling_item3 = 0; @endphp
                @for($i = 0; $i < floor(count($top_salling_items)/2); $i++) 
                    @php $stop_salling_item2=$stop_salling_item3 + 1; @endphp 
                    <div>
                    @for($j = 0; $j <= ($stop_salling_item - 1); $j++) @if($i==0) @php $stop_salling_item3=$i + $j; @endphp @else @php
                        $stop_salling_item3=$stop_salling_item2 + $j; @endphp @endif @php $product_price=DB::table('product_price')->
                        where('product_id',$top_salling_items[$stop_salling_item3]->id)->first(); @endphp
                        
                            <div class="product-box-4 wow fadeInUp">
                                <div class="product-image product-image-2">
                                    <a href="{{route('products_detail',$top_salling_items[$stop_salling_item3]->slug)}}">
                                        <img src="{{URL::to($top_salling_items[$stop_salling_item3]->photo)}}"
                                            class="img-fluid blur-up lazyload" alt="">
                                    </a>

                                    <ul class="option">
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view{{$top_salling_items[$stop_salling_item3]->id}}">
                                            <i data-feather="eye"></i>
                                            </a>
                                        </li>
                                        @if(!empty($product_price->quantity) && !empty($product_price->price))
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                <a class="notifi-wishlist wishlist{{$top_salling_items[$stop_salling_item3]->id}}" style="cursor:pointer;">
                                                    <i data-feather="heart"></i>
                                                </a>
                                                <form action="{{route('add-to-cart')}}" method="post" id="wishlist{{$top_salling_items[$stop_salling_item3]->id}}">
                                                                @csrf
                                                    <input type="hidden" name="slug" value="{{$top_salling_items[$stop_salling_item3]->slug ?? ''}}">
                                                    <input type="hidden" name="weight" value="{{$product_price->quantity ?? ''}}">
                                                    <input type="hidden" name="price" value="{{$product_price->price ?? ''}}">
                                                    <input type="hidden" name="mrp" value="{{$product_price->mrp ?? ''}}">
                                                    <input type="hidden" name="quant" value="1">
                                                    <input type="hidden" name="wishlist_btn" value="wishlist_btn">
                                                </form>
                                            </li>

                                            <script>
                                                $(document).ready(function(){ 
                                                    $(".wishlist{{$top_salling_items[$stop_salling_item3]->id}}").click(function() {
                                                        $('#wishlist{{$top_salling_items[$stop_salling_item3]->id}}').submit();
                                                    });
                                                })
                                            </script>
                                            @endif
                                            @if(!empty($product_price->quantity) && !empty($product_price->price))
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Cart">
                                                <a class="notifi-wishlist cart{{$top_salling_items[$stop_salling_item3]->id}}" style="cursor:pointer;">
                                                    <i data-feather="shopping-bag"></i>
                                                </a>
                                                <form action="{{route('add-to-cart')}}" method="post" id="cart{{$top_salling_items[$stop_salling_item3]->id}}">
                                                                @csrf
                                                    <input type="hidden" name="slug" value="{{$top_salling_items[$stop_salling_item3]->slug ?? ''}}">
                                                    <input type="hidden" name="weight" value="{{$product_price->quantity ?? ''}}">
                                                    <input type="hidden" name="price" value="{{$product_price->price ?? ''}}">
                                                    <input type="hidden" name="mrp" value="{{$product_price->mrp ?? ''}}">
                                                    <input type="hidden" name="quant" value="1">
                                                    <input type="hidden" name="cart_btn" value="cart_btn">
                                                </form>
                                            </li>

                                            <script>
                                                $(document).ready(function(){ 
                                                    $(".cart{{$top_salling_items[$stop_salling_item3]->id}}").click(function() {
                                                        $('#cart{{$top_salling_items[$stop_salling_item3]->id}}').submit();
                                                    });
                                                })
                                            </script>
                                            @endif
                                    </ul>
                                </div>

                                <div class="product-detail">
                                    <ul class="rating">
                                        @for($k = 1; $k <= 5; $k++) <li>
                                        <i data-feather="star" @if($k <= $top_salling_items[$stop_salling_item3]->rating) class="fill"
                                            @endif></i>
                                        </li>
                                        @endfor
                                    </ul>
                                    <a href="{{route('products_detail',$top_salling_items[$stop_salling_item3]->slug)}}">
                                        <h5 class="name text-title">{{$top_salling_items[$stop_salling_item3]->title}}</h5>
                                    </a>
                                    <h5 class="price theme-color">{!! $settings->currency_symbol ?? '' !!}
                                       {{ $product_price->price ?? '' }}
                                       <del>{!! $settings->currency_symbol ?? '' !!}
                                        {{ $product_price->mrp ?? '' }}</del></h5>
                                </div>
                            </div>
                            @endfor

                        </div>
                        @endfor

                    </div>
                </div>
            </div>
        </div>
    </section>

    
@php $stop_salling_item = floor(count($top_salling_items)/6); $stop_salling_item2 = 0;$stop_salling_item3 = 0; @endphp
@for($i = 0; $i < floor(count($top_salling_items)/2); $i++) @php $stop_salling_item2=$stop_salling_item3 + 1; @endphp @for($j=0; $j
    <=($stop_salling_item - 1); $j++) @if($i==0) @php $stop_salling_item3=$i + $j; @endphp @else @php $stop_salling_item3=$stop_salling_item2 +
    $j; @endphp @endif @php $product_price=DB::table('product_price')->
    where('product_id',$top_salling_items[$stop_salling_item3]->id)->first(); @endphp
    @php $product_weights=DB::table('product_price')->where('product_id',$top_salling_items[$stop_salling_item3]->id)->get();
    @endphp
    <!-- Quick View Modal Box Start -->
    <div class="modal fade theme-modal view-modal" id="view{{$top_salling_items[$stop_salling_item3]->id}}" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <img src="{{URL::to($top_salling_items[$stop_salling_item3]->photo)}}"
                                    class="img-fluid blur-up lazyload" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-sidebar-modal">
                                <h4 class="title-name">{{$top_salling_items[$stop_salling_item3]->title}}</h4>
                                <h4 class="price">{!! $settings->currency_symbol ?? '' !!} <span
                                        class="top_save_products_title2{{$top_salling_items[$stop_salling_item3]->id}}">{{ $product_price->price ?? '' }}</span>
                                </h4>
                                <div class="product-rating">
                                    <ul class="rating">
                                        @for($k = 1; $k <= 5; $k++) <li>
                                        <i data-feather="star" @if($k <= $top_salling_items[$stop_salling_item3]->rating) class="fill"
                                            @endif></i>
                                        </li>
                                        @endfor
                                    </ul>
                                </div>

                                <div class="product-detail">
                                    <h4>Product Details :</h4>
                                    <p>{!! str_limit(strip_tags($top_salling_items[$stop_salling_item3]->description), 160, '
                                        ...') !!}</p>
                                </div>

                                <ul class="brand-list">
                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Code:</h5>
                                            <h6>{{$top_salling_items[$stop_salling_item3]->slug ?? ''}}</h6>
                                        </div>
                                    </li>
                                </ul>

                                <div class="select-size">
                                    <h4>Product Weight:</h4>
                                    <select
                                        class="form-select select-form-size top_save_products_weight{{$top_salling_items[$stop_salling_item3]->id}}">
                                        @if(count($product_weights)>0)
                                        @foreach($product_weights as $product_weight)
                                        <option value="{{$product_weight->quantity}}" @if($product_price->id ==
                                            $product_weight->id) selected @endif
                                            data-top_save_products_price="{{$product_weight->price}}"
                                            data-top_save_products_mrp="{{$product_weight->mrp}}">{{$product_weight->quantity}}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="modal-button">
                                    <form action="{{route('add-to-cart')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="slug"
                                            value="{{$top_salling_items[$stop_salling_item3]->slug}}" class="product_slug">
                                        <input type="hidden" name="weight"
                                            class="top_save_products_product_weight{{$top_salling_items[$stop_salling_item3]->id}}"
                                            value="{{$product_price->quantity ?? ''}}">
                                        <input type="hidden" name="price"
                                            class="top_save_products_product_price{{$top_salling_items[$stop_salling_item3]->id}}"
                                            value="{{$product_price->price ?? ''}}">
                                        <input type="hidden" name="mrp"
                                            class="top_save_products_product_mrp{{$top_salling_items[$stop_salling_item3]->id}}"
                                            value="{{$product_price->mrp ?? ''}}">
                                        <input type="hidden" name="quant" value="1">
                                        @if(count($product_weights)>0)
                                        <div class="note-box product-packege">
                                            <button name="cart_btn" value="cart_btn" type="submit"
                                                class="btn btn-md add-cart-button icon">Add To Cart</button>
                                        </div>
                                        @endif
                                    </form>

                                    <a href="{{route('products_detail',$top_salling_items[$stop_salling_item3]->slug)}}">
                                        <button
                                            class="btn theme-bg-color view-button icon text-white fw-bold btn-md">View
                                            More Details</button>
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
    $(document).ready(function() {
        $(".top_save_products_weight{{$top_salling_items[$stop_salling_item3]->id}}").change(function() {
            var top_save_products_weight = $('option:selected', this).val();
            var top_save_products_price = $('option:selected', this).attr(
                "data-top_save_products_price");
            var top_save_products_mrp = $('option:selected', this).attr("data-top_save_products_mrp");
            $('.top_save_products_title2{{$top_salling_items[$stop_salling_item3]->id}}').text(
                top_save_products_price);
            $('.top_save_products_product_weight{{$top_salling_items[$stop_salling_item3]->id}}').val(
                top_save_products_weight);
            $('.top_save_products_product_price{{$top_salling_items[$stop_salling_item3]->id}}').val(
                top_save_products_price);
            $('.top_save_products_product_mrp{{$top_salling_items[$stop_salling_item3]->id}}').val(
                top_save_products_mrp);

        });
    })
    </script>
    @endfor
    @endfor

    @endif