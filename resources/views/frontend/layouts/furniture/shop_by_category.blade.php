@if(count($product_categories)>0)
                    <div class="title">
                        <h2>Bowse by Categories</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                            </svg>
                        </span>
                        <p>Top Categories Of The Week</p>
                    </div>

                    <div class="category-slider-2 product-wrapper no-arrow">
                        @foreach($product_categories as $product_category)
                        <div>
                            <a href="{{route('products',$product_category->id)}}" class="category-box category-dark">
                                <div>
                                    <img src="{{URL::to($product_category->photo)}}" class="blur-up lazyload"
                                        alt="">
                                    <h5>{{$product_category->title ?? ''}}</h5>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @endif