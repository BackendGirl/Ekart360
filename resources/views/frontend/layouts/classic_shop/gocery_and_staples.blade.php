@if(count($grocery)>0)
<section class="product-section-4">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Grocery & Staples</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="slider-7_1 arrow-slider img-slider">
                        @foreach($grocery as $drink)
                        @php $product_price = DB::table('product_price')->where('product_id',$drink->id)->first(); @endphp
                        <div>
                            <div class="product-box-4 wow fadeInUp">
                                <div class="product-image product-image-2">
                                    <a href="{{route('products_detail',$drink->slug)}}">
                                        <img src="{{URL::to($drink->photo)}}"
                                            class="img-fluid blur-up lazyload" alt="">
                                    </a>

                                    <ul class="option">
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view{{$drink->id}}">
                                            <i data-feather="eye"></i>
                                            </a>
                                        </li>
                                        @if(!empty($product_price->quantity) && !empty($product_price->price))
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                <a class="notifi-wishlist wishlist{{$drink->id}}" style="cursor:pointer;">
                                                    <i data-feather="heart"></i>
                                                </a>
                                                <form action="{{route('add-to-cart')}}" method="post" id="wishlist{{$drink->id}}">
                                                                @csrf
                                                    <input type="hidden" name="slug" value="{{$drink->slug ?? ''}}">
                                                    <input type="hidden" name="weight" value="{{$product_price->quantity ?? ''}}">
                                                    <input type="hidden" name="price" value="{{$product_price->price ?? ''}}">
                                                    <input type="hidden" name="mrp" value="{{$product_price->mrp ?? ''}}">
                                                    <input type="hidden" name="quant" value="1">
                                                    <input type="hidden" name="wishlist_btn" value="wishlist_btn">
                                                </form>
                                            </li>

                                            <script>
                                                $(document).ready(function(){ 
                                                    $(".wishlist{{$drink->id}}").click(function() {
                                                        $('#wishlist{{$drink->id}}').submit();
                                                    });
                                                })
                                            </script>
                                            @endif
                                            @if(!empty($product_price->quantity) && !empty($product_price->price))
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="cart">
                                                <a class="notifi-wishlist cart{{$drink->id}}" style="cursor:pointer;">
                                                    <i data-feather="shopping-bag"></i>
                                                </a>
                                                <form action="{{route('add-to-cart')}}" method="post" id="cart{{$drink->id}}">
                                                                @csrf
                                                    <input type="hidden" name="slug" value="{{$drink->slug ?? ''}}">
                                                    <input type="hidden" name="weight" value="{{$product_price->quantity ?? ''}}">
                                                    <input type="hidden" name="price" value="{{$product_price->price ?? ''}}">
                                                    <input type="hidden" name="mrp" value="{{$product_price->mrp ?? ''}}">
                                                    <input type="hidden" name="quant" value="1">
                                                    <input type="hidden" name="cart_btn" value="cart_btn">
                                                </form>
                                            </li>

                                            <script>
                                                $(document).ready(function(){ 
                                                    $(".cart{{$drink->id}}").click(function() {
                                                        $('#cart{{$drink->id}}').submit();
                                                    });
                                                })
                                            </script>
                                            @endif
                                    </ul>
                                </div>

                                <div class="product-detail">
                                    <ul class="rating">
                                    @for($k = 1; $k <= 5; $k++)
                                            <li>
                                                <i data-feather="star"
                                                    @if($k <= $drink->rating) class="fill" @endif></i>
                                            </li>
                                        @endfor
                                    </ul>
                                    <a href="{{route('products_detail',$drink->slug)}}">
                                        <h5 class="name text-title">{{$drink->title ?? ''}}</h5>
                                    </a>
                                    <h5 class="price theme-color">{!! $settings->currency_symbol ?? '' !!} {{ $product_price->price ?? '' }}<del>{!! $settings->currency_symbol ?? '' !!} {{ $product_price->mrp ?? '' }}</del></h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    @foreach($grocery as $drink)
       @php $product_price = DB::table('product_price')->where('product_id',$drink->id)->first(); @endphp
       @php $product_weights = DB::table('product_price')->where('product_id',$drink->id)->get(); @endphp
      <!-- Quick View Modal Box Start -->
      <div class="modal fade theme-modal view-modal" id="view{{$drink->id}}" tabindex="-1"
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
                                <img src="{{URL::to($drink->photo)}}"
                                    class="img-fluid blur-up lazyload" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-sidebar-modal">
                                <h4 class="title-name">{{$drink->title}}</h4>
                                <h4 class="price">{!! $settings->currency_symbol ?? '' !!} <span
                                        class="top_save_products_title2{{$drink->id}}">{{ $product_price->price ?? '' }}</span>
                                </h4>
                                <div class="product-rating">
                                    <ul class="rating">
                                        @for($k = 1; $k <= 5; $k++) <li>
                                        <i data-feather="star" @if($k <= $drink->rating) class="fill"
                                            @endif></i>
                                        </li>
                                        @endfor
                                    </ul>
                                </div>

                                <div class="product-detail">
                                    <h4>Product Details :</h4>
                                    <p>{!! str_limit(strip_tags($drink->description), 160, '
                                        ...') !!}</p>
                                </div>

                                <ul class="brand-list">
                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Code:</h5>
                                            <h6>{{$drink->slug ?? ''}}</h6>
                                        </div>
                                    </li>
                                </ul>

                                <div class="select-size">
                                    <h4>Product Weight:</h4>
                                    <select
                                        class="form-select select-form-size top_save_products_weight{{$drink->id}}">
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
                                            value="{{$drink->slug}}" class="product_slug">
                                        <input type="hidden" name="weight"
                                            class="top_save_products_product_weight{{$drink->id}}"
                                            value="{{$product_price->quantity ?? ''}}">
                                        <input type="hidden" name="price"
                                            class="top_save_products_product_price{{$drink->id}}"
                                            value="{{$product_price->price ?? ''}}">
                                        <input type="hidden" name="mrp"
                                            class="top_save_products_product_mrp{{$drink->id}}"
                                            value="{{$product_price->mrp ?? ''}}">
                                        <input type="hidden" name="quant" value="1">
                                        @if(count($product_weights)>0)
                                        <div class="note-box product-packege">
                                            <button name="cart_btn" value="cart_btn" type="submit"
                                                class="btn btn-md add-cart-button icon">Add To Cart</button>
                                        </div>
                                        @endif
                                    </form>

                                    <a href="{{route('products_detail',$drink->slug)}}">
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
        $(".top_save_products_weight{{$drink->id}}").change(function() {
            var top_save_products_weight = $('option:selected', this).val();
            var top_save_products_price = $('option:selected', this).attr(
                "data-top_save_products_price");
            var top_save_products_mrp = $('option:selected', this).attr("data-top_save_products_mrp");
            $('.top_save_products_title2{{$drink->id}}').text(
                top_save_products_price);
            $('.top_save_products_product_weight{{$drink->id}}').val(
                top_save_products_weight);
            $('.top_save_products_product_price{{$drink->id}}').val(
                top_save_products_price);
            $('.top_save_products_product_mrp{{$drink->id}}').val(
                top_save_products_mrp);

        });
    })
    </script>
    @endforeach
    @endif