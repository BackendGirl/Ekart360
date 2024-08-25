@extends('admin.layouts.master')
@section('title', $title)
@section('page_css')
<style>
    #pieChart{
        max-width: 100% !important;
        max-height: 500px !important;
    }
</style>
@endsection

@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ bitcoin-wallet section ] start-->
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card bg-c-blue bitcoin-wallet">
                    <a href="{{route('admin.products.index')}}">
                    <div class="card-block">
                        <h5 class="text-white mb-2">{{ __('field_total') }} Products</h5>
                        <h2 class="text-white mb-2 f-w-300">{{$products ?? 0}}</h2>
                        <i class="fas fa-user-graduate f-70 text-white"></i>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card bg-c-blue bitcoin-wallet">
                    <a href="{{route('admin.product-category.index')}}">
                    <div class="card-block">
                        <h5 class="text-white mb-2"> {{ __('status_active') }} Product Categories</h5>
                        <h2 class="text-white mb-2 f-w-300">{{$product_categories ?? 0}}</h2>
                        <i class="fas fa-user-check f-70 text-white"></i>
                    </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card bg-c-blue bitcoin-wallet">
                    <a href="{{route('admin.blogs.index')}}">
                    <div class="card-block">
                        <h5 class="text-white mb-2">{{ __('status_active') }} Blogs</h5>
                        <h2 class="text-white mb-2 f-w-300">{{$blogs ?? 0}}</h2>
                        <i class="fas fa-user-tag f-70 text-white"></i>
                    </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card bg-c-blue bitcoin-wallet">
                    <a href="{{route('admin.blog-categories.index')}}">
                    <div class="card-block">
                        <h5 class="text-white mb-2">{{ __('field_total') }} Blogs Categories</h5>
                        <h2 class="text-white mb-2 f-w-300">{{$blog_categories ?? 0}}</h2>
                        <i class="fas fa-book f-70 text-white"></i>
                    </a>
                    </div>
                </div>
            </div>
            <!-- [ bitcoin-wallet section ] end-->
        </div>

        <div class="row">
            <!-- [ bitcoin-wallet section ] start-->
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card bg-c-blue bitcoin-wallet">
                    <a href="{{route('admin.orders.index')}}">
                    <div class="card-block">
                        <h5 class="text-white mb-2">{{ __('field_total') }} Orders</h5>
                        <h2 class="text-white mb-2 f-w-300">{{$orders ?? 0}}</h2>
                        <i class="fas fa-user-graduate f-70 text-white"></i>
                    </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card bg-c-blue bitcoin-wallet">
                    <a href="{{route('admin.saller.index')}}">
                    <div class="card-block">
                        <h5 class="text-white mb-2"> {{ __('status_active') }} Venders</h5>
                        <h2 class="text-white mb-2 f-w-300">{{$venders ?? 0}}</h2>
                        <i class="fas fa-user-check f-70 text-white"></i>
                    </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card bg-c-blue bitcoin-wallet">
                    <a href="{{route('admin.product-reviews.index')}}">
                    <div class="card-block">
                        <h5 class="text-white mb-2">{{ __('status_active') }} Reviews</h5>
                        <h2 class="text-white mb-2 f-w-300">{{$reviews ?? 0}}</h2>
                        <i class="fas fa-user-tag f-70 text-white"></i>
                    </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card bg-c-blue bitcoin-wallet">
                    <a href="{{route('admin.contact-admin.index')}}">
                    <div class="card-block">
                        <h5 class="text-white mb-2">{{ __('field_total') }} Contacts</h5>
                        <h2 class="text-white mb-2 f-w-300">{{$contacts ?? 0}}</h2>
                        <i class="fas fa-book f-70 text-white"></i>
                    </a>
                    </div>
                </div>
            </div>
            <!-- [ bitcoin-wallet section ] end-->
        </div>

        <div class="row">
            <!-- [ bitcoin-wallet section ] start-->
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card bg-c-blue bitcoin-wallet">
                    <a href="{{route('admin.offers.index')}}">
                    <div class="card-block">
                        <h5 class="text-white mb-2">{{ __('field_total') }} Offers</h5>
                        <h2 class="text-white mb-2 f-w-300">{{$offers ?? 0}}</h2>
                        <i class="fas fa-user-graduate f-70 text-white"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card bg-c-blue bitcoin-wallet">
                    <a href="{{route('admin.header-notifications.index')}}">
                    <div class="card-block">
                        <h5 class="text-white mb-2"> {{ __('status_active') }} Notifications</h5>
                        <h2 class="text-white mb-2 f-w-300">{{$notifications ?? 0}}</h2>
                        <i class="fas fa-user-check f-70 text-white"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card bg-c-blue bitcoin-wallet">
                    <a href="{{route('admin.testimonials.index')}}">
                    <div class="card-block">
                        <h5 class="text-white mb-2">{{ __('status_active') }} Testimonials</h5>
                        <h2 class="text-white mb-2 f-w-300">{{$testimonials ?? 0}}</h2>
                        <i class="fas fa-user-tag f-70 text-white"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card bg-c-blue bitcoin-wallet">
                    <a href="{{route('admin.users-admin.index')}}">
                    <div class="card-block">
                        <h5 class="text-white mb-2">{{ __('field_total') }} Users</h5>
                        <h2 class="text-white mb-2 f-w-300">{{$users ?? 0}}</h2>
                        <i class="fas fa-book f-70 text-white"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- [ bitcoin-wallet section ] end-->
        </div>

    </div>
</div>
<!-- End Content-->

@endsection