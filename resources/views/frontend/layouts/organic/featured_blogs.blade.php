@if(count($blogs)>0)
<section>
    <div class="container-fluid-lg">
        <div class="title">
            <h2>Featured Blog</h2>
            <span class="title-leaf">
                <svg class="icon-width">
                    <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                </svg>
            </span>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="slider-5 ratio_87">
                   @foreach($blogs as $blog)
                    <div>
                        <div class="blog-box">
                            <div class="blog-box-image">
                                <a href="{{route('blog_detail',$blog->id)}}" class="blog-image">
                                    <img src="{{URL::to($blog->photo)}}" class="bg-img blur-up lazyload" alt="">
                                </a>
                            </div>

                            <div class="blog-detail">
                                <h6>{{$blog->category_title ?? ''}}</h6>
                                <h5>{{$blog->title ?? ''}}</h5>
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