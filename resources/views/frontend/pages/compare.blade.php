@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')

<!-- latest jquery-->
<script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>

<!-- Breadcrumb Section Start -->
@include('frontend.layouts.breadscrumb')
<!-- Breadcrumb Section End -->


<!-- Compare Section Start -->
<section class="compare-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table compare-table">
                        <tbody>
                            <tr>
                                <th>Product</th>
                                <td>
                                    <a class="text-title" href="{{route('products_detail',$product->slug)}}">{{$product->title ?? ''}}</a>
                                </td>
                                @if(count($products)>0)
                                @foreach($products as $product_value)
                                <td>
                                    <a class="text-title" href="{{route('products_detail',$product_value->slug)}}">{{$product_value->title ?? ''}}</a>
                                </td>
                                @endforeach
                                @endif
                            </tr>

                            <tr>
                                <th>Images</th>
                                <td>
                                    <a href="{{route('products_detail',$product_value->slug)}}" class="compare-image">
                                        <img src="{{URL::to($product->photo)}}"
                                            class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                </td>
                                @if(count($products)>0)
                                @foreach($products as $product_value)
                                <td>
                                    <a href="{{route('products_detail',$product_value->slug)}}" class="compare-image">
                                        <img src="{{URL::to($product_value->photo)}}"
                                            class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                </td>
                                @endforeach
                                @endif
                            </tr>

                            <tr>
                                <th>Rating</th>
                                <td class="text-content">{{$product->rating ?? 4}}</td>
                                @if(count($products)>0)
                                @foreach($products as $product_value)
                                <td class="text-content">{{$product_value->rating ?? 4}}</td>
                                @endforeach
                                @endif
                            </tr>

                            <tr>
                                <th>Vender</th>
                                <td class="text-content">
                                    @php $vender = DB::table('saller')->where('id',$product->vender)->first(); @endphp
                                    @if($vender)
                                    {{$vender->company_name ?? ''}}
                                    @else
                                    Admin
                                    @endif
                                </td>
                                @if(count($products)>0)
                                @foreach($products as $product_value)
                                <td class="text-content">
                                    @php $vender = DB::table('saller')->where('id',$product_value->vender)->first(); @endphp
                                    @if($vender)
                                    {{$vender->company_name ?? ''}}
                                    @else
                                    Admin
                                    @endif
                                </td>
                                @endforeach
                                @endif
                            </tr>

                            <tr>
                                <th>Available Weights</th>
                                @php $product_weight = DB::table('product_price')->where('product_id',$product->id)->get(); @endphp
                                <td class="price text-content">
                                    @if($product_weight)
                                    @foreach($product_weight as $product_weight_value)
                                    {{$product_weight_value->quantity}}, <br>
                                    @endforeach
                                    @endif
                                </td>
                                @if(count($products)>0)
                                @foreach($products as $product_value)
                                @php $product_weight = DB::table('product_price')->where('product_id',$product_value->id)->get(); @endphp
                                <td class="price text-content">
                                    @if($product_weight)
                                    @foreach($product_weight as $product_weight_value)
                                    {{$product_weight_value->quantity}}, <br>
                                    @endforeach
                                    @endif
                                </td>
                                @endforeach
                                @endif
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Compare Section End -->

@endsection