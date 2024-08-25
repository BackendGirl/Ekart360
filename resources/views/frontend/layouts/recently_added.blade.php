@if(count($recently_added_products2)>0)
<div>
    <div class="row">
        <div class="col-12">
            <div class="top-selling-box">
                <div class="top-selling-title">
                    <h3>Recently added</h3>
                </div>

                @foreach($recently_added_products2 as $recently_added_product)
                @php $product_price=DB::table('product_price')->where('product_id',$recently_added_product->id)->first(); @endphp
                <div class="top-selling-contain wow fadeInUp">
                    <a href="{{route('products_detail',$recently_added_product->slug)}}" class="top-selling-image">
                        <img src="{{URL::to($recently_added_product->photo)}}" class="img-fluid blur-up lazyload" alt="">
                    </a>

                    <div class="top-selling-detail">
                        <a href="{{route('products_detail',$recently_added_product->slug)}}">
                            <h5>{{$recently_added_product->title}}</h5>
                        </a>
                        <div class="product-rating">
                            <ul class="rating">
                            @for($i = 1; $i <= 5; $i++)
                            <li>
                                <i data-feather="star"
                                    @if($i <= $recently_added_product->rating) class="fill" @endif></i>
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