@if(count($all_categories)>0)
<div class="header-nav-left">
    <button class="dropdown-category">
        <i data-feather="align-left"></i>
        <span>All Categories</span>
    </button>

    <div class="category-dropdown">
        <div class="category-title">
            <h5>Categories</h5>
            <button type="button" class="btn p-0 close-button text-content">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <ul class="category-list">
            @foreach($all_categories as $all_category)
            @php $all_category_products = DB::table('products')->where('status','active')->where('category',$all_category->id)->orderBy('title')->get(); @endphp                                           
            <li class="onhover-category-list">
                <a href="{{route('products',$all_category->id)}}" class="category-name">
                    <img src="{{URL::to($all_category->photo)}}" alt="">
                    <h6>{{$all_category->title}}</h6>
                    <i class="fa-solid fa-angle-right"></i>
                </a>

                @if(count($all_category_products)>0)
                <div class="onhover-category-box">
                    <div class="list-1">
                        <div class="category-title-box">
                            <h5>{{$all_category->title}}</h5>
                        </div>
                        <ul>
                            @foreach($all_category_products as $all_category_product)
                            <li> <a href="{{route('products_detail',$all_category_product->slug)}}">{{$all_category_product->title}}</a> </li>                          
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </li>
            @endforeach
        </ul>

    </div>

</div>
@endif