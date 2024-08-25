   <!-- Newsletter Section Start -->
   <section class="newsletter-section section-b-space">
        <div class="container-fluid-lg">
            <div class="newsletter-box newsletter-box-2 newsletter-box-3">
                <div class="newsletter-contain py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-xxl-4 col-lg-5 col-md-7 col-sm-9 offset-xxl-2 offset-md-1">
                                <div class="newsletter-detail">
                                    <h2>Join our newsletter and get...</h2>
                                    <h5>₹20 discount for your first order</h5>
                                    <form action="{{route('newsletter')}}" method="post">
                                        @csrf
                                    <div class="input-box">
                                        <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
                                            placeholder="Enter Your Email">
                                        <i class="fa-solid fa-envelope arrow"></i>
                                        <button class="sub-btn btn text-white theme-bg-color" type="submit">
                                            <span class="d-sm-block d-none">Subscribe</span>
                                            <i class="fa-solid fa-arrow-right icon"></i>
                                        </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Newsletter Section End -->