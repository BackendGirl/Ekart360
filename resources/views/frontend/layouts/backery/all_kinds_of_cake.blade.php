
@if(count($cakes) > 0)
<div class="title section-t-space">
    <h2>ALL KINDS OF CAKES</h2>
    <span class="title-leaf">
        <svg class="icon-width">
            <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#cake"></use>
        </svg>
    </span>
</div>

<div class="slider-3_2 product-wrapper">

@php $cake_key = floor(count($cakes)/6); $cake_key2 = 0;$cake_key3 = 0; @endphp
@for($i = 0; $i < count($cakes)/4; $i++)
@php $cake_key2 = $cake_key3 + 1; @endphp
    <div>
      @for($j = 0; $j <= $cake_key; $j++)
      @if($i == 0)
        @php $cake_key3 = $i + $j; @endphp
      @else
        @php $cake_key3 = $cake_key2 + $j; @endphp
      @endif

      @php $product_price = DB::table('product_price')->where('product_id',$cakes[$cake_key3]->id)->first(); @endphp
     
        <div class="product-box-2 wow fadeIn">
            <a href="{{route('products_detail',$cakes[$cake_key3]->slug)}}" class="product-image">
                <img src="{{URL::to($cakes[$cake_key3]->photo)}}" class="img-fluid blur-up lazyload" alt="">
            </a>

            <div class="product-detail">
                <a href="{{route('products_detail',$cakes[$cake_key3]->slug)}}">
                    <h6>{{$cakes[$cake_key3]->title}}</h6>
                </a>
                <ul class="rating">
                @for($k = 1; $k <= 5; $k++)
                    <li>
                        <i data-feather="star"
                            @if($k <= $cakes[$cake_key3]->rating) class="fill" @endif></i>
                    </li>
                @endfor
                </ul>               
                @if($product_price)<h5> {!! $settings->currency_symbol ?? '' !!} {{ $product_price->price ?? '' }} <del> {!! $settings->currency_symbol ?? '' !!} {{ $product_price->mrp ?? '' }}</del></h5>@endif
            </div>
        </div>
       @endfor
    </div>
@endfor

</div>
@endif