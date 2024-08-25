@if(count($top_salling_products)>0)
<div>
    <div class="row">
        <div class="col-12">
            <div class="top-selling-box">
                <div class="top-selling-title">
                    <h3>Top Selling</h3>
                </div>

                @foreach($top_salling_products as $top_salling_product)
                @php $product_price=DB::table('product_price')->where('product_id',$top_salling_product->id)->first(); @endphp
                <div class="top-selling-contain wow fadeInUp">
                    <a href="{{route('products_detail',$top_salling_product->slug)}}" class="top-selling-image">
                        <img src="{{URL::to($top_salling_product->photo)}}" class="img-fluid blur-up lazyload" alt="">
                    </a>

                    <div class="top-selling-detail">
                        <a href="{{route('products_detail',$top_salling_product->slug)}}">
                            <h5>{{$top_salling_product->title}}</h5>
                        </a>
                        <div class="product-rating">
                            <ul class="rating">
                            @for($i = 1; $i <= 5; $i++)
                            <li>
                                <i data-feather="star"
                                    @if($i <= $top_salling_product->rating) class="fill" @endif></i>
                            </li>
                            @endfor
                            </ul>
                            <!-- <span>(34)</span> -->
                        </div>
                        <h6>{!! $settings->currency_symbol ?? '' !!} {{ $product_price->price ?? '' }}</h6>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endif