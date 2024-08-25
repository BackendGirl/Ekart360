@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')


<!-- Breadcrumb Section Start -->
@include('frontend.layouts.breadscrumb')
<!-- Breadcrumb Section End -->

<!-- User Dashboard Section Start -->
<section class="user-dashboard-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                <div class="dashboard-left-sidebar">
                    <div class="close-button d-flex d-lg-none">
                        <button class="close-sidebar">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="profile-box">
                        <div class="cover-image">
                            <img src="{{URL::to('public/frontend/bakery/assets/images/inner-page/cover-img.jpg')}}"
                                class="img-fluid blur-up lazyload" alt="">
                        </div>

                        <div class="profile-contain">
                            <div class="profile-image">
                                <div class="position-relative">
                                    <img src="{{URL::to($vender_data->photo)}}">
                                </div>
                            </div>

                            <div class="profile-name">
                                <h3>{{$vender_data->company_name ?? ''}}</h3>
                                <h6 class="text-content">{{$vender_data->email ?? ''}}</h6>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#pills-tabContent" class="nav-link active" id="pills-dashboard-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-dashboard" role="tab"
                                aria-controls="pills-dashboard" aria-selected="true"><i data-feather="home"></i>
                                DashBoard</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-product-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-product" type="button" role="tab" aria-controls="pills-product"
                                aria-selected="false"><i data-feather="shopping-bag"></i>Products</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-order-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-order" type="button" role="tab" aria-controls="pills-order"
                                aria-selected="false"><i data-feather="shopping-bag"></i>Order</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false"><i data-feather="user"></i>
                                Profile</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-security-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-security" type="button" role="tab" aria-controls="pills-security"
                                aria-selected="false"><i data-feather="settings"></i>
                                Setting</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="{{route($route.'.logout')}}">
                            <button class="nav-link" id="pills-out-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-out" type="button" role="tab" aria-selected="false"><i
                                    data-feather="log-out"></i>
                                Log Out</button>
                                </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xxl-9 col-lg-8">
                <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show
                    Menu</button>
                <div class="dashboard-right-sidebar">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel"
                            aria-labelledby="pills-dashboard-tab">
                            <div class="dashboard-home">
                                <div class="title">
                                    <h2>My Dashboard</h2>
                                    <span class="title-leaf">
                                        <svg class="icon-width bg-gray">
                                            <use
                                                xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                            </use>
                                        </svg>
                                    </span>
                                </div>

                                <div class="dashboard-user-name">
                                    <h6 class="text-content">Hello, <b
                                            class="text-title">{{$vender_data->company_name ?? ''}}</b></h6>
                                    <p class="text-content">From your My Account Dashboard you have the ability to
                                        view a snapshot of your recent account activity and update your account
                                        information. Select a link below to view or edit information.</p>
                                </div>

                                <div class="total-box">
                                    <div class="row g-sm-4 g-3">
                                        <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                            <div class="totle-contain">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/order.svg"
                                                    class="img-1 blur-up lazyload" alt="">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/order.svg"
                                                    class="blur-up lazyload" alt="">
                                                <div class="totle-detail">
                                                    <h5>Total Products</h5>
                                                    <h3>{{count($products) ?? 0}}</h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                            <div class="totle-contain">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/pending.svg"
                                                    class="img-1 blur-up lazyload" alt="">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/pending.svg"
                                                    class="blur-up lazyload" alt="">
                                                <div class="totle-detail">
                                                    <h5>Total Sales</h5>
                                                    <h3>{{count($orders) ?? 0}}</h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                            <div class="totle-contain">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/wishlist.svg"
                                                    class="img-1 blur-up lazyload" alt="">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/wishlist.svg"
                                                    class="blur-up lazyload" alt="">
                                                <div class="totle-detail">
                                                    <h5>Order Pending</h5>
                                                    <h3>{{$orders_pending ?? 0}}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-xxl-6">
                                        <div class="dashboard-bg-box">
                                            <div id="chart"></div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-6">
                                        <div class="dashboard-bg-box">
                                            <div id="sale"></div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-6">
                                        <div class="table-responsive dashboard-bg-box">
                                            <div class="dashboard-title mb-4">
                                                <h3>Trending Products</h3>
                                            </div>

                                            <table class="table product-table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Images</th>
                                                        <th scope="col">Product Name</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Category</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($trending_products)>0)
                                                    @foreach($trending_products as $trending_product)
                                                    @php
                                                    $product_price=DB::table('product_price')->where('product_id',$trending_product->id)->first();
                                                    @endphp
                                                    <tr>
                                                        <td class="product-image">
                                                            <img src="{{URL::to($trending_product->photo)}}"
                                                                class="img-fluid" alt="">
                                                        </td>
                                                        <td>
                                                            <h6>{{$trending_product->title ?? ''}}</h6>
                                                        </td>
                                                        <td>
                                                            <h6>{!! $settings->currency_symbol ?? '' !!}
                                                                {{ $product_price->price ?? '' }}</h6>
                                                        </td>
                                                        <td>
                                                            <h6>{{$trending_product->category_title}}</h6>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @else
                                                    <span>No Data Available</span>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-xxl-6">
                                        <div class="order-tab dashboard-bg-box">
                                            <div class="dashboard-title mb-4">
                                                <h3>Recent Order</h3>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table order-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Order ID</th>
                                                            <th scope="col">Product Name</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(count($recent_orders)>0)
                                                        @foreach($recent_orders as $recent_order)
                                                        <tr>
                                                            <td class="product-image">{{$recent_order->order_number ?? ''}}</td>
                                                            <td>
                                                            @if($recent_order->product_detail != null && $recent_order->product_detail !='')                                        
                                                            @foreach(json_decode($recent_order->product_detail) as $key=> $subphotos2) 
                                                            @if($key == $theme)
                                                            @foreach($subphotos2 as $subphotos3)
                                                            @foreach($subphotos3 as $subphotos)
                                                            @php $product = DB::table('products')->where('id',$subphotos->product_id)->where('theme',$theme)->first() @endphp
                                                            @if(!empty($product))
                                                                <h6>{{$product->title ?? ''}} @if($subphotos->weight)({{$subphotos->weight}})@endif</h6>
                                                            @endif
                                                            @endforeach
                                                            @endforeach
                                                            @endif
                                                            @endforeach
                                                            @endif
                                                            </td>
                                                            <td>
                                                                @if($recent_order->order_status=='new')
                                                                <label class="badge bg-primary">{{$recent_order->order_status}}</label>
                                                                @elseif($recent_order->order_status=='process')
                                                                <label class="badge bg-warning">{{$recent_order->order_status}}</label>
                                                                @elseif($recent_order->order_status=='delivered')
                                                                <label class="badge bg-success">{{$recent_order->order_status}}</label>
                                                                @else
                                                                <label class="badge bg-danger">{{$recent_order->order_status}}</label>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <span>No Data Available</span>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="tab-pane fade" id="pills-product" role="tabpanel"
                            aria-labelledby="pills-product-tab">
                            <div class="product-tab">
                                <div class="title d-block">
                                <h2>All Product</h2>
                                    <button class="btn btn-sm theme-bg-color text-white" style="float:right;"
                                        data-bs-toggle="modal" data-bs-target="#add-address">Add</button>                                    
                                    <span class="title-leaf">
                                        <svg class="icon-width bg-gray">
                                            <use
                                                xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                            </use>
                                        </svg>
                                    </span>
                                </div>

                                <div class="table-responsive dashboard-bg-box">
                                    <table class="table product-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.No.</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Photo</th>
                                                <th scope="col">Sub Photos</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Edit / Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($products)>0)
                                            @foreach($products as $key3 => $value)
                                            <tr>
                                                <td>{{ $key3 + 1 }}</td>
                                                <td>{{ $value->title }}</td>
                                                <td>
                                                    @if($value->photo)
                                                    <img src="{{URL::to($value->photo)}}" class="img-fluid zoom"
                                                        style="max-width:80px" alt="{{$value->photo}}">
                                                    @else
                                                    <img src="{{URL::to('public/backend/img/thumbnail-default.jpg')}}"
                                                        class="img-fluid zoom" style="max-width:100px" alt="avatar.png">
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($value->sub_photos != null && $value->sub_photos !='')
                                                    @foreach(explode(',', $value->sub_photos) as $key=>$subphotos)
                                                    @php $catid = trim($subphotos,'[]"'); @endphp
                                                    @if($catid != '' && strlen($catid) > 1)
                                                    @php $img = str_replace("\\", '', $catid) @endphp
                                                    <img src="{{URL::to($img)}}" class="img-fluid zoom"
                                                        style="max-width:80px" alt="{{$value->photo}}">
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                </td>
                                                <td>{{ $value->category_title }}</td>
                                                <td>
                                                    @if( $value->status == 'active' )
                                                    <span
                                                        class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                                    @else
                                                    <span
                                                        class="badge badge-pill badge-warning">{{ __('status_inactive') }}</span>
                                                    @endif
                                                </td>
                                                <td class="efit-delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="modal"
                                                        data-bs-target="#edit-address-{{$key3}}" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit edit">
                                                        <path
                                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                        </path>
                                                        <path
                                                            d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                        </path>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal-{{ $value->id }}" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-trash-2 delete">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>

                                                    <style>
                                                    @media (min-width: 576px) {
                                                        #deleteModal- {
                                                                {
                                                                $value->id
                                                            }
                                                        }

                                                        .modal-dialog {
                                                            max-width: 15%;
                                                        }
                                                    }
                                                    </style>

                                                    <!-- Include Delete modal -->
                                                    @include('admin.layouts.inc.delete')

                                                </td>
                                            </tr>

                                            @endforeach
                                            @else
                                            No Products Found!!!
                                            @endif
                                        </tbody>
                                    </table>

                                    <nav class="custome-pagination pagination justify-content-center">
                                        {{$products->links()}}
                                    </nav>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-order" role="tabpanel" aria-labelledby="pills-order-tab">
                            <div class="dashboard-order">
                                <div class="title">
                                    <h2>All Order</h2>
                                    <span class="title-leaf title-leaf-gray">
                                        <svg class="icon-width bg-gray">
                                            <use
                                                xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                            </use>
                                        </svg>
                                    </span>
                                </div>

                                <div class="order-tab dashboard-bg-box">
                                    <div class="table-responsive">
                                        @if(count($orders)>0)
                                        <table class="table order-table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Order No.</th>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Sub Total</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Delivery Type</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order_key=>$order)
                                                <tr>
                                                    <td>{{$order_key+1}}</td>
                                                    <td>{{$order->order_number}}</td>
                                                    <td>{{$order->total_products}}</td>
                                                    <td>₹{{number_format($order->sub_total,2)}}</td>
                                                    <td>₹{{number_format($order->total_amount,2)}}</td>
                                                    <td>
                                                        @if($order->delivery_type == 'standard_delivery')
                                                        Standard Delivery
                                                        @else
                                                        Future Delivery <span
                                                            class="badge bg-primary">{{$order->future_delivery_date}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($order->order_status=='new')
                                                        <span class="badge bg-primary">{{$order->order_status}}</span>
                                                        @elseif($order->order_status=='process')
                                                        <span class="badge bg-warning">{{$order->order_status}}</span>
                                                        @elseif($order->order_status=='delivered')
                                                        <span class="badge bg-success">{{$order->order_status}}</span>
                                                        @else
                                                        <span class="badge bg-danger">{{$order->order_status}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{route($route.'.show',$order->id)}}"
                                                            class="btn btn-primary btn-sm float-left mr-1"
                                                            style="height:30px; width:30px;border-radius:50%"
                                                            data-toggle="tooltip" title="view"
                                                            data-placement="bottom"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <span style="float:right">{{$orders->links()}}</span>
                                        @else
                                        <h6 class="text-center">No data found!!!</h6>
                                        @endif
                                    </div>
                                    <nav class="custome-pagination pagination justify-content-center">
                                        {{$products->links()}}
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="dashboard-profile">
                                <div class="title">
                                    <h2>My Profile</h2>
                                    <span class="title-leaf">
                                        <svg class="icon-width bg-gray">
                                            <use
                                                xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                            </use>
                                        </svg>
                                    </span>
                                </div>

                                <div class="profile-tab dashboard-bg-box">
                                    <div class="dashboard-title dashboard-flex">
                                        <h3>Profile Name</h3>
                                        <button class="btn btn-sm theme-bg-color text-white" data-bs-toggle="modal"
                                            data-bs-target="#edit-profile">Edit Profile</button>
                                    </div>

                                    <ul>
                                        <li>
                                            <h5>Company Name :</h5>
                                            <h5>{{$vender_data->company_name ?? ''}}</h5>
                                        </li>
                                        <li>
                                            <h5>Email Address :</h5>
                                            <h5>{{$vender_data->email ?? ''}}</h5>
                                        </li>
                                        <li>
                                            <h5>Country / Region :</h5>
                                            <h5>{{$vender_data->country ?? ''}}</h5>
                                        </li>

                                        <li>
                                            <h5>Year Established :</h5>
                                            <h5>{{$vender_data->year_established ?? ''}}</h5>
                                        </li>

                                        <li>
                                            <h5>Category :</h5>
                                            <h5>{{$vender_data->category ?? ''}}</h5>
                                        </li>

                                        <li>
                                            <h5>Street Address :</h5>
                                            <h5>{{$vender_data->address ?? ''}}t</h5>
                                        </li>

                                        <li>
                                            <h5>City :</h5>
                                            <h5>{{$vender_data->city ?? ''}}</h5>
                                        </li>

                                        <li>
                                            <h5>Zip :</h5>
                                            <h5>{{$vender_data->zip ?? ''}}</h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-security" role="tabpanel"
                            aria-labelledby="pills-security-tab">
                            <div class="dashboard-privacy">
                                <div class="title">
                                    <h2>My Setting</h2>
                                    <span class="title-leaf">
                                        <svg class="icon-width bg-gray">
                                            <use
                                                xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                            </use>
                                        </svg>
                                    </span>
                                </div>

                                <div class="dashboard-bg-box">
                                    <div class="dashboard-title mb-4">
                                        <h3>Deactivate Account</h3>
                                    </div>
                                    <form action="{{route($route.'.account_deactivate',$vender_data->id)}}"
                                        method="post">
                                        @csrf
                                        @method('patch')
                                        @if($vender_data->status != 'deactivate')
                                        <div class="privacy-box">
                                            <div
                                                class="form-check custom-form-check custom-form-check-2 d-flex align-items-center">
                                                <input class="form-check-input" type="radio" id="concern" name="concern"
                                                    value="privacy_concern">
                                                <label class="form-check-label ms-2" for="concern">I have a privacy
                                                    concern</label>
                                            </div>
                                        </div>
                                        <div class="privacy-box">
                                            <div
                                                class="form-check custom-form-check custom-form-check-2 d-flex align-items-center">
                                                <input class="form-check-input" type="radio" id="temporary"
                                                    name="concern" value="temporary_deactivate">
                                                <label class="form-check-label ms-2" for="temporary">This is
                                                    temporary</label>
                                            </div>
                                        </div>
                                        <div class="privacy-box">
                                            <div
                                                class="form-check custom-form-check custom-form-check-2 d-flex align-items-center">
                                                <input class="form-check-input" type="radio" id="other" name="concern"
                                                    value="other">
                                                <label class="form-check-label ms-2" for="other">other</label>
                                            </div>
                                        </div>
                                        <button class="btn theme-bg-color btn-md fw-bold mt-4 text-white"
                                            type="submit">Deactivate
                                            Account</button>
                                        @else
                                        <span class="text-danger">Your accound is deactivate</span>
                                        <input type="hidden" name="concern" value="activate">
                                        <button class="btn theme-bg-color btn-md fw-bold mt-4 text-white"
                                            type="submit">Activate
                                            Account</button>
                                        @endif

                                    </form>
                                </div>

                                <div class="dashboard-bg-box">
                                    <div class="dashboard-title mb-4">
                                        <h3>Delete Account</h3>
                                    </div>
                                    <form action="{{route($route.'.account_delete',$vender_data->id)}}" method="post">
                                        @csrf
                                        @method('patch')
                                        <div class="privacy-box">
                                            <div
                                                class="form-check custom-form-check custom-form-check-2 d-flex align-items-center">
                                                <input class="form-check-input" type="radio" id="usable" name="usable"
                                                    value="delete_permanently">
                                                <label class="form-check-label ms-2" for="usable">No longer
                                                    usable</label>
                                            </div>
                                        </div>
                                        <div class="privacy-box">
                                            <div
                                                class="form-check custom-form-check custom-form-check-2 d-flex align-items-center">
                                                <input class="form-check-input" type="radio" id="account" name="usable"
                                                    value="switch_to_another_account">
                                                <label class="form-check-label ms-2" for="account">Want to switch on
                                                    other
                                                    account</label>
                                            </div>
                                        </div>
                                        <div class="privacy-box">
                                            <div
                                                class="form-check custom-form-check custom-form-check-2 d-flex align-items-center">
                                                <input class="form-check-input" type="radio" id="other-2" name="usable"
                                                    value="other">
                                                <label class="form-check-label ms-2" for="other-2">Other</label>
                                            </div>
                                        </div>
                                        <button class="btn theme-bg-color btn-md fw-bold mt-4 text-white">Delete My
                                            Account</button>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- User Dashboard Section End -->

<!-- Add address modal box start -->
<div class="modal fade theme-modal" id="add-address" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a new address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{route($route.'.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="text" class="form-control" id="title" name="title" required>
                                <label for="title">Title <span class="text-danger">*</span></label>
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <select name="category" id="category" class="form-control">
                                    <option value="">select</option>
                                    @if(count($categories)>0)
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <label for="category">Category <span class="text-danger">*</span></label>
                                @error('category')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <select name="status" id="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                <label for="status">Status <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="file" class="form-control" id="photo" name="photo" required>
                                <label for="photo">Photo <span class="text-danger">*</span></label>
                                @error('photo')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="file" class="form-control" id="sub_photos" name="sub_photos[]" multiple
                                    required>
                                <label for="sub_photos">Sub Photos <span class="text-danger">*</span></label>
                                @error('sub_photos')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <select name="rating" class="form-control">
                                    <option value="0.5" @if(old('rating'=='0.5' )) selected @endif>0.5</option>
                                    <option value="1" @if(old('rating'=='1' )) selected @endif>1</option>
                                    <option value="1.5" @if(old('rating'=='1.5' )) selected @endif>1.5</option>
                                    <option value="2" @if(old('rating'=='2' )) selected @endif>2</option>
                                    <option value="2.5" @if(old('rating'=='2.5' )) selected @endif>2.5</option>
                                    <option value="3" @if(old('rating'=='3' )) selected @endif>3</option>
                                    <option value="3.5" @if(old('rating'=='3.5' )) selected @endif>3.5</option>
                                    <option value="4" @if(old('rating'=='4' )) selected @else selected @endif>4</option>
                                    <option value="4.5" @if(old('rating'=='4.5' )) selected @endif>4.5</option>
                                    <option value="5" @if(old('rating'=='5' )) selected @endif>5</option>
                                </select>
                                <label for="rating">Rating <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-4 theme-form-floating price_field table-responsive">
                                <table>
                                    <tr>
                                        <td class="mx-5">
                                            <label for="weight" class="col-form-label ml-3">Weight <span
                                                    class="text-danger">*</span></label>
                                            <input id="weight" type="text" name="weight[]" placeholder="Add weight"
                                                value="" required>
                                        </td>
                                        <td><label for="price" class="col-form-label">Price <span
                                                    class="text-danger">*</span></label>
                                            <input id="price" type="number" name="price[]" placeholder="Enter price"
                                                value="" required>
                                        </td>
                                        <td><label for="mrp" class="col-form-label">MRP <span
                                                    class="text-danger">*</span></label>
                                            <input id="mrp" type="number" name="mrp[]" placeholder="Enter mrp" value=""
                                                required>
                                        </td>
                                        <td><button class="btn btn-success float-right my-2 btn-sm add_field"
                                                type="button">Add</button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-4 theme-form-floating">
                                <textarea name="description" id="description" class="form-control editor"></textarea>
                                <label for="description">Description <span class="text-danger">*</span></label>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-4 theme-form-floating">
                                <textarea name="additional_info" id="additional_info"
                                    class="form-control editor2"></textarea>
                                <label for="additional_info">Additional Info <span class="text-danger">*</span></label>
                                @error('additional_info')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-4 theme-form-floating">
                                <textarea name="care_instruction" id="care_instruction"
                                    class="form-control editor3"></textarea>
                                <label for="care_instruction">Care Instruction <span
                                        class="text-danger">*</span></label>
                                @error('care_instruction')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn theme-bg-color btn-md text-white">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add address modal box end -->

<!-- Edit profile modal box start -->
<div class="modal fade theme-modal" id="edit-profile" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a new address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{route($route.'.profile_update',$vender_data->id)}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="text" class="form-control" id="company_name" name="company_name" required
                                    value="{{$vender_data->company_name ?? ''}}">
                                <label for="company_name">Company Name <span class="text-danger">*</span></label>
                                @error('company_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="email" class="form-control" id="email" name="email" required
                                    value="{{$vender_data->email ?? ''}}">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="tel" class="form-control" id="phone" name="phone" required
                                    value="{{$vender_data->phone ?? ''}}">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="text" class="form-control" id="country" name="country" required
                                    value="{{$vender_data->country ?? ''}}">
                                <label for="country">Country <span class="text-danger">*</span></label>
                                @error('country')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="numeric" class="form-control" id="year_established" name="year_established"
                                    required value="{{$vender_data->year_established ?? ''}}">
                                <label for="year_established">Year Established <span
                                        class="text-danger">*</span></label>
                                @error('year_established')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <select name="category" id="category" class="form-control" required>
                                    <option value="">select</option>
                                    @if(count($categories)>0)
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($category->id == $vender_data->category)
                                        selected @endif>{{$category->title}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <label for="category">Category <span class="text-danger">*</span></label>
                                @error('category')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="text" class="form-control" id="city" name="city" required
                                    value="{{$vender_data->city}}">
                                <label for="city">City <span class="text-danger">*</span></label>
                                @error('city')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="numeric" class="form-control" id="zip" name="zip" required
                                    value="{{$vender_data->zip}}">
                                <label for="zip">Zip <span class="text-danger">*</span></label>
                                @error('zip')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="text" class="form-control" id="old_password" name="old_password">
                                <label for="old_password">Old Password</label>
                                @error('old_password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="password" class="form-control" id="password" name="password">
                                <label for="password">New Password</label>
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="file" class="form-control" id="photo" name="photo">
                                <label for="photo">Photo </label>
                                @error('photo')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Old Photo </label><br>
                            <img src="{{URL::to($vender_data->photo)}}" style="width:100px;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-4 theme-form-floating">
                                <textarea name="address" id="address"
                                    class="form-control">{{$vender_data->address ?? ''}}</textarea>
                                <label for="address">Address <span class="text-danger">*</span></label>
                                @error('address')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn theme-bg-color btn-md text-white">Update
                            changes</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- Add profile modal box end -->

@if(count($products)>0) 
@foreach($products as $key2 => $value) 
@php $product_price = DB::table('product_price')->where('product_id',$value->id)->get(); @endphp
<!-- Edit address modal box start -->
<div class="modal fade theme-modal" id="edit-address-{{$key2}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{route($route.'.update',$value->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <input type="hidden" name="hidden_photo" value="{{$value->photo}}">
                    <input type="hidden" name="hidden_sub_photos" value="{{$value->sub_photos}}">
                    <input type="hidden" name="old_category" value="{{$value->category}}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="text" class="form-control" id="title" name="title" required
                                    value="{{$value->title}}">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <select name="category" id="category" class="form-control">
                                    <option value="">select</option>
                                    @if(count($categories)>0)
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($category->id == $value->category) selected
                                        @endif>
                                        {{$category->title}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <label for="category">Category <span class="text-danger">*</span></label>
                                @error('category')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <select name="status" id="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive" @if('inactive'==$value->status) selcted @endif>Inactive
                                    </option>
                                </select>
                                <label for="status">Status <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="file" class="form-control" id="photo" name="photo">
                                <label for="photo">Photo</label>
                                @error('photo')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="file" class="form-control" id="sub_photos" name="sub_photos[]" multiple>
                                <label for="sub_photos">Sub Photos</label>
                                @error('sub_photos')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4 theme-form-floating">
                                <select name="rating" class="form-control">
                                    <option value="0.5" @if($value->rating == '0.5')) selected @endif>0.5</option>
                                    <option value="1" @if($value->rating == '1')) selected @endif>1</option>
                                    <option value="1.5" @if($value->rating == '1.5')) selected @endif>1.5</option>
                                    <option value="2" @if($value->rating == '2')) selected @endif>2</option>
                                    <option value="2.5" @if($value->rating == '2.5')) selected @endif>2.5</option>
                                    <option value="3" @if($value->rating == '3')) selected @endif>3</option>
                                    <option value="3.5" @if($value->rating == '3.5')) selected @endif>3.5</option>
                                    <option value="4" @if($value->rating == '4')) selected @else selected @endif>4
                                    </option>
                                    <option value="4.5" @if($value->rating == '4.5')) selected @endif>4.5</option>
                                    <option value="5" @if($value->rating == '5')) selected @endif>5</option>
                                </select>
                                <label for="rating">Rating <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="photo">Old Photo </label><br>
                            <img src="{{URL::to($value->photo)}}" style="width:100px">
                        </div>
                        <div class="col-md-4">
                            <label for="sub_photos">Old Sub Photos </label><br>
                            @if($value->sub_photos != null && $value->sub_photos !='')
                            @foreach(explode(',', $value->sub_photos) as $key=>$subphotos)
                            @php $catid = trim($subphotos,'[]"'); @endphp
                            @if($catid != '' && strlen($catid) > 1)
                            @php $img = str_replace("\\", '', $catid) @endphp
                            <img src="{{URL::to($img)}}" class="img-fluid zoom" style="max-width:100px" alt="{{$img}}">
                            @endif
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-4 theme-form-floating price_field table-responsive">
                                <table>
                                    @if(count($product_price)>0)
                                    @foreach($product_price as $price_key=>$price)
                                    <tr>
                                        <td class="mx-5">
                                            <label for="weight" class="col-form-label ml-3">Weight <span
                                                    class="text-danger">*</span></label>
                                            <input id="weight" type="text" name="weight[]" placeholder="Add weight"
                                                value="{{$price->quantity}}" required>
                                        </td>
                                        <td><label for="price" class="col-form-label">Price <span
                                                    class="text-danger">*</span></label>
                                            <input id="price" type="number" name="price[]" placeholder="Enter price"
                                                value="{{$price->price}}" required>
                                        </td>
                                        <td><label for="mrp" class="col-form-label">MRP <span
                                                    class="text-danger">*</span></label>
                                            <input id="mrp" type="number" name="mrp[]" placeholder="Enter mrp"
                                                value="{{$price->mrp}}" required>
                                        </td>
                                        @if($price_key==0)
                                        <td><button class="btn btn-success float-right my-2 btn-sm add_field"
                                                type="button">Add</button></td>
                                        @else
                                        <td><button class="btn btn-danger mx-2 my-2 btn-sm remove_field"
                                                type="button">Remove</button></td>
                                        @endif
                                    </tr> <br>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="mx-5">
                                            <label for="weight" class="col-form-label ml-3">Weight <span
                                                    class="text-danger">*</span></label>
                                            <input id="weight" type="text" name="weight[]" placeholder="Add weight"
                                                value="" required>
                                        </td>
                                        <td><label for="price" class="col-form-label">Price <span
                                                    class="text-danger">*</span></label>
                                            <input id="price" type="number" name="price[]" placeholder="Enter price"
                                                value="" required>
                                        </td>
                                        <td><label for="mrp" class="col-form-label">MRP <span
                                                    class="text-danger">*</span></label>
                                            <input id="mrp" type="number" name="mrp[]" placeholder="Enter mrp" value=""
                                                required>
                                        </td>
                                        <td><button class="btn btn-success btn-sm float-right my-2 add_field"
                                                type="button">Add</button></td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-4 theme-form-floating">
                                <textarea name="description" id="description"
                                    class="form-control edit_editor1{{$key2}}">{{$value->description ?? ''}}</textarea>
                                <label for="description">Description <span class="text-danger">*</span></label>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-4 theme-form-floating">
                                <textarea name="additional_info" id="additional_info"
                                    class="form-control edit_editor2{{$key2}}">{{$value->additional_info ?? ''}}</textarea>
                                <label for="additional_info">Additional Info
                                    <span class="text-danger">*</span></label>
                                @error('additional_info')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-4 theme-form-floating">
                                <textarea name="care_instruction" id="care_instruction"
                                    class="form-control edit_editor3{{$key2}}">{{$value->care_instruction ?? ''}}</textarea>
                                <label for="care_instruction">Care
                                    Instruction <span class="text-danger">*</span></label>
                                @error('care_instruction')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn theme-bg-color btn-md text-white">Update
                        changes</button>
                </div>
                @include('frontend.pages.vender.editor', ['editor_key' => $key2])
            </form>
        </div>
    </div>
