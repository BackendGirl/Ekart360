<style>
.fa-heart{
    font-size: 20px;
}  
.wishlistCol{
    width: 100%;
    display: flex;
    justify-content: flex-end;
    padding: 20px 0;
} 

.single-line-title {
    white-space: nowrap;
}
</style>

@if(count($milk_and_dairies)>0)
<!-- latest jquery-->
<script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>
<section>
    <div class="container-fluid-lg">
        <div class="title">
            <h2>BREAKFAST & DAIRY</h2>
            <span class="title-leaf">
                <svg class="icon-width">
                    <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                </svg>
            </span>
            <p>A virtual assistant collects the products from your list</p>
        </div>
        <div class="product-border border-row">
            <div class="slider-6_2 no-arrow">

                @php $milk_and_dairies_key = floor(count($milk_and_dairies)/6); $milk_and_dairies_key2 =
                0;$milk_and_dairies_key3 = 0; @endphp
                @for($i = 0; $i < floor(count($milk_and_dairies)/2); $i++) @php
                    $milk_and_dairies_key2=$milk_and_dairies_key3 + 1; @endphp <div>
                    <div class="row m-0">
                        @for($j = 0; $j <= ($milk_and_dairies_key - 1); $j++) @if($i==0) @php
                            $milk_and_dairies_key3=$i + $j; @endphp @else @php
                            $milk_and_dairies_key3=$milk_and_dairies_key2 + $j; @endphp @endif @php
                            $product_price=DB::table('product_price')->
                            where('product_id',$milk_and_dairies[$milk_and_dairies_key3]->id)->first(); @endphp
                            <div class="col-12 px-0">
                                <div class="product-box wow fadeIn" data-wow-delay="0.1s">
                                <li  data-bs-placement="top" title="Wishlist" class="wishlistCol">
                                            <a class="notifi-wishlist wishlist{{$milk_and_dairies[ $milk_and_dairies_key3]->id}} myWishlistId{{$product->id ?? ''}}" style="cursor:pointer;">
                                                    <i class="fa-regular fa-heart wishlistIconPop{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}"></i>
                                                        <!-- <i class="fa-solid fa-heart clickedHeart wishlistIcon{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}"></i> -->
                                                    </a>
                                                    <form action="{{route('add-to-cart')}}" method="post" id="wishlist{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}">
                                                                    @csrf
                                                        <input class="hidden_slug{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}" type="hidden" name="slug" value="{{$milk_and_dairies[ $milk_and_dairies_key3]->slug ?? ''}}">
                                                        <input class="hidden_weight{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}" type="hidden" name="weight" value="{{$product_price->quantity ?? ''}}">
                                                        <input class="hidden_price{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}" type="hidden" name="price" value="{{$product_prices->price ?? ''}}">
                                                        <input class="hidden_mrp{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}" type="hidden" name="mrp" value="{{$product_prices->mrp ?? ''}}">
                                                        <input class="hidden_quant{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}" type="hidden" name="quant" value="1">
                                                        <input class="hidden_wishlist_btn{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}" type="hidden" name="wishlist_btn" value="wishlist_btn">
                                                    </form>
                                                </li>

                                                <script>

                                                     

                                                   
                                                    $(document).ready(function() {  
                                                                $(".wishlist{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}").click(function(){ 
                                                                    const slug = $('.hidden_slug{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}').val();
                                                                    const weight = $('.hidden_weight{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}').val();
                                                                    const price = $('.hidden_price{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}').val();
                                                                    const mrp = $('.hidden_mrp{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}').val();
                                                                    const quant = $('.hidden_quant{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}').val();
                                                                    const wishlist_btn = $('.hidden_wishlist_btn{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}').val();

                                                                    const myWishListIcon = $(".wishlistIconPop{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}");

                                                                                        
                                                                                        myWishListIcon.removeClass("fa-regular");
                                                                                        myWishListIcon.addClass("fa-solid");

                                                                                        myWishListIcon.css("color", "red");
                                                                                       
                                                                    

                                                                    $.ajax({
                                                                            type:"GET",
                                                                                url: "{{route('add-to-cart')}}",
                                                                                data: {slug: slug,
                                                                                    weight: weight,
                                                                                    price: price,
                                                                                    mrp: mrp,
                                                                                    quant: quant,
                                                                                    wishlist_btn: wishlist_btn
                                                                                },      
                                                                                success: function(data){
                                                                                   
                                                                                    if (data == 200) {

                                                                                        Swal.fire({
                                                                                        icon: 'success',
                                                                                        title: 'Product added to your wishlist!',
                                                                                        showConfirmButton: true,
                                                                                        timer: 60000, // 60 seconds (in milliseconds)
                                                                                    }); 
                                                                                       
                                                                                        
                                                                                    }
                                                                                }
                                                                            });  
                                                                    // }
                                                                });   
                                                            } )
                                                   
                                                </script>
                                    <div class="product-image">
                                        <a
                                            href="{{route('products_detail',$milk_and_dairies[$milk_and_dairies_key3]->slug)}}">
                                            <img src="{{URL::to($milk_and_dairies[$milk_and_dairies_key3]->photo)}}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>
                                        <!-- <ul class="product-option justify-content-around">
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>

                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                            <a href="{{route('compare',$milk_and_dairies[ $milk_and_dairies_key3]->slug)}}">
                                                <i data-feather="refresh-cw"></i>
                                            </a>
                                        </li>

                                        @if(!empty($product_price->quantity) && !empty($product_price->price))
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                            <a class="notifi-wishlist wishlist{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}" style="cursor:pointer;">
                                                <i data-feather="heart"></i>
                                            </a>
                                            <form action="{{route('add-to-cart')}}" method="post" id="wishlist{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}">
                                                            @csrf
                                                <input type="hidden" name="slug" value="{{$milk_and_dairies[ $milk_and_dairies_key3]->slug ?? ''}}">
                                                <input type="hidden" name="weight" value="{{$product_price->quantity ?? ''}}">
                                                <input type="hidden" name="price" value="{{$product_price->price ?? ''}}">
                                                <input type="hidden" name="mrp" value="{{$product_price->mrp ?? ''}}">
                                                <input type="hidden" name="quant" value="1">
                                                <input type="hidden" name="wishlist_btn" value="wishlist_btn">
                                            </form>
                                        </li>

                                        <script>
                                            $(document).ready(function(){ 
                                                $(".wishlist{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}").click(function() {
                                                    $('#wishlist{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}').submit();
                                                });
                                            })
                                        </script>
                                        @endif
                                        </ul> -->
                                    </div>
                                    <div class="product-detail">
                                        <a href="product-left-thumbnail.html">
                                            <h6 class="name name-2 h-100 single-line-title">
                                                {{$milk_and_dairies[$milk_and_dairies_key3]->title ?? ''}}</h6>
                                        </a>

                                        <div class="product-rating mt-2">
                                            <ul class="rating">
                                            @for($k = 1; $k <= 5; $k++)
                                            <li>
                                                <i data-feather="star"
                                                    @if($k <= $milk_and_dairies[$milk_and_dairies_key3]->rating) class="fill" @endif></i>
                                            </li>
                                            @endfor
                                            </ul>
                                            <span>(34)</span>
                                        </div>

                                        <h6 class="sold weight text-content fw-normal">
                                            {{ $product_price->weight ?? '' }}</h6>

                                        <div class="counter-box">
                                            <h6 class="sold theme-color">{!! $settings->currency_symbol ?? '' !!}
                                                {{ $product_price->price ?? '' }}</h6>

                                        </div>
                                        <div style="float:right">
                                            <li title="Cart">
                                                    <a class="notifi-wishlist cart{{$milk_and_dairies[ $milk_and_dairies_key3]->id}} myCartId{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}" style="cursor:pointer;">
                                                        <i data-feather="shopping-cart" style="color:grey"></i>
                                                    </a>
                                                    <form action="{{route('add-to-cart')}}" method="post" id="cart{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}">
                                                                    @csrf
                                                        <input class="hidden_slug{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}" type="hidden" name="slug" value="$milk_and_dairies[$milk_and_dairies_key3]->slug)">
                                                        <input class="hidden_weight{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}" type="hidden" name="weight" value="{{$product_price->quantity ?? ''}}">
                                                        <input class="hidden_price{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}" type="hidden" name="price" value="{$product_price->price  ?? ''}}">
                                                        <input class="hidden_mrp{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}" type="hidden" name="mrp" value="{{$product_price->mrp ?? ''}}">
                                                        <input class="hidden_quant{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}" type="hidden" name="quant" value="1">
                                                        <input class="hidden_cart_btn{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}" type="hidden" name="cart_btn" value="cart_btn">
                                                    </form>
                                                </li>


                                                      <script>

                                                            $(document).ready(function() {  
                                                                $(".cart{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}").click(function(){ 
                                                                    const slug = $('.hidden_slug{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}').val();
                                                                    const weight = $('.hidden_weight{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}').val();
                                                                    const price = $('.hidden_price{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}').val();
                                                                    const mrp = $('.hidden_mrp{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}').val();
                                                                    const quant = $('.hidden_quant{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}').val();
                                                                    const cart_btn = $('.hidden_cart_btn{{$milk_and_dairies[ $milk_and_dairies_key3]->id}}').val();

                                                                    
                                                                    
                                                                    // if (review_title != '' && review_message != '' && rating != '') {
                                                                        $.ajax({
                                                                            type:"GET",
                                                                                url: "{{route('add-to-cart')}}",
                                                                                data: {slug: slug,
                                                                                    weight: weight,
                                                                                    price: price,
                                                                                    mrp: mrp,
                                                                                    quant: quant,
                                                                                    cart_btn: cart_btn
                                                                                },      
                                                                                success: function(data){
                                                                                    // console.log(data);
                                                                                    if (data == 200) {

                                                                                        const cartOpt = document.querySelector(".myCartId{{$product->id ?? ''}}");
                                                                                   
                                                                                        cartOpt.style.background = "#000";
                                                                                    }
                                                                                }
                                                                            });  
                                                                    // }
                                                                });    
                                                            })
                                                        </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                    </div>
            </div>
            @endfor
        </div>
    </div>
    </div>
