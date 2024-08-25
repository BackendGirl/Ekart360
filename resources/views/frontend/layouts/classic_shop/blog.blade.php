@if(count($blogs)>0)
<section class="blog-section">
        <div class="container-fluid-lg">
            <div class="title title-4">
                <h2>Blog</h2>
            </div>

            <div class="slider-3-blog arrow-slider slick-height">
                @foreach($blogs as $blog)
                <div>
                    <div class=" blog-box ratio_45">
                        <div class="blog-box-image">
                            <a href="{{route('blog_detail',$blog->id)}}">
                                <img src="{{URL::to($blog->photo)}}" class="blur-up lazyload bg-img" alt="">
                            </a>
                        </div>

                        <div class="blog-detail">
                            <a href="{{route('blog_detail',$blog->id)}}">
                                <h3>{{$blog->title ?? ''}}</h3>
                            </a>
                            <h5 class="text-content">{{$blog->admin ?? ''}} {{date('M d, Y',strtotime($blog->date))}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endif