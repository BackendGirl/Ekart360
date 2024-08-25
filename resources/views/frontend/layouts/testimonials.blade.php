@if(count($testimonials)>0)
<section class="review-section section-lg-space">
    <div class="container-fluid">
        <div class="about-us-title text-center">
            <h4 class="text-content">Latest Testimonals</h4>
            <h2 class="center">What people say</h2>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="slider-4-half product-wrapper">

                 @foreach($testimonials as $testimoinial)
                    <div>
                        <div class="reviewer-box">
                            <i class="fa-solid fa-quote-right"></i>
                            <div class="product-rating">
                                <ul class="rating">
                                @for($rat = 1; $rat <= $testimoinial->rating; $rat++)
                                    <li><i data-feather="star" class="fill"></i></li>
                                @endfor
                                </ul>
                            </div>

                            <h3>{{$testimoinial->title}}</h3>

                            <p>{{$testimoinial->description}}</p>

                            <div class="reviewer-profile">
                                <div class="reviewer-image">
                                    <img src="{{URL::to($testimoinial->photo)}}" class="blur-up lazyload" alt="">
                                </div>

                                <div class="reviewer-name">
                                    <h4>{{$testimoinial->name}}</h4>
                                    <h6>{{$testimoinial->designation}}</h6>
                                </div>
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