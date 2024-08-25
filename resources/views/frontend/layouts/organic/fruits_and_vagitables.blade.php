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

@if(count($vagitable_and_fruits)>5)

<!-- Include SweetAlert from a CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- latest jquery-->
<script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>
<section>
    <div class="container-fluid-lg">
        <div class="title">
            <h2>FRUIT & VEGETABLES</h2>
            <span class="title-leaf">
                <svg class="icon-width">
                    <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                </svg>
            </span>
        </div>
        <div class="product-border border-row">
            <div class="slider-6_2 no-arrow">

                @php $vagitable_and_fruits_key = floor(count($vagitable_and_fruits)/6); $vagitable_and_fruits_key2 =
                0;$vagitable_and_fruits_key3 = 0; @endphp
                @for($i = 0; $i < floor(count($vagitable_and_fruits)/2); $i++) @php
                    $vagitable_and_fruits_key2=$vagitable_and_fruits_key3 + 1; @endphp <div>
                    <div class="row m-0">
                        @for($j = 0; $j <= ($vagitable_and_fruits_key - 1); $j++) @if($i==0) @php
                            $vagitable_and_fruits_key3=$i + $j; @endphp @else @php
                            $vagitable_and_fruits_key3=$vagitable_and_fruits_key2 + $j; @endphp @endif @php
                            $product_price=DB::table('product_price')->
                            where('product_id',$vagitable_and_fruits[$vagitable_and_fruits_key3]->id)->first(); @endphp
                            <div class="col-12 px-0">
                                <div class="product-box wow fadeIn" data-wow-delay="0.1s">
                                    <div class="product-image">
                                    <li  data-bs-placement="top" title="Wishlist" class="wishlistCol">
                                            <a class="notifi-wishlist wishlist{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}} myWishlistId{{$product->id ?? ''}}" style="cursor:pointer;">
                                                    <i class="fa-regular fa-heart wishlistIconPop{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}"></i>
                                                        <!-- <i class="fa-solid fa-heart clickedHeart wishlistIcon{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}"></i> -->
                                                    </a>
                                                    <form action="{{route('add-to-cart')}}" method="post" id="wishlist{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}">
                                                                    @csrf
                                                        <input class="hidden_slug{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}" type="hidden" name="slug" value="{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->slug ?? ''}}">
                                                        <input class="hidden_weight{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}" type="hidden" name="weight" value="{{$product_price->quantity ?? ''}}">
                                                        <input class="hidden_price{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}" type="hidden" name="price" value="{{$product_prices->price ?? ''}}">
                                                        <input class="hidden_mrp{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}" type="hidden" name="mrp" value="{{$product_prices->mrp ?? ''}}">
                                                        <input class="hidden_quant{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}" type="hidden" name="quant" value="1">
                                                        <input class="hidden_wishlist_btn{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}" type="hidden" name="wishlist_btn" value="wishlist_btn">
                                                    </form>
                                                </li>

                                                <script>

                                                     

                                                   
                                                    $(document).ready(function() {  
                                                                $(".wishlist{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}").click(function(){ 
                                                                    const slug = $('.hidden_slug{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}').val();
                                                                    const weight = $('.hidden_weight{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}').val();
                                                                    const price = $('.hidden_price{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}').val();
                                                                    const mrp = $('.hidden_mrp{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}').val();
                                                                    const quant = $('.hidden_quant{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}').val();
                                                                    const wishlist_btn = $('.hidden_wishlist_btn{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}').val();

                                                                    
                                                                    const myWishListIcon = $(".wishlistIconPop{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}");

                                                                                                                                                                
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
                                        <a
                                            href="{{route('products_detail',$vagitable_and_fruits[$vagitable_and_fruits_key3]->slug)}}">
                                            <img src="{{URL::to($vagitable_and_fruits[$vagitable_and_fruits_key3]->photo)}}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>
                                        
                                    </div>
                                    <div class="product-detail">
                                        <a href="{{route('products_detail',$vagitable_and_fruits[$vagitable_and_fruits_key3]->slug)}}">
                                            <h6 class="name name-2 h-100 single-line-title">
                                                {{$vagitable_and_fruits[$vagitable_and_fruits_key3]->title ?? ''}}</h6>
                                        </a>

                                        @php $rating = $vagitable_and_fruits[$vagitable_and_fruits_key3]->rating; @endphp

                                        <div class="product-rating mt-2">
                                            <ul class="rating">
                                                @for($k = 1; $k <= 5; $k++)
                                                    <li>
                                                        <i data-feather="star" @if($k <= $rating) class="fill" @endif></i>
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
                                                    <a class="notifi-wishlist cart{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}} myCartId{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}" style="cursor:pointer;">
                                                        <i data-feather="shopping-cart" style="color:grey"></i>
                                                    </a>
                                                    <form action="{{route('add-to-cart')}}" method="post" id="cart{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}">
                                                                    @csrf
                                                        <input class="hidden_slug{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}" type="hidden" name="slug" value="$vagitable_and_fruits[$vagitable_and_fruits_key3]->slug)">
                                                        <input class="hidden_weight{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}" type="hidden" name="weight" value="{{$product_price->quantity ?? ''}}">
                                                        <input class="hidden_price{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}" type="hidden" name="price" value="{$product_price->price  ?? ''}}">
                                                        <input class="hidden_mrp{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}" type="hidden" name="mrp" value="{{$product_price->mrp ?? ''}}">
                                                        <input class="hidden_quant{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}" type="hidden" name="quant" value="1">
                                                        <input class="hidden_cart_btn{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}" type="hidden" name="cart_btn" value="cart_btn">
                                                    </form>
                                                </li>


                                                      <script>

                                               
                                                 

                                                            $(document).ready(function() {  
                                                                $(".cart{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}").click(function(){ 
                                                                    const slug = $('.hidden_slug{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}').val();
                                                                    const weight = $('.hidden_weight{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}').val();
                                                                    const price = $('.hidden_price{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}').val();
                                                                    const mrp = $('.hidden_mrp{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}').val();
                                                                    const quant = $('.hidden_quant{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}').val();
                                                                    const cart_btn = $('.hidden_cart_btn{{$vagitable_and_fruits[ $vagitable_and_fruits_key3]->id}}').val();

                                                                    
                                                                    
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

@if(count($vagitable_and_fruits) > 5)
@php $vagitable_and_fruits_key = floor(count($vagitable_and_fruits)/6); $vagitable_and_fruits_key2 = 0;$vagitable_and_fruits_key3 = 0; @endphp
@for($i = 0; $i < floor(count($vagitable_and_fruits)/2); $i++) @php $vagitable_and_fruits_key2=$vagitable_and_fruits_key3 + 1; @endphp @for($j=0; $j
    <=($vagitable_and_fruits_key - 1); $j++) @if($i==0) @php $vagitable_and_fruits_key3=$i + $j; @endphp @else @php $vagitable_and_fruits_key3=$vagitable_and_fruits_key2 +
    $j; @endphp @endif @php $product_price=DB::table('product_price')->
    where('product_id',$vagitable_and_fruits[$vagitable_and_fruits_key3]->id)->first(); @endphp
    @php $product_weights=DB::table('product_price')->where('product_id',$vagitable_and_fruits[$vagitable_and_fruits_key3]->id)->get();
    @endphp
    <!-- Quick View Modal Box Start -->
    <div class="modal fade theme-modal view-modal" id="view{{$vagitable_and_fruits[$vagitable_and_fruits_key3]->id}}" tabindex="-1"
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
                                <img src="{{URL::to($vagitable_and_fruits[$vagitable_and_fruits_key3]->photo)}}"
                                    class="img-fluid blur-up lazyload" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-sidebar-modal">
                                <h4 class="title-name">{{$vagitable_and_fruits[$vagitable_and_fruits_key3]->title}}</h4>
                                <h4 class="price">{!! $settings->currency_symbol ?? '' !!} <span
                                        class="daily_vagitable_and_fruits_title2{{$vagitable_and_fruits[$vagitable_and_fruits_key3]->id}}">{{ $product_price->price ?? '' }}</span>
                                </h4>
                                <div class="product-rating">
                                    <ul class="rating">
                                    @for($k = 1; $k <= 5; $k++)
                                            <li>
                                                <i data-feather="star"
                                                    @if($k <= $vagitable_and_fruits[$vagitable_and_fruits_key3]->rating) class="fill" @endif></i>
                                            </li>
                                            @endfor
                                    </ul>
                                </div>

                                <div class="product-detail">
                                    <h4>Product Details :</h4>
                                    <p>{!! str_limit(strip_tags($vagitable_and_fruits[$vagitable_and_fruits_key3]->description), 160, '
                                        ...') !!}</p>
                                </div>

                                <ul class="brand-list">
                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Code:</h5>
                                            <h6>{{$vagitable_and_fruits[$vagitable_and_fruits_key3]->slug ?? ''}}</h6>
                                        </div>
                                    </li>
                                </ul>

                                <div class="select-size">
                                    <h4>Product Weight:</h4>
                                    <select
                                        class="form-select select-form-size daily_vagitable_and_fruits_weight{{$vagitable_and_fruits[$vagitable_and_fruits_key3]->id}}">
                                        @if(count($product_weights)>0)
                                        @foreach($product_weights as $product_weight)
                                        <option value="{{$product_weight->quantity}}" @if($product_price->id == $product_weight->id) selected @endif data-daily_vagitable_and_fruits_price="{{$product_weight->price}}" data-daily_vagitable_and_fruits_mrp="{{$product_weight->mrp}}">{{$product_weight->quantity}}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="modal-button">
                                    <form action="{{route('add-to-cart')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="slug" value="{{$vagitable_and_fruits[$vagitable_and_fruits_key3]->slug}}"
                                            class="product_slug">
                                        <input type="hidden" name="weight"
                                            class="daily_vagitable_and_fruits_product_weight{{$vagitable_and_fruits[$vagitable_and_fruits_key3]->id}}"
                                            value="{{$product_price->quantity ?? ''}}">
                                        <input type="hidden" name="price"
                                            class="daily_vagitable_and_fruits_product_price{{$vagitable_and_fruits[$vagitable_and_fruits_key3]->id}}"
                                            value="{{$product_price->price ?? ''}}">
                                        <input type="hidden" name="mrp"
                                            class="daily_vagitable_and_fruits_product_mrp{{$vagitable_and_fruits[$vagitable_and_fruits_key3]->id}}"
                                            value="{{$product_price->mrp ?? ''}}">
                                        <input type="hidden" name="quant" value="1">
                                        @if(count($product_weights)>0)
                                        <div class="note-box product-packege">
                                            <button name="cart_btn" value="cart_btn" type="submit"
                                                class="btn btn-md add-cart-button icon">Add To Cart</button>
                                        </div>
                                        @endif
                                    </form>

                                    <a href="{{route('products_detail',$vagitable_and_fruits[$vagitable_and_fruits_key3]->slug)}}">
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
        $(".daily_vagitable_and_fruits_weight{{$vagitable_and_fruits[$vagitable_and_fruits_key3]->id}}").change(function() { 
            var daily_vagitable_and_fruits_weight = $('option:selected', this).val();
            var daily_vagitable_and_fruits_price = $('option:selected', this).attr("data-daily_vagitable_and_fruits_price");
            var daily_vagitable_and_fruits_mrp = $('option:selected', this).attr("data-daily_vagitable_and_fruits_mrp");
            $('.daily_vagitable_and_fruits_title2{{$vagitable_and_fruits[$vagitable_and_fruits_key3]->id}}').text(daily_vagitable_and_fruits_price);
            $('.daily_vagitable_and_fruits_product_weight{{$vagitable_and_fruits[$vagitable_and_fruits_key3]->id}}').val(
                daily_vagitable_and_fruits_weight);
            $('.daily_vagitable_and_fruits_product_price{{$vagitable_and_fruits[$vagitable_and_fruits_key3]->id}}').val(
                daily_vagitable_and_fruits_price);
            $('.daily_vagitable_and_fruits_product_mrp{{$vagitable_and_fruits[$vagitable_and_fruits_key3]->id}}').val(daily_vagitable_and_fruits_mrp);

        });
    })
    </script>
    @endfor
    @endfor

    @endif