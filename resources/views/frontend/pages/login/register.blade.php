@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')


<!-- Breadcrumb Section Start -->
@include('frontend.layouts.breadscrumb')
<!-- Breadcrumb Section End -->

 <!-- log in section start -->
 <section class="log-in-section section-b-space">
        <div class="container-fluid-lg w-100">
            <div class="row">
                <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                    <div class="image-contain">
                        <img src="{{ asset('uploads/setting/'.$settings->register_image) }}" class="img-fluid" alt="">
                    </div>
                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h3>Welcome To {{$settings->title}}</h3>
                            <h4>Create New Account</h4>
                        </div>

                        <div class="input-box">
                            <form class="row g-4" action="{{route('register_submit')}}" method="post">
                                @csrf
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" id="fullname" placeholder="Full Name" name="name" value="{{old('name')}}">
                                        <label for="fullname">Full Name</label>
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>                                  
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="tel" class="form-control" id="phone" placeholder="Phone Address" name="phone" value="{{old('phone')}}">
                                        <label for="phone">Phone Number</label>
                                        @error('phone')
                                             <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" value="{{old('email')}}">
                                        <label for="email">Email Address</label>
                                        @error('email')
                                             <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="password" class="form-control" id="password"
                                            placeholder="Password" name="password">
                                        <label for="password">Password</label>
                                    </div>
                                </div>

                                <input type="hidden" name="last_url" value="{{url()->previous()}}">

                                <div class="col-12">
                                    <button class="btn btn-animation w-100" type="submit">Sign Up</button>
                                </div>
                            </form>
                        </div>

                        <div class="other-log-in">
                            <h6></h6>
                        </div>

                        <div class="sign-up-box">
                            <h4>Already have an account?</h4>
                            <a href="{{route('login')}}">Log In</a>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-7 col-xl-6 col-lg-6"></div>
            </div>
        </div>
    </section>
    <!-- log in section end -->

@endsection