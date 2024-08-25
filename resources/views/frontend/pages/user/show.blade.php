@extends('frontend.layouts.master')
@section('title', $title)
@section('main-content')


<!-- Breadcrumb Section Start -->
@include('frontend.layouts.breadscrumb')
<!-- Breadcrumb Section End -->

<div class="container">
   <!-- DataTales Example -->
 <div class="card shadow mb-4" id="sectionToPrint">
 <style>
  @media print {
  .hide_content {
    display: none !important;
  }
}

.fa-calendar-times-o{
  size: 200px;px;
  align:center;
}
</style>

    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left">Order History</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
      @if($order)
    <table class="table table-striped table-hover">
      <thead>
        <tr>
            <th>S.N.</th>
            <th>Order No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Total Products</th>
            <th>Total Amount</th>
            <th class="hide_content">Order Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>1</td>
            <td>{{$order->order_number}}</td>
            <td>{{$order->first_name}} {{$order->last_name}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->total_products ?? 0}}</td>
            <td>₹{{number_format($order->total_amount,2)}}</td>
            <td class="hide_content">
            <a href="{{route($route.'.print',$order->id)}}"><i class="fa fa-print"></i></a>
            </td>
        </tr>        
      </tbody>
    </table>

    <section class="confirmation_part section_padding">
      <div class="order_boxes">
        <div class="row">
          <div class="col-lg-6 col-lx-4">
            <div class="order-info">
              <h4 class="text-center pb-4">ORDER INFORMATION</h4>               
              <table class="table">
                    <tr class="">
                        <td>Order Number</td>
                        <td> : {{$order->order_number}}</td>
                    </tr>
                    <tr>
                        <td>Order Date</td>
                        <td> : 
                        <?php
                            $date=date_create($order->created_at);
                            echo date_format($date,"d-m-Y (h:i:s A)");
                          ?>
                      </td>
                    </tr>
                    <tr>
                        <td>Total Products</td>
                        <td> : {{$order->total_products ?? '---'}}</td>
                    </tr>
                    <tr>
                        <td>Order Status</td>
                        <td> : {{$order->order_status}}</td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td> : ₹ {{number_format($order->total_amount,2)}}</td>
                    </tr>
                    <tr>
                      <td>Payment Method</td>
                      <td> : @if($order->payment_method=='cod') Cash on Delivery @else Paypal @endif</td>
                    </tr>
                    <tr>
                        <td>Payment Status</td>
                        <td> : {{$order->payment_status ?? ''}}</td>
                    </tr>
              </table>
            </div>
          </div>

          <div class="col-lg-6 col-lx-4">
            <div class="shipping-info">
              <h4 class="text-center pb-4">SHIPPING INFORMATION</h4>
              <table class="table">
                    <tr class="">
                        <td>Full Name</td>
                        <td> : {{$order->first_name}} {{$order->last_name}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td> : {{$order->email}}</td>
                    </tr>
                    <tr>
                        <td>Phone No.</td>
                        <td> : {{$order->phone}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td> : 
                            {{$order->first_name}} {{$order->last_name}}, <br>
                            {{$order->house_no}} {{$order->area}},<br>
                            {{$order->landmark}} {{$order->town_city}},<br>
                            {{$order->title ?? ""}}, {{$order->pin_code ?? ""}}
                        </td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td> : {{$order->title ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Post Code / Pin Code</td>
                        <td> : {{$order->pin_code ?? ''}}</td>
                    </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class= "order-return">
    <a href="{{route($route.'.cancelorder',$order->id)}}"
      data-toggle="tooltip"
      data-placement="bottom">
      <button style='font-size:24px'>Return <i class='fas fa-times-circle'></i></button>
    </a>
                                                                
    </div>
    @endif
      </div>
    </div>
</div>
</div>


<script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>

<script>
$(document).ready(function() {
    $('#printButton').click(function() {
        var sectionToPrint = $('#sectionToPrint').html();
        var originalBody = $('body').html();

        $('body').html(sectionToPrint);
        window.print();

        $('body').html(originalBody);
    });
});

</script>

@endsection

