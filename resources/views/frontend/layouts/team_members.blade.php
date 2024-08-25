@if(count($team_members)>0)
<section class="team-section section-lg-space">
    <div class="container-fluid-lg">
        <div class="about-us-title text-center">
            <h4 class="text-content">Our Creative Team</h4>
            <h2 class="center">{{$settings->title}} team member</h2>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="slider-user product-wrapper">

                 @foreach($team_members as $team_member)
                    <div>
                        <div class="team-box">
                            <div class="team-iamge">
                                <img src="{{URL::to($team_member->photo)}}" class="img-fluid blur-up lazyload"
                                    alt="">
                            </div>

                            <div class="team-name">
                                <h3>{{$team_member->name}}</h3>
                                <h5>{{$team_member->designation}}</h5>
                                <p>cheeseburger airedale mozzarella the big cheese fondue.</p>
                                <!-- <ul class="team-media">
                                    <li>
                                        <a href="https://www.facebook.com/" class="fb-bg">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="https://in.pinterest.com/" class="pint-bg">
                                            <i class="fa-brands fa-pinterest-p"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="https://twitter.com/" class="twitter-bg">
                                            <i class="fa-brands fa-twitter"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="https://www.instagram.com/" class="insta-bg">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul> -->
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