@if(count($product_categories)>0)
    <section>
    <div class="container-fluid-lg">
        <div class="title">
            <h2>Browse by Categories</h2>
            <span class="title-leaf">
                <svg class="icon-width">
                    <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                </svg>
            </span>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="slider-9">
                @foreach($product_categories as $product_category)
                    <div>
                        <a href="{{route('products',$product_category->id)}}" class="category-box wow fadeInUp">
                            <div>
                                <img src="{{URL::to($product_category->photo)}}"
                                    class="blur-up lazyload" alt="">
                                <h5>{{$product_category->title}}</h5>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif