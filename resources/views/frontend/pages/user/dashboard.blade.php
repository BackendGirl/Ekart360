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
                                <img src="{{URL::to('public/frontend\bakery\assets\images\inner-page/cover-img.jpg')}}" class="img-fluid blur-up lazyload"
                                    alt="">
                            </div>

                            <div class="profile-contain">
                                <div class="profile-image">
                                    <div class="position-relative">
                                        @if(Auth()->user()->photo)
                                        <img src="{{ URL::to(Auth()->user()->photo) }}"
                                            class="blur-up lazyload update_img" alt="">
                                        @else
                                        <img src="{{ URL::to('public/frontend/user.jpg') }}"
                                            class="blur-up lazyload update_img" alt="">
                                        @endif     
                                    </div>
                                </div>

                                <div class="profile-name">
                                    <h3>{{Auth()->user()->first_name}}</h3>
                                    <h6 class="text-content">{{Auth()->user()->email}}</h6>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-dashboard-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-dashboard" type="button" role="tab"
                                    aria-controls="pills-dashboard" aria-selected="true"><i data-feather="home"></i>
                                    DashBoard</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-order-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-order" type="button" role="tab" aria-controls="pills-order"
                                    aria-selected="false"><i data-feather="shopping-bag"></i>Order</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-wishlist-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-wishlist" type="button" role="tab"
                                    aria-controls="pills-wishlist" aria-selected="false"><i data-feather="heart"></i>
                                    Wishlist</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-address-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-address" type="button" role="tab"
                                    aria-controls="pills-address" aria-selected="false"><i data-feather="map-pin"></i>
                                    Address</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false"><i data-feather="user"></i>
                                    Profile</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a href="javascript:void(0);"
                                onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                <button class="nav-link" id="pills-out-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-out" type="button" role="tab" aria-selected="false"><i
                                        data-feather="log-out"></i>
                                    Log Out</button>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                            </li>

                            <!-- <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-security-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-security" type="button" role="tab"
                                    aria-controls="pills-security" aria-selected="false"><i data-feather="shield"></i>
                                    Privacy</button>
                            </li> -->
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
                                                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="dashboard-user-name">
                                        <h6 class="text-content">Hello, <b class="text-title">{{Auth()->user()->first_name}}</b></h6>
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
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/order.svg" class="blur-up lazyload"
                                                        alt="">
                                                    <div class="totle-detail">
                                                        <h5>Total Order</h5>
                                                        <h3>{{$total_orders ?? 0}}</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="totle-contain">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/pending.svg"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/pending.svg" class="blur-up lazyload"
                                                        alt="">
                                                    <div class="totle-detail">
                                                        <h5>Total Pending Order</h5>
                                                        <h3>{{$total_pending_orders ?? 0}}</h3>
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
                                                        <h5>Total Wishlist</h5>
                                                        <h3>{{$total_wishlist_count ?? 0}}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="dashboard-title">
                                        <h3>Account Information</h3>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-xxl-6">
                                            <div class="dashboard-contant-title">
                                                <h4>Contact Information <a href="javascript:void(0)"
                                                        data-bs-toggle="modal" data-bs-target="#editProfile">Edit</a>
                                                </h4>
                                            </div>
                                            <div class="dashboard-detail">
                                                <h6 class="text-content">{{Auth()->user()->first_name}}</h6>
                                                <h6 class="text-content">{{Auth()->user()->email}}</h6>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6">
                                            <div class="dashboard-contant-title">
                                                <h4>Newsletters
                                                     <!-- <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#editProfile">Edit</a> -->
                                                </h4>
                                            </div>
                                            <div class="dashboard-detail">
                                                <h6 class="text-content">You are currently not subscribed to any
                                                    newsletter</h6>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="row g-4">
                                                @if(count($user_addresses)>0)
                                                    @foreach($user_addresses as $address_key=>$user_address)
                                                    @if($user_address->default_address == 1)
                                                    
                                                    <div class="col-xxl-6">
                                                        <div class="dashboard-detail">
                                                            <h6 class="text-content">Default Billing Address</h6>
                                                               {{$user_address->name}},
                                                                {{$user_address->house_no}},
                                                                {{$user_address->area}},
                                                                {{$user_address->landmark}},
                                                                {{$user_address->town_city}},
                                                                {{$user_address->state_title}},
                                                                {{$user_address->pin_code}} <br>
                                                                Phone : {{$user_address->phone}} <br><br>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#edituseraddresses{{$address_key}}">Edit Address</a>
                                                        </div>
                                                    </div>
                                            <!-- Edit Profile Start -->
                                            <div class="modal fade theme-modal" id="edituseraddresses{{$address_key}}" tabindex="-1" aria-labelledby="exampleModalLabel2"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel2">Edit Profile</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </button>
                                                        </div>
                                                        <form action="{{route('user.update_user_address')}}" method="post">
                                                                @csrf
                                                                <input type="hidden" value="{{$user_address->id}}" name="address_id">
                                                        <div class="modal-body">                    
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <input type="text" class="form-control" id="fname" placeholder="Enter Full Name" name="name" value="{{$user_address->name}}" required>
                                                                    <label for="name">Full Name <span class="text-danger">*</span></label>
                                                                    @error('name')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <input type="phone" class="form-control" id="phone" placeholder="Enter Phone"  name="phone" value="{{$user_address->phone}}" required>
                                                                    <label for="phone">Phone <span class="text-danger">*</span></label>
                                                                    @error('phone')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <input type="text" class="form-control" id="house_no" placeholder="Enter Flat, House no., Building, Company, Apartment"  name="house_no" value="{{$user_address->house_no}}" required>
                                                                    <label for="house_no">Flat, House no., Building, Company, Apartment <span class="text-danger">*</span></label>
                                                                    @error('house_no')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <input type="text" class="form-control" id="area" placeholder="Enter Area, Street, Sector, Village"  name="area" value="{{$user_address->area}}" required>
                                                                    <label for="area">Area, Street, Sector, Village <span class="text-danger">*</span></label>
                                                                    @error('area')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <input type="text" class="form-control" id="landmark" placeholder="Enter Landmark"  name="landmark" value="{{$user_address->landmark}}" required>
                                                                    <label for="landmark">Landmark <span class="text-danger">*</span></label>
                                                                    @error('landmark')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <input type="number" class="form-control" id="pin_code" placeholder="Enter Pincode"  name="pin_code" value="{{$user_address->pin_code}}" required>
                                                                    <label for="pin_code">Pincode <span class="text-danger">*</span></label>
                                                                    @error('pin_code')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <input type="text" class="form-control" id="town_city" placeholder="Enter Town/City"  name="town_city" value="{{$user_address->town_city}}" required>
                                                                    <label for="town_city">Town/City <span class="text-danger">*</span></label>
                                                                    @error('town_city')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <select name="state" id="state" class="form-control">
                                                                        <option value="">select</option>
                                                                        @if(count($provinces)>0)
                                                                        @foreach($provinces as $province)
                                                                        <option value="{{$province->id}}" @if($province->id == $user_address->state) selected @endif>{{$province->title}}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                    <label for="state">State <span class="text-danger">*</span></label>
                                                                    @error('state')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>  
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <select name="address_type" id="address_type" class="form-control">
                                                                        <option value="">select</option>
                                                                        <option value="Home" @if($user_address->address_type == 'Home') selected @endif>Home</option>
                                                                        <option value="Office" @if($user_address->address_type == 'Office') selected @endif>Office</option>
                                                                        <option value="Neighbour" @if($user_address->address_type == 'Neighbour') selected @endif>Neighbour</option>
                                                                        <option value="Other" @if($user_address->address_type == 'Other') selected @endif>Other</option>
                                                                    </select>
                                                                    <label for="address_type">Address Type</label>
                                                                </div>                                                              
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-animation btn-md fw-bold"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn theme-bg-color btn-md fw-bold text-light">Update changes</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Edit Profile End -->
                                                @endif
                                        @endforeach
                                        @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="pills-wishlist" role="tabpanel"
                                aria-labelledby="pills-wishlist-tab">
                                <div class="dashboard-wishlist">
                                    <div class="title">
                                        <h2>My Wishlist History</h2>
                                        <span class="title-leaf title-leaf-gray">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="row g-sm-4 g-3">
                                    @if(session()->get('wishlist'))
                                     @foreach(session()->get('wishlist') as $key=>$wishlist2)
                                     @if($key == $theme)
                                      @foreach($wishlist2 as $wishlist3)
                                      @foreach($wishlist3 as $wishlist)
                                       @php $product = DB::table('products')
                                                       ->select('products.*','product_category.title as category_title')
                                                       ->where('products.id',$wishlist['product_id'])
                                                       ->where('products.theme',$theme)
                                                       ->join('product_category','product_category.id','products.category')
                                                       ->first() @endphp
                                        <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                            <div class="product-box-3 theme-bg-white h-100">
                                                <div class="product-header">
                                                    <div class="product-image">
                                                        <a href="{{route('products_detail',$product->slug)}}">
                                                            <img src="{{URL::to($product->photo)}}"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>

                                                        <form action="{{route('wishlist_delete')}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$product->id}}">
                                                                <input type="hidden" name="weight" value="{{$wishlist['weight']}}">
                                                            <div class="product-header-top">
                                                                <button class="btn wishlist-button close_button">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            </form>
                                                    </div>
                                                </div>

                                                <div class="product-footer">
                                                    <div class="product-detail">
                                                        <span class="span-name">{{$product->category_title}}</span>
                                                        <a href="{{route('products_detail',$product->slug)}}">
                                                            <h5 class="name">{{$product->title}}</h5>
                                                        </a>
                                                        <h6 class="unit mt-1">{{$wishlist['weight']}}</h6>
                                                        <h5 class="price">
                                                            <span class="theme-color">{!! $settings->currency_symbol ?? '' !!} {{ $wishlist['price'] ?? '' }}</span>
                                                            <del>{!! $settings->currency_symbol ?? '' !!} {{ $wishlist['mrp'] ?? '' }}</del>
                                                        </h5>
                                                        <form action="{{route('add-to-cart')}}" method="post">
                                                            @csrf
                                                        <div class="add-to-cart-box mt-2">
                                                            <button class="btn btn-add-cart addcart-button"
                                                                tabindex="0">Add
                                                                <span class="add-icon">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                </span>
                                                            </button>
                                                            <div class="cart_qty qty-box">
                                                                <div class="input-group">
                                                                    <button type="button" class="qty-left-minus"
                                                                        data-type="minus" data-field="">
                                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                                    </button>
                                                                    <input class="form-control input-number qty-input"
                                                                        type="number" name="quant" value="1">
                                                                    <button type="button" class="qty-right-plus"
                                                                        data-type="plus" data-field="">
                                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                        <input type="hidden" value="{{$wishlist['price']}}" name="price">
                                                        <input type="hidden" value="{{$product->slug}}" name="slug">
                                                        <input type="hidden" value="{{$wishlist['weight']}}" name="weight">
                                                        <div class="button-group">
                                                            <button name="cart_btn" value="cart_btn" type="submit" class="btn btn-sm cart-button theme-bg-color text-white w-100">Add to cart</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endforeach
                                        @endif
                                       @endforeach
                                      @endif
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="pills-order" role="tabpanel"
                                aria-labelledby="pills-order-tab">
                                <div class="dashboard-order">
                                    <div class="title">
                                        <h2>My Orders History</h2>
                                        <span class="title-leaf title-leaf-gray">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="order-contain">
                                            
                                                <table id="basic-table" class="display table nowrap table-striped table-hover"
                                                    style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Order No.</th>
                                                        <th>Product</th>
                                                        <th>Quantity</th>
                                                        <th>Sub Total</th>
                                                        <th>Total</th>
                                                        <th>Delivery Type</th>
                                                        <th>Vender</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(count($orders)>0)
                                                        @foreach($orders as $order_key=>$order)
                                                        @php $quantity = 0; @endphp
                                                        <tr>
                                                            <td>{{$order_key+1}}</td>
                                                            <td>{{$order->order_number}}</td>
                                                            <td>
                                                            @if($order->product_detail != null && $order->product_detail !='')                                        
                                                                @foreach(json_decode($order->product_detail) as $key=> $subphotos2) 
                                                                @if($key == $theme)
                                                                @foreach($subphotos2 as $subphotos3)
                                                                @foreach($subphotos3 as $subphotos)
                                                                @php $product = DB::table('products')->where('id',$subphotos->product_id)->first() @endphp
                                                                @php $quantity += $subphotos->quantity; @endphp
                                                                    <ul>
                                                                        <li>
                                                                            @if(!empty($product))  
                                                                            {{$product->title}} @if($subphotos->weight) ({{$subphotos->weight}}) @endif
                                                                        </li>
                                                                    </ul>
                                                                    @endif
                                                                @endforeach
                                                                @endforeach
                                                                @endif
                                                                @endforeach
                                                                @endif
                                                            </td>
                                                            <td>{{$quantity}}</td>
                                                            <td>{{$order->sub_total ?? ''}}</td>
                                                            <td>₹{{number_format($order->total_amount,2)}}</td>
                                                            <td>
                                                                @if($order->delivery_type == 'standard_delivery')
                                                                Standard Delivery
                                                                @else
                                                                Future Delivery <span class="badge bg-primary">{{$order->future_delivery_date}}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if(is_numeric($order->vender))
                                                                    @if($vender = DB::table('saller')->where('id',$order->vender)->first())
                                                                    {{$vender->company_name ?? ''}}
                                                                    @else
                                                                        ---
                                                                    @endif
                                                                @else
                                                                Admin
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
                                                                    style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                                    title="view" data-placement="bottom"><i class="fa fa-eye"></i></a>
                                                                
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="pills-address" role="tabpanel"
                                aria-labelledby="pills-address-tab">
                                <div class="dashboard-address">
                                    <div class="title title-flex">
                                        <div>
                                            <h2>My Address Book</h2>
                                            <span class="title-leaf">
                                                <svg class="icon-width bg-gray">
                                                    <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                                                </svg>
                                            </span>
                                        </div>

                                        <button class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3"
                                            data-bs-toggle="modal" data-bs-target="#add-address"><i data-feather="plus"
                                                class="me-2"></i> Add New Address</button>
                                    </div>

                                    <div class="row g-sm-4 g-3">
                                        @if(count($user_addresses)>0)
                                        @foreach($user_addresses as $address_key=>$user_address)
                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                            <div class="address-box">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" checked>
                                                    </div>

                                                    <div class="label">
                                                        <label>{{$user_address->address_type}}</label>
                                                    </div>

                                                    <div class="table-responsive address-table">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2">{{$user_address->name}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Address :</td>
                                                                    <td>     {{$user_address->house_no}},
                                                                             {{$user_address->area}},
                                                                             {{$user_address->landmark}},
                                                                             {{$user_address->town_city}},
                                                                             {{$user_address->state_title}}
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Pin Code :</td>
                                                                    <td>{{$user_address->pin_code}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Phone :</td>
                                                                    <td>{{$user_address->phone}}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="button-group">
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#edituseraddresses{{$address_key}}"><i data-feather="edit"></i>
                                                        Edit</button>
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#removeuseraddresses{{$address_key}}"><i data-feather="trash-2"></i>
                                                        Remove</button>
                                                </div>
                                            </div>
                                        </div>

                                            <!-- Edit Profile Start -->
                                            <div class="modal fade theme-modal" id="edituseraddresses{{$address_key}}" tabindex="-1" aria-labelledby="exampleModalLabel2"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel2">Edit Profile</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </button>
                                                        </div>
                                                        <form action="{{route('user.update_user_address')}}" method="post">
                                                                @csrf
                                                                <input type="hidden" value="{{$user_address->id}}" name="address_id">
                                                        <div class="modal-body">                    
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <input type="text" class="form-control" id="fname" placeholder="Enter Full Name" name="name" value="{{$user_address->name}}" required>
                                                                    <label for="name">Full Name <span class="text-danger">*</span></label>
                                                                    @error('name')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <input type="phone" class="form-control" id="phone" placeholder="Enter Phone"  name="phone" value="{{$user_address->phone}}" required>
                                                                    <label for="phone">Phone <span class="text-danger">*</span></label>
                                                                    @error('phone')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <input type="text" class="form-control" id="house_no" placeholder="Enter Flat, House no., Building, Company, Apartment"  name="house_no" value="{{$user_address->house_no}}" required>
                                                                    <label for="house_no">Flat, House no., Building, Company, Apartment <span class="text-danger">*</span></label>
                                                                    @error('house_no')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <input type="text" class="form-control" id="area" placeholder="Enter Area, Street, Sector, Village"  name="area" value="{{$user_address->area}}" required>
                                                                    <label for="area">Area, Street, Sector, Village <span class="text-danger">*</span></label>
                                                                    @error('area')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <input type="text" class="form-control" id="landmark" placeholder="Enter Landmark"  name="landmark" value="{{$user_address->landmark}}" required>
                                                                    <label for="landmark">Landmark <span class="text-danger">*</span></label>
                                                                    @error('landmark')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <input type="number" class="form-control" id="pin_code" placeholder="Enter Pincode"  name="pin_code" value="{{$user_address->pin_code}}" required>
                                                                    <label for="pin_code">Pincode <span class="text-danger">*</span></label>
                                                                    @error('pin_code')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <input type="text" class="form-control" id="town_city" placeholder="Enter Town/City"  name="town_city" value="{{$user_address->town_city}}" required>
                                                                    <label for="town_city">Town/City <span class="text-danger">*</span></label>
                                                                    @error('town_city')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <select name="state" id="state" class="form-control">
                                                                        <option value="">select</option>
                                                                        @if(count($provinces)>0)
                                                                        @foreach($provinces as $province)
                                                                        <option value="{{$province->id}}" @if($province->id == $user_address->state) selected @endif>{{$province->title}}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                    <label for="state">State <span class="text-danger">*</span></label>
                                                                    @error('state')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>  
                                                                <div class="form-floating mb-4 theme-form-floating">
                                                                    <select name="address_type" id="address_type" class="form-control">
                                                                        <option value="">select</option>
                                                                        <option value="Home" @if($user_address->address_type == 'Home') selected @endif>Home</option>
                                                                        <option value="Office" @if($user_address->address_type == 'Office') selected @endif>Office</option>
                                                                        <option value="Neighbour" @if($user_address->address_type == 'Neighbour') selected @endif>Neighbour</option>
                                                                        <option value="Other" @if($user_address->address_type == 'Other') selected @endif>Other</option>
                                                                    </select>
                                                                    <label for="address_type">Address Type</label>
                                                                </div>                                                              
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-animation btn-md fw-bold"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn theme-bg-color btn-md fw-bold text-light">Update changes</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Edit Profile End -->

                                               <!-- Remove Profile Modal Start -->
                                                <div class="modal fade theme-modal remove-profile" id="removeuseraddresses{{$address_key}}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-block text-center">
                                                                <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure ?</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="remove-box">
                                                                    <p>If you delete it you will not be able to get it again.</p>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                                                                <a href="{{route('user.remove_user_address',$user_address->id)}}"><button type="button" class="btn theme-bg-color btn-md fw-bold text-light">Yes</button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Remove Profile Modal End -->
                                                
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="dashboard-profile">
                                    <div class="title">
                                        <h2>My Profile</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="profile-detail dashboard-bg-box">
                                        <div class="dashboard-title">
                                            <h3>Profile Name</h3>
                                        </div>
                                        <div class="profile-name-detail">
                                            <div class="d-sm-flex align-items-center d-block">
                                                <h3>{{Auth()->user()->first_name}}</h3>
                                            </div>

                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#editProfile">Edit</a>
                                        </div>

                                        <div class="location-profile">
                                            <ul>

                                                <li>
                                                    <div class="location-box">
                                                        <i data-feather="mail"></i>
                                                        <h6>{{Auth()->user()->email}}</h6>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="profile-about dashboard-bg-box">
                                        <div class="row">
                                            <div class="col-xxl-7">
                                                <div class="dashboard-title mb-3">
                                                    <h3>Profile About</h3>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Gender :</td>
                                                                <td>@if(Auth()->user()->gender == 1) Male @elseif(Auth()->user()->gender == 2) Femail @elseif(Auth()->user()->gender == 3) Other @else --- @endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Birthday :</td>
                                                                <td>@if(Auth()->user()->dob && Auth()->user()->dob != '0000-00-00'){{date('d/m/Y',strtotime(Auth()->user()->dob))}}@else --- @endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Phone Number :</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">{{Auth()->user()->phone ?? '---'}}</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email :</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">{{Auth()->user()->email ?? '---'}}</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Address :</td>
                                                                <td>{{Auth()->user()->address ?? '---'}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>

                                            <div class="col-xxl-5">
                                                <div class="profile-image">
                                                    <img src="../assets/images/inner-page/dashboard-profile.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="pills-security" role="tabpanel"
                                aria-labelledby="pills-security-tab">
                                <div class="dashboard-privacy">
                                    <div class="dashboard-bg-box">
                                        <div class="dashboard-title mb-4">
                                            <h3>Privacy</h3>
                                        </div>

                                        <div class="privacy-box">
                                            <div class="d-flex align-items-start">
                                                <h6>Allows others to see my profile</h6>
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="redio" aria-checked="false">
                                                    <label class="form-check-label" for="redio"></label>
                                                </div>
                                            </div>

                                            <p class="text-content">all peoples will be able to see my profile</p>
                                        </div>

                                        <div class="privacy-box">
                                            <div class="d-flex align-items-start">
                                                <h6>who has save this profile only that people see my profile</h6>
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="redio2" aria-checked="false">
                                                    <label class="form-check-label" for="redio2"></label>
                                                </div>
                                            </div>

                                            <p class="text-content">all peoples will not be able to see my profile</p>
                                        </div>

                                        <button class="btn theme-bg-color btn-md fw-bold mt-4 text-white">Save
                                            Changes</button>
                                    </div>

                                    <div class="dashboard-bg-box mt-4">
                                        <div class="dashboard-title mb-4">
                                            <h3>Account settings</h3>
                                        </div>

                                        <div class="privacy-box">
                                            <div class="d-flex align-items-start">
                                                <h6>Deleting Your Account Will Permanently</h6>
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="redio3" aria-checked="false">
                                                    <label class="form-check-label" for="redio3"></label>
                                                </div>
                                            </div>
                                            <p class="text-content">Once your account is deleted, you will be logged out
                                                and will be unable to log in back.</p>
                                        </div>

                                        <div class="privacy-box">
                                            <div class="d-flex align-items-start">
                                                <h6>Deleting Your Account Will Temporary</h6>
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="redio4" aria-checked="false">
                                                    <label class="form-check-label" for="redio4"></label>
                                                </div>
                                            </div>

                                            <p class="text-content">Once your account is deleted, you will be logged out
                                                and you will be create new account</p>
                                        </div>

                                        <button class="btn theme-bg-color btn-md fw-bold mt-4 text-white">Delete My
                                            Account</button>
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

     <!-- Deal Box Modal Start -->
     <div class="modal fade theme-modal deal-modal" id="deal-box" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title w-100" id="deal_today">Deal Today</h5>
                        <p class="mt-1 text-content">Recommended deals for you.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="deal-offer-box">
                        <ul class="deal-offer-list">
                            <li class="list-1">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.html" class="deal-image">
                                        <img src="../assets/images/vegetable/product/10.png" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.html" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>

                            <li class="list-2">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.html" class="deal-image">
                                        <img src="../assets/images/vegetable/product/11.png" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.html" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>

                            <li class="list-3">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.html" class="deal-image">
                                        <img src="../assets/images/vegetable/product/12.png" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.html" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>

                            <li class="list-1">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.html" class="deal-image">
                                        <img src="../assets/images/vegetable/product/13.png" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.html" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Deal Box Modal End -->

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
                <form action="{{route('user.add_user_address')}}" method="post">
                        @csrf
                <div class="modal-body">                    
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" id="fname" placeholder="Enter Full Name" name="name" value="{{Auth()->user()->first_name}}" required>
                            <label for="name">Full Name <span class="text-danger">*</span></label>
                            @error('name')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="phone" class="form-control" id="phone" placeholder="Enter Phone"  name="phone" value="{{Auth()->user()->phone}}" required>
                            <label for="phone">Phone <span class="text-danger">*</span></label>
                            @error('phone')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" id="house_no" placeholder="Enter Flat, House no., Building, Company, Apartment"  name="house_no" value="{{old('house_no')}}" required>
                            <label for="house_no">Flat, House no., Building, Company, Apartment <span class="text-danger">*</span></label>
                            @error('house_no')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" id="area" placeholder="Enter Area, Street, Sector, Village"  name="area" value="{{old('area')}}" required>
                            <label for="area">Area, Street, Sector, Village <span class="text-danger">*</span></label>
                            @error('area')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" id="landmark" placeholder="Enter Landmark"  name="landmark" value="{{old('landmark')}}" required>
                            <label for="landmark">Landmark <span class="text-danger">*</span></label>
                            @error('landmark')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="number" class="form-control" id="pin_code" placeholder="Enter Pincode"  name="pin_code" value="{{old('pin_code')}}" required>
                            <label for="pin_code">Pincode <span class="text-danger">*</span></label>
                            @error('pin_code')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" id="town_city" placeholder="Enter Town/City"  name="town_city" value="{{old('town_city')}}" required>
                            <label for="town_city">Town/City <span class="text-danger">*</span></label>
                            @error('town_city')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-floating mb-4 theme-form-floating">
                            <select name="state" id="state" class="form-control">
                                <option value="">select</option>
                                @if(count($provinces)>0)
                                 @foreach($provinces as $province)
                                  <option value="{{$province->id}}" @if($province->id == old('state')) selected @endif>{{$province->title}}</option>
                                 @endforeach
                                @endif
                            </select>
                            <label for="state">State <span class="text-danger">*</span></label>
                            @error('state')
                               <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>  
                        <div class="form-floating mb-4 theme-form-floating">
                            <select name="address_type" id="address_type" class="form-control">
                                <option value="">select</option>
                                <option value="Home">Home</option>
                                <option value="Office">Office</option>
                                <option value="Neighbour">Neighbour</option>
                                <option value="Other">Other</option>
                            </select>
                            <label for="address_type">Address Type</label>
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

    <!-- Location Modal Start -->
    <div class="modal location-modal fade theme-modal" id="locationModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Choose your Delivery Location</h5>
                    <p class="mt-1 text-content">Enter your address and we will specify the offer for your area.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="location-list">
                        <div class="search-input">
                            <input type="search" class="form-control" placeholder="Search Your Area">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>

                        <div class="disabled-box">
                            <h6>Select a Location</h6>
                        </div>

                        <ul class="location-select custom-height">
                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Alabama</h6>
                                    <span>Min: $130</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Arizona</h6>
                                    <span>Min: $150</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>California</h6>
                                    <span>Min: $110</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Colorado</h6>
                                    <span>Min: $140</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Florida</h6>
                                    <span>Min: $160</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Georgia</h6>
                                    <span>Min: $120</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Kansas</h6>
                                    <span>Min: $170</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Minnesota</h6>
                                    <span>Min: $120</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>New York</h6>
                                    <span>Min: $110</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Washington</h6>
                                    <span>Min: $130</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Location Modal End -->

    <!-- Edit Profile Start -->
    <div class="modal fade theme-modal" id="editProfile" tabindex="-1" aria-labelledby="exampleModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form action="{{route('user.update_profile')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <div class="row g-4">
                           <div class="col-md-6">                           
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="name" value="{{Auth()->user()->first_name}}" name="name" required>
                                    <label for="name">Full Name <span class="text-danger">*</span></label>
                                    @error('name')
                                      <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="tel" class="form-control" id="phone" value="{{Auth()->user()->phone}}" name="phone" required>
                                    <label for="phone">Phone <span class="text-danger">*</span></label>
                                    @error('phone')
                                      <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                </div>
                             <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="email" class="form-control" id="email" value="{{Auth()->user()->email}}" name="email" required>
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    @error('email')
                                      <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                </div>
                             <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="file" class="form-control" id="photo" name="photo">
                                    <label for="name">Photo</label>
                                    <input type="hidden" name="hidden_photo" value="{{Auth()->user()->photo}}">
                                </div>
                        </div>
                        <div class="col-md-6">                           
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="old_password" value="{{old('old_password')}}" name="old_password">
                                    <label for="old_password">Old Password </label>
                                    @error('old_password')
                                      <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="password" class="form-control" id="password" value="" name="password">
                                    <label for="password">New Password </label>
                                    @error('password')
                                      <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                         </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-animation btn-md fw-bold"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit"
                        class="btn theme-bg-color btn-md fw-bold text-light">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Profile End -->

    <!-- Edit Card Start -->
    <div class="modal fade theme-modal" id="editCard" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel8">Edit Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-xxl-6">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="finame" value="Mark">
                                    <label for="finame">First Name</label>
                                </div>
                            </form>
                        </div>

                        <div class="col-xxl-6">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="laname" value="Jecno">
                                    <label for="laname">Last Name</label>
                                </div>
                            </form>
                        </div>

                        <div class="col-xxl-4">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <select class="form-select" id="floatingSelect12"
                                        aria-label="Floating label select example">
                                        <option selected>Card Type</option>
                                        <option value="kindom">Visa Card</option>
                                        <option value="states">MasterCard Card</option>
                                        <option value="fra">RuPay Card</option>
                                        <option value="china">Contactless Card</option>
                                        <option value="spain">Maestro Card</option>
                                    </select>
                                    <label for="floatingSelect12">Card Type</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-animation btn-md fw-bold"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn theme-bg-color btn-md fw-bold text-light">Update Card</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Card End -->

 

@endsection