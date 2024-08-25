@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')


<!-- Breadcrumb Section Start -->
@include('frontend.layouts.breadscrumb')
<!-- Breadcrumb Section End -->

      <!-- Contact Box Section Start -->
      <section class="contact-box-section">
        <div class="container-fluid-lg">
            <div class="row g-lg-5 g-3">

                <div class="col-lg-6">
                    <div class="left-sidebar-box">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="contact-image">
                                    <img src="{{ asset('uploads/setting/'.$settings->contact_image) }}"
                                        class="img-fluid blur-up lazyloaded" alt="">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="contact-title">
                                    <h3>Get In Touch</h3>
                                </div>

                                <div class="contact-detail">
                                    <div class="row g-4">
                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-phone"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Phone</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>{{$settings->phone}}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Email</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>{{$settings->email}}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>London Office</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>{{$settings->address}}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-building"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Bournemouth Office</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                   <p>{{$settings->address2}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="title d-xxl-none d-block">
                        <h2>Contact Us</h2>
                    </div>
                    <div class="right-sidebar-box">
                        <form action="{{route('contact_submit')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput" class="form-label">First Name <span class="text-danger">*</span></label>
                                        <div class="custom-input">
                                            <input type="text" class="form-control" id="exampleFormControlInput"
                                                placeholder="Enter First Name" name="first_name" value="{{old('first_name')}}">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        @error('first_name')
                                             <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput1" class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <div class="custom-input">
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Enter Last Name" name="last_name" value="{{old('last_name')}}">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        @error('last_name')
                                             <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput2" class="form-label">Email Address <span class="text-danger">*</span></label>
                                        <div class="custom-input">
                                            <input type="email" class="form-control" id="exampleFormControlInput2"
                                                placeholder="Enter Email Address" name="email" value="{{old('email')}}">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                        @error('email')
                                             <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput3" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                        <div class="custom-input">
                                            <input type="tel" class="form-control" id="exampleFormControlInput3"
                                                placeholder="Enter Your Phone Number" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value =
                                                this.value.slice(0, this.maxLength);" name="phone" value="{{old('phone')}}">
                                            <i class="fa-solid fa-mobile-screen-button"></i>
                                        </div>
                                        @error('phone')
                                             <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlTextarea" class="form-label">Message <span class="text-danger">*</span></label>
                                        <div class="custom-textarea">
                                            <textarea class="form-control" id="exampleFormControlTextarea"
                                                placeholder="Enter Your Message" rows="6" name="message">{{old('message')}}</textarea>
                                            <i class="fa-solid fa-message"></i>
                                        </div>
                                        @error('message')
                                             <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-animation btn-md fw-bold ms-auto" type="submit">Send Message</button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- Contact Box Section End -->

    <!-- Map Section Start -->
    <section class="map-section">
        <div class="container-fluid p-0">
            <div class="map-box">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13776.12632820944!2d77.98423278715819!3d30.321619500000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39092bd7c63b87d1%3A0x32ac33b5844a2f2a!2sAK%20Software%20Solutions%20%7C%20Software%20Company%20In%20Dehradun!5e0!3m2!1sen!2sin!4v1690263391351!5m2!1sen!2sin"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    <!-- Map Section End -->

@endsection