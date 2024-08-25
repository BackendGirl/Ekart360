@if(count($blogs)>0)
<section class="section-lg-space">
    <div class="container-fluid-lg">
        <div class="about-us-title text-center">
            <h4 class="text-content">Our Blog</h4>
            <h2 class="center">Our Latest Blog</h2>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="slider-5 ratio_87">

                  @foreach($blogs as $blog)
                    <div>
                        <div class="blog-box">
                            <div class="blog-box-image">
                                <div class="blog-image">
                                    <a href="{{route('blog_detail',$blog->id)}}" class="rounded-3">                                        
                                        @if($blog->photo)
                                            <img src="{{URL::to($blog->photo)}}" class="bg-img blur-up lazyload" alt="">
                                        @else
                                            <img src="{{URL::to('public/backend/img/thumbnail-default.jpg')}}" class="bg-img blur-up lazyload" alt="">
                                        @endif
                                    </a>
                                </div>
                            </div>

                            <a href="{{route('blog_detail',$blog->id)}}" class="blog-detail d-block">
                                <h6>{{$blog->category_title}}</h6>
                                <h5>{{$blog->title}}</h5>
                            </a>
                        </div>
                    </div>
                  @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
@endif