</div>
<!-- Edit address modal box end -->
@endforeach
@endif

<style>
@media (min-width: 576px) {
    .modal-dialog {
        max-width: 50%;
        margin: 1.75rem auto;
    }
}

.add_field {
    color: #fff;
    background-color: #198754;
    border-color: #198754;
}

.remove_field,
.btn-danger {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-secondary {
    color: #fff;
    background-color: #6c757d;
    border-color: #6c757d;
}
</style>

<!-- latest jquery-->
<script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>

<script>
var data =
    '<tr><td> <label for="weight">weight <span class="text-danger">*</span></label><input id="weight" type="text" name="weight[]" placeholder="Add weight" required></td><td><label for="price" class="col-form-label">Price <span class="text-danger">*</span></label><input id="price" type="number" name="price[]" placeholder="Enter price" required></td><td><label for="price" class="col-form-label">Price <span class="text-danger">*</span></label><input id="mrp" type="number" name="mrp[]" placeholder="Enter mrp" required></td><td><button class="btn btn-danger mx-2 my-2 btn-sm remove_field" type="button">Remove</button></td></tr>';
$(".add_field").click(function() {
    $(".price_field").append(data);
})

$(".price_field").on('click', '.remove_field', function() {
    $(this).closest('tr').remove();
})
</script>

@include('admin.layouts.editor')

@endsection