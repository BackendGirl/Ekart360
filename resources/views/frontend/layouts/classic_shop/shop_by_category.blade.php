@if(count($product_categories)>0)
<section class="category-section-3">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Shop By Categories</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="category-slider-1 arrow-slider wow fadeInUp">
                        @foreach($product_categories as $product_category)
                        <div>
                            <div class="category-box-list">
                                <a href="{{route('products',$product_category->id)}}" class="category-name">
                                    <h4>{{$product_category->title ?? ''}}</h4>
                                    <h6>{{$product_category->products ?? 0}} items</h6>
                                </a>
                                <div class="category-box-view">
                                    <a href="{{route('products',$product_category->id)}}">
                                        <img src="{{URL::to($product_category->photo)}}"
                                            class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                    <button onclick="location.href = '{{route('products',$product_category->id)}}';" class="btn shop-button">
                                        <span>Shop Now</span>
                                        <i class="fas fa-angle-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif