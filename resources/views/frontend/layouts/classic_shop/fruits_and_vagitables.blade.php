@if(count($fruits_and_vagitables)>0)
<!-- latest jquery-->
<script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>

<section class="product-section-3">
    <div class="container-fluid-lg">
        <div class="title">
            <h2>Fruits & Vegetables</h2>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="slider-7_1 arrow-slider img-slider">
                    @foreach($fruits_and_vagitables as $fruits_and_vagitable)
                    @php $product_price =
                    DB::table('product_price')->where('product_id',$fruits_and_vagitable->id)->first(); @endphp
                    <div>
                        <div class="product-box-4 wow fadeInUp">
                            <div class="product-image product-image-2">
                                <a href="{{route('products_detail',$fruits_and_vagitable->slug)}}">
                                    <img src="{{URL::to($fruits_and_vagitable->photo)}}"
                                        class="img-fluid blur-up lazyload" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view{{$fruits_and_vagitable->id}}">
                                            <i data-feather="eye"></i>
                                        </a>
                                    </li>

                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="{{route('compare',$fruits_and_vagitable->slug)}}">
                                            <i data-feather="refresh-cw"></i>
                                        </a>
                                    </li>

                                    @if(!empty($product_price->quantity) && !empty($product_price->price))
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                        <a class="notifi-wishlist wishlist{{$fruits_and_vagitable->id}}"
                                            style="cursor:pointer;">
                                            <i data-feather="heart"></i>
                                        </a>
                                        
                                        <form action="{{route('add-to-cart')}}" method="post"
                                            id="wishlist{{$fruits_and_vagitable->id}}">
                                            @csrf
                                            <input type="hidden" name="slug"
                                                value="{{$fruits_and_vagitable->slug ?? ''}}">
                                            <input type="hidden" name="weight"
                                                value="{{$product_price->quantity ?? ''}}">
                                            <input type="hidden" name="price" value="{{$product_price->price ?? ''}}">
                                            <input type="hidden" name="mrp" value="{{$product_price->mrp ?? ''}}">
                                            <input type="hidden" name="quant" value="1">
                                            <input type="hidden" name="wishlist_btn" value="wishlist_btn">
                                        </form>
                                    </li>

                                    <script>
                                    $(document).ready(function() {
                                        $(".wishlist{{$fruits_and_vagitable->id}}").click(function() {
                                            $('#wishlist{{$fruits_and_vagitable->id}}').submit();
                                        });
                                    })
                                    </script>
                                    @endif
                                </ul>
                            </div>

                            <div class="product-detail">
                                <ul class="rating">
                                    @for($k = 1; $k <= 5; $k++) <li>
                                        <i data-feather="star" @if($k <=$fruits_and_vagitable->rating) class="fill"
                                            @endif></i>
                                        </li>
                                        @endfor
                                </ul>
                                <a href="{{route('products_detail',$fruits_and_vagitable->slug)}}">
                                    <h5 class="name text-title">{{$fruits_and_vagitable->title ?? ''}}</h5>
                                </a>
                                <h5 class="price theme-color">{!! $settings->currency_symbol ?? '' !!}
                                    {{ $product_price->price ?? '' }}<del>{!! $settings->currency_symbol ?? '' !!}
                                        {{ $product_price->mrp ?? '' }}</del></h5>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@foreach($fruits_and_vagitables as $fruits_and_vagitable)
@php $product_price = DB::table('product_price')->where('product_id',$fruits_and_vagitable->id)->first(); @endphp
@php $product_weights=DB::table('product_price')->where('product_id',$fruits_and_vagitable->id)->get(); @endphp
<!-- Quick View Modal Box Start -->
<div class="modal fade theme-modal view-modal" id="view{{$fruits_and_vagitable->id}}" tabindex="-1"
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
                            <img src="{{URL::to($fruits_and_vagitable->photo)}}" class="img-fluid blur-up lazyload"
                                alt="">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="right-sidebar-modal">
                            <h4 class="title-name">{{$fruits_and_vagitable->title}}</h4>
                            <h4 class="price">{!! $settings->currency_symbol ?? '' !!} <span
                                    class="daily_milk_and_dairies_title2{{$fruits_and_vagitable->id}}">{{ $product_price->price ?? '' }}</span>
                            </h4>
                            <div class="product-rating">
                                <ul class="rating">
                                @for($k = 1; $k <= 5; $k++) <li>
                                        <i data-feather="star" @if($k <=$fruits_and_vagitable->rating) class="fill"
                                            @endif></i>
                                        </li>
                                        @endfor
                                </ul>
                            </div>

                            <div class="product-detail">
                                <h4>Product Details :</h4>
                                <p>{!! str_limit(strip_tags($fruits_and_vagitable->description), 160, '
                                    ...') !!}</p>
                            </div>

                            <ul class="brand-list">
                                <li>
                                    <div class="brand-box">
                                        <h5>Product Code:</h5>
                                        <h6>{{$fruits_and_vagitable->slug ?? ''}}</h6>
                                    </div>
                                </li>
                            </ul>

                            <div class="select-size">
                                <h4>Product Weight:</h4>
                                <select
                                    class="form-select select-form-size daily_milk_and_dairies_weight{{$fruits_and_vagitable->id}}">
                                    @if(count($product_weights)>0)
                                    @foreach($product_weights as $product_weight)
                                    <option value="{{$product_weight->quantity}}" @if($product_price->id ==
                                        $product_weight->id) selected @endif
                                        data-daily_milk_and_dairies_price="{{$product_weight->price}}"
                                        data-daily_milk_and_dairies_mrp="{{$product_weight->mrp}}">{{$product_weight->quantity}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="modal-button">
                                <form action="{{route('add-to-cart')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="slug" value="{{$fruits_and_vagitable->slug}}"
                                        class="product_slug">
                                    <input type="hidden" name="weight"
                                        class="daily_milk_and_dairies_product_weight{{$fruits_and_vagitable->id}}"
                                        value="{{$product_price->quantity ?? ''}}">
                                    <input type="hidden" name="price"
                                        class="daily_milk_and_dairies_product_price{{$fruits_and_vagitable->id}}"
                                        value="{{$product_price->price ?? ''}}">
                                    <input type="hidden" name="mrp"
                                        class="daily_milk_and_dairies_product_mrp{{$fruits_and_vagitable->id}}"
                                        value="{{$product_price->mrp ?? ''}}">
                                    <input type="hidden" name="quant" value="1">
                                    @if(count($product_weights)>0)
                                    <div class="note-box product-packege">
                                        <button name="cart_btn" value="cart_btn" type="submit"
                                            class="btn btn-md add-cart-button icon">Add To Cart</button>
                                    </div>
                                    @endif
                                </form>

                                <a href="{{route('products_detail',$fruits_and_vagitable->slug)}}">
                                    <button class="btn theme-bg-color view-button icon text-white fw-bold btn-md">View
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
@endforeach
@endif