</section>
@endif

@if(count($milk_and_dairies) > 0)
@php $milk_and_dairies_key = floor(count($milk_and_dairies)/6); $milk_and_dairies_key2 = 0;$milk_and_dairies_key3 = 0; @endphp
@for($i = 0; $i < floor(count($milk_and_dairies)/2); $i++) @php $milk_and_dairies_key2=$milk_and_dairies_key3 + 1; @endphp @for($j=0; $j
    <=($milk_and_dairies_key - 1); $j++) @if($i==0) @php $milk_and_dairies_key3=$i + $j; @endphp @else @php $milk_and_dairies_key3=$milk_and_dairies_key2 +
    $j; @endphp @endif @php $product_price=DB::table('product_price')->
    where('product_id',$milk_and_dairies[$milk_and_dairies_key3]->id)->first(); @endphp
    @php $product_weights=DB::table('product_price')->where('product_id',$milk_and_dairies[$milk_and_dairies_key3]->id)->get();
    @endphp
    <!-- Quick View Modal Box Start -->
    <div class="modal fade theme-modal view-modal" id="view{{$milk_and_dairies[$milk_and_dairies_key3]->id}}" tabindex="-1"
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
                            <div class="slider-image">
                                <img src="{{URL::to($milk_and_dairies[$milk_and_dairies_key3]->photo)}}"
                                    class="img-fluid blur-up lazyload" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-sidebar-modal">
                                <h4 class="title-name">{{$milk_and_dairies[$milk_and_dairies_key3]->title}}</h4>
                                <h4 class="price">{!! $settings->currency_symbol ?? '' !!} <span
                                        class="daily_milk_and_dairies_title2{{$milk_and_dairies[$milk_and_dairies_key3]->id}}">{{ $product_price->price ?? '' }}</span>
                                </h4>
                                <div class="product-rating">
                                    <ul class="rating">
                                        @for($rat = 1; $rat <= $milk_and_dairies[$milk_and_dairies_key3]->rating; $rat++)
                                            <li><i data-feather="star" class="fill"></i></li>
                                            @endfor
                                    </ul>
                                </div>

                                <div class="product-detail">
                                    <h4>Product Details :</h4>
                                    <p>{!! str_limit(strip_tags($milk_and_dairies[$milk_and_dairies_key3]->description), 160, '
                                        ...') !!}</p>
                                </div>

                                <ul class="brand-list">
                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Code:</h5>
                                            <h6>{{$milk_and_dairies[$milk_and_dairies_key3]->slug ?? ''}}</h6>
                                        </div>
                                    </li>
                                </ul>

                                <div class="select-size">
                                    <h4>Product Weight:</h4>
                                    <select
                                        class="form-select select-form-size daily_milk_and_dairies_weight{{$milk_and_dairies[$milk_and_dairies_key3]->id}}">
                                        @if(count($product_weights)>0)
                                        @foreach($product_weights as $product_weight)
                                        <option value="{{$product_weight->quantity}}" @if($product_price->id == $product_weight->id) selected @endif data-daily_milk_and_dairies_price="{{$product_weight->price}}" data-daily_milk_and_dairies_mrp="{{$product_weight->mrp}}">{{$product_weight->quantity}}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="modal-button">
                                    <form action="{{route('add-to-cart')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="slug" value="{{$milk_and_dairies[$milk_and_dairies_key3]->slug}}"
                                            class="product_slug">
                                        <input type="hidden" name="weight"
                                            class="daily_milk_and_dairies_product_weight{{$milk_and_dairies[$milk_and_dairies_key3]->id}}"
                                            value="{{$product_price->quantity ?? ''}}">
                                        <input type="hidden" name="price"
                                            class="daily_milk_and_dairies_product_price{{$milk_and_dairies[$milk_and_dairies_key3]->id}}"
                                            value="{{$product_price->price ?? ''}}">
                                        <input type="hidden" name="mrp"
                                            class="daily_milk_and_dairies_product_mrp{{$milk_and_dairies[$milk_and_dairies_key3]->id}}"
                                            value="{{$product_price->mrp ?? ''}}">
                                        <input type="hidden" name="quant" value="1">
                                        @if(count($product_weights)>0)
                                        <div class="note-box product-packege">
                                            <button name="cart_btn" value="cart_btn" type="submit"
                                                class="btn btn-md add-cart-button icon">Add To Cart</button>
                                        </div>
                                        @endif
                                    </form>

                                    <a href="{{route('products_detail',$milk_and_dairies[$milk_and_dairies_key3]->slug)}}">
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
        $(".daily_milk_and_dairies_weight{{$milk_and_dairies[$milk_and_dairies_key3]->id}}").change(function() { 
            var daily_milk_and_dairies_weight = $('option:selected', this).val();
            var daily_milk_and_dairies_price = $('option:selected', this).attr("data-daily_milk_and_dairies_price");
            var daily_milk_and_dairies_mrp = $('option:selected', this).attr("data-daily_milk_and_dairies_mrp");
            $('.daily_milk_and_dairies_title2{{$milk_and_dairies[$milk_and_dairies_key3]->id}}').text(daily_milk_and_dairies_price);
            $('.daily_milk_and_dairies_product_weight{{$milk_and_dairies[$milk_and_dairies_key3]->id}}').val(
                daily_milk_and_dairies_weight);
            $('.daily_milk_and_dairies_product_price{{$milk_and_dairies[$milk_and_dairies_key3]->id}}').val(
                daily_milk_and_dairies_price);
            $('.daily_milk_and_dairies_product_mrp{{$milk_and_dairies[$milk_and_dairies_key3]->id}}').val(daily_milk_and_dairies_mrp);

        });
    })
    </script>
    @endfor
    @endfor

    @endif