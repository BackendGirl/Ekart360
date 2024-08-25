@if(count($product_categories)>0)
<section>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="slider-9">

                    @foreach($product_categories as $product_category)
                        <div>
                            <a href="{{route('products',$product_category->id)}}" class="category-box category-box-2 category-dark"
                                data-wow-delay="0.8s">
                                <div>
                                    <img src="{{URL::to($product_category->photo)}}" class="blur-up lazyload" alt="">
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