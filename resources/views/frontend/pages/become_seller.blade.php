@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')


<!-- Breadcrumb Section Start -->
@include('frontend.layouts.breadscrumb')
<!-- Breadcrumb Section End -->

<!-- About Section Start -->
<section class="saller-poster-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-4 order-lg-2">
                <div class="poster-box">
                    <div class="poster-image">
                        <img src="{{URL::to($seller_data->photo)}}"
                            class="img-fluid" alt="">
                    </div>
                </div>
            </div>

            <div class="col-xxl-7">
                <div class="seller-title h-100 d-flex align-items-center">
                    <div>
                        <h2>{{$seller_data->title ?? ''}}</h2>
                        <p>{!!$seller_data->description ?? ''!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->

<!-- Business Section Start -->
<section class="business-section section-b-space">
    <div class="container-fluid-lg">
        <div class="vendor-title mb-5">
            <h5>Doing Business On Fastkart Is Really Easy</h5>
        </div>

        <div class="business-contain">
            <div class="row">
                <div class="col-xxl-4">
                    <div class="business-box">
                        <div>
                            <div class="business-number">
                                <h2>1</h2>
                            </div>
                            <div class="business-detail">
                                <h4>List Your Products & Get Support Service Provider</h4>
                                <p>Register your business for free and create a product catalogue. Sell under your
                                    own private label or sell an existing brand. Get your documentation & cataloging
                                    done with ease from our Professional Services network.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4">
                    <div class="business-box">
                        <div>
                            <div class="business-number">
                                <h2>2</h2>
                            </div>
                            <div class="business-detail">
                                <h4>Receive orders & Schedule a pickup</h4>
                                <p>Once listed, your products will be available to millions of users.Get orders and
                                    manage your online business via our Seller Panel and Seller Zone Mobile App.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4">
                    <div class="business-box">
                        <div>
                            <div class="business-number">
                                <h2>3</h2>
                            </div>
                            <div class="business-detail">
                                <h4> Receive quick payment & grow your business</h4>
                                <p>Receive quick and hassle-free payments in your account once your orders are
                                    fulfilled. Expand your business with low interest & collateral-free loans.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Business Section End -->

<!-- Selling Section Start -->
<section class="selling-section section-b-space">
    <div class="container-fluid-lg">
        <div class="vendor-title">
            <h5>Start Selling</h5>
            <p>Fastkart marketplace is India's leading platform for selling online. Be it a manufacturer,
                vendor or supplier, simply sell your products online on Fastkart and become a top ecommerce
                player with minimum investment. Through a team of experts offering exclusive seller
                workshops, training, seller support and convenient seller portal, Fastkart focuses on
                educating and empowering sellers across India. Selling on Fastkart.com is easy and
                absolutely free. All you need is to register, list your catalogue and start selling your
                products.</p>
        </div>
        <form action="{{route('become_a_saller')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-3 mt-3">
                    <div class="form-floating theme-form-floating-2 search-box">
                        <input type="text" class="form-control" id="company_name" name="company_name" value="{{old('company_name')}}" required >
                        <label for="company_name">Company Name</label>
                    </div>
                </div>

                <div class="col-lg-3 mt-3">
                    <div class="form-floating theme-form-floating-2 search-box">
                        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" required >
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="col-lg-3 mt-3">
                    <div class="form-floating theme-form-floating-2 search-box">
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{old('phone')}}" required >
                        <label for="phone">Phone</label>
                    </div>
                </div>
                <div class="col-lg-3 mt-3">
                    <div class="form-floating theme-form-floating-2 search-box">
                        <input type="text" class="form-control" id="country" name="country" value="{{old('country')}}" required >
                        <label for="country">Country</label>
                    </div>
                </div>

                <div class="col-lg-3 mt-3">
                    <div class="form-floating theme-form-floating-2 search-box">
                        <input type="numeric" class="form-control" id="year_established" name="year_established" value="{{old('year_established')}}" required >
                        <label for="year_established">Year Established</label>
                    </div>
                </div>                
                <div class="col-lg-3 mt-3">
                    <div class="form-floating theme-form-floating-2 search-box">
                        <select class="form-control" id="category" name="category" required>
                            <option value="">select</option>
                            @if(count($product_category)>0)
                            @foreach ($product_category as $category)
                               <option value="{{$category->id}}" @if($category->id == old('category')) selected @endif>{{$category->title}}</option>
                            @endforeach
                            @endif
                        </select>
                        <label for="category">Category</label>
                    </div>
                </div>
                <div class="col-lg-3 mt-3">
                    <div class="form-floating theme-form-floating-2 search-box">
                        <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}" required >
                        <label for="city">City</label>
                    </div>
                </div>
                <div class="col-lg-3 mt-3">
                    <div class="form-floating theme-form-floating-2 search-box">
                        <input type="numeric" class="form-control" id="zip" name="zip" value="{{old('zip')}}" required >
                        <label for="zip">Zip</label>
                    </div>
                </div>

                <div class="col-lg-3 mt-3">
                    <div class="form-floating theme-form-floating-2 search-box">
                        <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}" required >
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="col-lg-3 mt-3">
                    <div class="form-floating theme-form-floating-2 search-box">
                        <input type="file" class="form-control" id="photo" name="photo" required >
                        <label for="photo">Photo</label>
                    </div>
                </div>
                <div class="col-lg-6 mt-3">
                    <div class="form-floating theme-form-floating-2 search-box">
                        <textarea name="address" id="address" class="form-control" required >{{old('address')}}</textarea>
                        <label for="address">Address</label>
                    </div>
                </div>

                <div class="col-12">
                    <button class="btn btn-md mt-3 theme-bg-color text-white" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Selling Section End -->

@endsection