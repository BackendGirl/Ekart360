@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')


<!-- Breadcrumb Section Start -->
@include('frontend.layouts.breadscrumb')
<!-- Breadcrumb Section End -->

    <!-- Blog Details Section Start -->
    <section class="blog-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-3 col-xl-4 col-lg-5 d-lg-block d-none">
                    <div class="left-sidebar-box">
                        <div class="accordion left-accordion-box" id="accordionPanelsStayOpenExample">

                            @if(count($recent_blogs)>0)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">
                                        Recent Post
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body pt-0">
                                        <div class="recent-post-box">
                                            @foreach($recent_blogs as $recent_blog)
                                            <div class="recent-box">
                                                <a href="{{route('blog_detail',$recent_blog->id)}}" class="recent-image">
                                                    <img src="{{URL::to($recent_blog->photo)}}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>

                                                <div class="recent-detail">
                                                    <a href="{{route('blog_detail',$recent_blog->id)}}">
                                                        <h5 class="recent-name">{{$recent_blog->title}}</h5>
                                                    </a>
                                                    <h6>{{date('d M, Y',strtotime($recent_blog->date))}} </h6>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(count($categories)>0)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseTwo">
                                        Category
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingTwo">
                                    <div class="accordion-body p-0">
                                        <div class="category-list-box">
                                            <ul>
                                                @foreach($categories as $category)
                                                <li>
                                                    <a href="{{route('blogs',$category->id)}}">
                                                        <div class="category-name">
                                                            <h5>{{$category->title}}</h5>
                                                            <span>{{$category->blogs}}</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(count($tranding_products)>0)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseFour">
                                        Trending Products
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingFour">
                                    <div class="accordion-body">
                                        <ul class="product-list product-list-2 border-0 p-0">
                                            @foreach($tranding_products as $tranding_product)
                                            @php $product_price = DB::table('product_price')->where('product_id',$tranding_product->id)->first(); @endphp
                                            <li>
                                                <div class="offer-product">
                                                    <a href="{{route('products_detail',$tranding_product->slug)}}" class="offer-image">
                                                        <img src="{{URL::to($tranding_product->photo)}}"
                                                            class="blur-up lazyload" alt="">
                                                    </a>

                                                    <div class="offer-detail">
                                                        <div>
                                                            <a href="{{route('products_detail',$tranding_product->slug)}}">
                                                                <h6 class="name">{{$tranding_product->title}}</h6>
                                                            </a>
                                                            <span>{{$product_price->quantity}}</span>
                                                            <h6 class="price theme-color">{!! $settings->currency_symbol ?? '' !!} {{ $product_price->price ?? '' }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>

                    </div>
                </div>

                <div class="col-xxl-9 col-xl-8 col-lg-7 order-lg-2">
                    <div class="row g-4 ratio_65">
                        @foreach($blogs as $blog)
                        <div class="col-xxl-4 col-sm-6">
                            <div class="blog-box wow fadeInUp">
                                <div class="blog-image">
                                    <a href="{{route('blog_detail',$blog->id)}}">
                                        <img src="{{URL::to($blog->photo)}}"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>

                                <div class="blog-contain">
                                    <div class="blog-label">
                                        <span class="time"><i data-feather="clock"></i> <span>{{date('d M, Y',strtotime($blog->date))}}</span></span>
                                        <span class="super"><i data-feather="user"></i> <span>{{$blog->added_by}}</span></span>
                                    </div>
                                    <a href="{{route('blog_detail',$blog->id)}}">
                                        <h3>{{$blog->title}}</h3>
                                    </a>
                                    <button onclick="location.href = '{{route("blog_detail",$blog->id)}}'" class="blog-button">Read More
                                        <i class="fa-solid fa-right-long"></i></button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <nav class="custome-pagination pagination justify-content-center">
                       {{$blogs->links()}}
                    </nav>
                </div>

            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

@endsection