
@if(count($top_save_products2) > 0)

<!-- latest jquery-->
<script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>

<div class="title title-flex">
    <div>
        <h2>Top Save Today</h2>
        <span class="title-leaf">
            <svg class="icon-width">
                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#cake"></use>
            </svg>
        </span>
    </div>
</div>

<div class="product-box-slider-2 no-arrow">

    @php $staples_key = floor(count($top_save_products2)/6); $staples_key2 = 0;$staples_key3 = 0; @endphp
    @for($i = 0; $i < floor(count($top_save_products2)/2); $i++) @php $staples_key2=$staples_key3 + 1; @endphp 
    <div>
        @for($j = 0; $j <= ($staples_key - 1); $j++) @if($i==0) @php $staples_key3=$i + $j; @endphp @else @php
            $staples_key3=$staples_key2 + $j; @endphp @endif @php $product_price=DB::table('product_price')->
            where('product_id',$top_save_products2[$staples_key3]->id)->first(); @endphp

            <div class="product-box product-box-bg wow fadeInUp">
                <div class="product-image">
                    <a href="{{route('products_detail',$top_save_products2[$staples_key3]->slug)}}">
                        <img src="{{URL::to($top_save_products2[$staples_key3]->photo)}}"
                            class="img-fluid blur-up lazyload" alt="">
                    </a>
                    <ul class="product-option">
                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                data-bs-target="#view{{$top_save_products2[$staples_key3]->id}}">
                                <i data-feather="eye"></i>
                            </a>
                        </li>

                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                            <a href="{{route('compare',$top_save_products2[$staples_key3]->slug)}}">
                                <i data-feather="refresh-cw"></i>
                            </a>
                        </li>

                        @if(!empty($product_price->quantity) && !empty($product_price->price))
                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                            <a class="notifi-wishlist wishlist{{$top_save_products2[$staples_key3]->id}}"
                                style="cursor:pointer;">
                                <i data-feather="heart"></i>
                            </a>
                            <form action="{{route('add-to-cart')}}" method="post"
                                id="wishlist{{$top_save_products2[$staples_key3]->id}}">
                                @csrf
                                <input type="hidden" name="slug"
                                    value="{{$top_save_products2[$staples_key3]->slug ?? ''}}">
                                <input type="hidden" name="weight" value="{{$product_price->quantity ?? ''}}">
                                <input type="hidden" name="price" value="{{$product_price->price ?? ''}}">
                                <input type="hidden" name="mrp" value="{{$product_price->mrp ?? ''}}">
                                <input type="hidden" name="quant" value="1">
                                <input type="hidden" name="wishlist_btn" value="wishlist_btn">
                            </form>
                        </li>

                        <script>
                        $(document).ready(function() {
                            $(".wishlist{{$top_save_products2[$staples_key3]->id}}").click(function() {
                                $('#wishlist{{$top_save_products2[$staples_key3]->id}}').submit();
                            });
                        })
                        </script>
                        @endif

                        @if(!empty($product_price->quantity) && !empty($product_price->price))
                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Cart">
                            <a class="notifi-wishlist cart{{$top_save_products2[$staples_key3]->id}}"
                                style="cursor:pointer;">
                                <i data-feather="shopping-bag"></i>
                            </a>
                            <form action="{{route('add-to-cart')}}" method="post"
                                id="cart{{$top_save_products2[$staples_key3]->id}}">
                                @csrf
                                <input type="hidden" name="slug"
                                    value="{{$top_save_products2[$staples_key3]->slug ?? ''}}">
                                <input type="hidden" name="weight" value="{{$product_price->quantity ?? ''}}">
                                <input type="hidden" name="price" value="{{$product_price->price ?? ''}}">
                                <input type="hidden" name="mrp" value="{{$product_price->mrp ?? ''}}">
                                <input type="hidden" name="quant" value="1">
                                <input type="hidden" name="cart_btn" value="cart_btn">
                            </form>
                        </li>

                        <script>
                        $(document).ready(function() {
                            $(".cart{{$top_save_products2[$staples_key3]->id}}").click(function() {
                                $('#cart{{$top_save_products2[$staples_key3]->id}}').submit();
                            });
                        })
                        </script>
                        @endif
                        
                    </ul>
                </div>
                <div class="product-detail">
                    <a href="{{route('products_detail',$top_save_products2[$staples_key3]->slug)}}">
                        <h6 class="name">{{$top_save_products2[$staples_key3]->title}}</h6>
                    </a>

                    <h5 class="sold text-content">
                        <span class="theme-color price">{!! $settings->currency_symbol ?? '' !!}
                            {{ $product_price->price ?? '' }}</span>
                        <del>{!! $settings->currency_symbol ?? '' !!} {{ $product_price->mrp ?? '' }}</del>
                    </h5>

                    <div class="product-rating mt-2">
                        <ul class="rating">
                        @for($k = 1; $k <= 5; $k++)
                            <li>
                                <i data-feather="star"
                                    @if($k <= $top_save_products2[$staples_key3]->rating) class="fill" @endif></i>
                            </li>
                        @endfor
                        </ul>

                        <h6 class="theme-color">In Stock</h6>
                    </div>

                </div>
            </div>

            @endfor

