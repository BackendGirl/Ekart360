@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')


<!-- Breadcrumb Section Start -->
@include('frontend.layouts.breadscrumb')
<!-- Breadcrumb Section End -->

<!-- Faq Question section Start -->
<section class="faq-contain">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="slider-4-2 product-wrapper">
                    <div>
                        <div class="faq-top-box">
                            <div class="faq-box-icon">
                                <img src="{{URL::to('public/frontend/bakery/assets/images/inner-page/faq/start.png')}}"
                                    class="blur-up lazyload" alt="">
                            </div>

                            <div class="faq-box-contain">
                                <h3>Getting Started</h3>
                                <p>Bring to the table win-win survival strategies to ensure proactive domination.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="faq-top-box">
                            <div class="faq-box-icon">
                                <img src="{{URL::to('public/frontend/bakery/assets/images/inner-page/faq/help.png')}}"
                                    class="blur-up lazyload" alt="">
                            </div>

                            <div class="faq-box-contain">
                                <h3>Sales Question</h3>
                                <p>Lorizzle ipsizzle boom shackalack sit get down get down.</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="faq-top-box">
                            <div class="faq-box-icon">
                                <img src="{{URL::to('public/frontend/bakery/assets/images/inner-page/faq/price.png')}}"
                                    class="blur-up lazyload" alt="">
                            </div>

                            <div class="faq-box-contain">
                                <h3>Pricing & Plans</h3>
                                <p>Curabitizzle fizzle break yo neck, yall quis fo shizzle mah nizzle fo rizzle.</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="faq-top-box">
                            <div class="faq-box-icon">
                                <img src="{{URL::to('public/frontend/bakery/assets/images/inner-page/faq/contact.png')}}"
                                    class="blur-up lazyload" alt="">
                            </div>

                            <div class="faq-box-contain">
                                <h3>Support Contact</h3>
                                <p>Gizzle fo shizzle bow wow wow bizzle leo bibendizzle check out this.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Faq Question section End -->

@if(count($faqs)>0)
<!-- Faq Section Start -->
<section class="faq-box-contain section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-xl-5">
                <div class="faq-contain">
                    <h2>Frequently Asked Questions</h2>
                    <p>We are answering most frequent questions. No worries if you not find exact one. You can find
                        out more by searching or continuing clicking button below or directly <a href="{{route('contact')}}"
                            class="theme-color text-decoration-underline">contact our
                            support.</a></p>
                </div>
            </div>

            <div class="col-xl-7">
                <div class="faq-accordion">
                    <div class="accordion" id="accordionExample">
                        @foreach($faqs as $key => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    {{$faq->title ?? ''}} <i
                                        class="fa-solid fa-angle-down"></i>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse @if($key == 0) show @endif" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>{!!$faq->description ?? ''!!}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Faq Section End -->
@endif

@endsection