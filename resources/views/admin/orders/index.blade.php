@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                    </div>

                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                        <div style="width:auto;float:right;">
                            <form action="{{route($route.'.index')}}" method="get" id="update_order_status">
                                <select name="order_status" id="" class="form-control order_status">
                                    <option value="all" @if($selected_order == 'all') selected @endif>all</option>
                                    <option value="new" @if($selected_order == 'new') selected @endif>new</option>
                                    <option value="process" @if($selected_order == 'process') selected @endif>process</option>
                                    <option value="delivered" @if($selected_order == 'delivered') selected @endif>delivered</option>
                                    <option value="canceled" @if($selected_order == 'canceled') selected @endif>canceled</option>
                                </select>
                            </form>
                            </div><br><br>
                            @if(count($orders)>0)                            
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
                                </tbody>
                            </table>
                            @else
                            <h6 class="text-center">No data found!!!</h6>
                            @endif
                        </div>
                        <!-- [ Data table ] end -->
                    </div>
                </div>
            </div>

        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

<script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>

<script>
    $(document).ready(function() { 
        $(".order_status").change(function(){
            var status = $(this).val();
              $("#update_order_status").submit();          
        })
        
    })
 </script>


@endsection