</div>
@endfor

</div>

@php $staples_key = floor(count($top_save_products2)/6); $staples_key2 = 0;$staples_key3 = 0; @endphp
@for($i = 0; $i < floor(count($top_save_products2)/2); $i++) @php $staples_key2=$staples_key3 + 1; @endphp @for($j=0; $j
    <=($staples_key - 1); $j++) @if($i==0) @php $staples_key3=$i + $j; @endphp @else @php $staples_key3=$staples_key2 +
    $j; @endphp @endif @php $product_price=DB::table('product_price')->
    where('product_id',$top_save_products2[$staples_key3]->id)->first(); @endphp
    @php $product_weights=DB::table('product_price')->where('product_id',$top_save_products2[$staples_key3]->id)->get();
    @endphp
    <!-- Quick View Modal Box Start -->
    <div class="modal fade theme-modal view-modal" id="view{{$top_save_products2[$staples_key3]->id}}" tabindex="-1"
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
                                <img src="{{URL::to($top_save_products2[$staples_key3]->photo)}}"
                                    class="img-fluid blur-up lazyload" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-sidebar-modal">
                                <h4 class="title-name">{{$top_save_products2[$staples_key3]->title}}</h4>
                                <h4 class="price">{!! $settings->currency_symbol ?? '' !!} <span
                                        class="top_save_products2_title2{{$top_save_products2[$staples_key3]->id}}">{{ $product_price->price ?? '' }}</span>
                                </h4>
                                <div class="product-rating">
                                    <ul class="rating">
                                        @for($rat = 1; $rat <= $top_save_products2[$staples_key3]->rating; $rat++)
                                            <li><i data-feather="star" class="fill"></i></li>
                                            @endfor
                                    </ul>
                                </div>

                                <div class="product-detail">
                                    <h4>Product Details :</h4>
                                    <p>{!! str_limit(strip_tags($top_save_products2[$staples_key3]->description), 160, '
                                        ...') !!}</p>
                                </div>

                                <ul class="brand-list">
                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Code:</h5>
                                            <h6>{{$top_save_products2[$staples_key3]->slug ?? ''}}</h6>
                                        </div>
                                    </li>
                                </ul>

                                <div class="select-size">
                                    <h4>Product Weight:</h4>
                                    <select
                                        class="form-select select-form-size top_save_products2_weight{{$top_save_products2[$staples_key3]->id}}">
                                        @if(count($product_weights)>0)
                                        @foreach($product_weights as $product_weight)
                                        <option value="{{$product_weight->quantity}}" @if($product_price->id ==
                                            $product_weight->id) selected @endif
                                            data-top_save_products2_price="{{$product_weight->price}}"
                                            data-top_save_products2_mrp="{{$product_weight->mrp}}">{{$product_weight->quantity}}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="modal-button">
                                    <form action="{{route('add-to-cart')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="slug"
                                            value="{{$top_save_products2[$staples_key3]->slug}}" class="product_slug">
                                        <input type="hidden" name="weight"
                                            class="top_save_products2_product_weight{{$top_save_products2[$staples_key3]->id}}"
                                            value="{{$product_price->quantity ?? ''}}">
                                        <input type="hidden" name="price"
                                            class="top_save_products2_product_price{{$top_save_products2[$staples_key3]->id}}"
                                            value="{{$product_price->price ?? ''}}">
                                        <input type="hidden" name="mrp"
                                            class="top_save_products2_product_mrp{{$top_save_products2[$staples_key3]->id}}"
                                            value="{{$product_price->mrp ?? ''}}">
                                        <input type="hidden" name="quant" value="1">
                                        @if(count($product_weights)>0)
                                        <div class="note-box product-packege">
                                            <button name="cart_btn" value="cart_btn" type="submit"
                                                class="btn btn-md add-cart-button icon">Add To Cart</button>
                                        </div>
                                        @endif
                                    </form>

                                    <a href="{{route('products_detail',$top_save_products2[$staples_key3]->slug)}}">
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
        $(".top_save_products2_weight{{$top_save_products2[$staples_key3]->id}}").change(function() {
            var top_save_products2_weight = $('option:selected', this).val();
            var top_save_products2_price = $('option:selected', this).attr(
                "data-top_save_products2_price");
            var top_save_products2_mrp = $('option:selected', this).attr("data-top_save_products2_mrp");
            $('.top_save_products2_title2{{$top_save_products2[$staples_key3]->id}}').text(
                top_save_products2_price);
            $('.top_save_products2_product_weight{{$top_save_products2[$staples_key3]->id}}').val(
                top_save_products2_weight);
            $('.top_save_products2_product_price{{$top_save_products2[$staples_key3]->id}}').val(
                top_save_products2_price);
            $('.top_save_products2_product_mrp{{$top_save_products2[$staples_key3]->id}}').val(
                top_save_products2_mrp);

        });
    })
    </script>
    @endfor
    @endfor

 @endif